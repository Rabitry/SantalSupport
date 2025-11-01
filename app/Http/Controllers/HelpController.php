<?php
// app/Http/Controllers/HelpController.php

namespace App\Http\Controllers;

use App\Models\HelpRequest;
use App\Models\HelpOffer;
use App\Models\HelpReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class HelpController extends Controller
{
    /**
     * Display active help requests (unresolved)
     */
    public function index(Request $request): View
    {
        $query = HelpRequest::active()
            ->with(['user', 'offers.user'])
            ->latest();

        // Filter by category
        if ($request->has('category') && !empty($request->category) && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Filter by urgency
        if ($request->has('urgency') && !empty($request->urgency) && $request->urgency !== 'all') {
            $query->where('urgency', $request->urgency);
        }

        // Filter by location
        if ($request->has('location') && !empty($request->location)) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        $helpRequests = $query->paginate(10);

        $helpCategories = [
            'education' => 'Education & Learning',
            'health' => 'Health & Medical', 
            'skills' => 'Skills & Repairs',
            'transportation' => 'Transportation',
            'professional' => 'Professional Help',
            'other' => 'Other Help'
        ];

        $urgencyLevels = [
            'low' => 'Low',
            'medium' => 'Medium', 
            'high' => 'High',
            'critical' => 'Critical'
        ];

        return view('help.index', compact('helpRequests', 'helpCategories', 'urgencyLevels'));
    }

    /**
     * Display resolved help requests
     */
    public function resolved(Request $request): View
    {
        $query = HelpRequest::resolved()
            ->with(['user', 'resolver'])
            ->orderBy('created_at', 'desc');
            //->latest();

        // Search in resolved requests
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('solution_notes', 'like', "%{$search}%");
            });
        }

        $resolvedRequests = $query->paginate(15);

        return view('help.resolved', compact('resolvedRequests'));
    }

    /**
     * Show form to create a new help request
     */
    public function create(): View
    {
        $helpCategories = [
            'education' => 'Education & Learning',
            'health' => 'Health & Medical', 
            'skills' => 'Skills & Repairs',
            'transportation' => 'Transportation',
            'professional' => 'Professional Help',
            'other' => 'Other Help'
        ];

        $urgencyLevels = [
            'low' => 'Low',
            'medium' => 'Medium', 
            'high' => 'High',
            'critical' => 'Critical'
        ];

        return view('help.create', compact('helpCategories', 'urgencyLevels'));
    }

    /**
     * Store a new help request
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'category' => 'required|in:education,health,skills,transportation,professional,other',
            'urgency' => 'required|in:low,medium,high,critical',
            'location' => 'nullable|string|max:255'
        ]);

        $helpRequest = HelpRequest::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'urgency' => $request->urgency,
            'location' => $request->location,
            'status' => HelpRequest::STATUS_ACTIVE
        ]);

        return redirect()->route('help.show', $helpRequest->id)
            ->with('success', 'Help request created successfully! The community can now offer assistance.');
    }

    /**
     * Display a single help request
     */
    public function show($id): View
    {
        $helpRequest = HelpRequest::with([
            'user', 
            'offers.user', 
            'reviews.helper',
            'reviews.helpee'
        ])->findOrFail($id);

        // Check if user has already offered help
        $userOffer = $helpRequest->offers()
            ->where('user_id', Auth::id())
            ->first();

        return view('help.show', compact('helpRequest', 'userOffer'));
    }

    /**
     * Submit an offer to help
     */
    public function offer(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'message' => 'required|string|min:10|max:1000'
        ]);

        $helpRequest = HelpRequest::findOrFail($id);

        // Check if user is the request owner
        if ($helpRequest->user_id === Auth::id()) {
            return redirect()->back()->with('error', 'You cannot offer help on your own request.');
        }

        // Check if user already offered help
        $existingOffer = HelpOffer::where('help_request_id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingOffer) {
            return redirect()->back()->with('error', 'You have already offered help for this request.');
        }

        HelpOffer::create([
            'help_request_id' => $id,
            'user_id' => Auth::id(),
            'message' => $request->message,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Your offer to help has been submitted!');
    }

    /**
     * Accept a help offer
     */
    public function acceptOffer($requestId, $offerId): RedirectResponse
    {
        $helpRequest = HelpRequest::findOrFail($requestId);
        
        // Authorization check - only request owner can accept offers
        if ($helpRequest->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $offer = HelpOffer::where('id', $offerId)
            ->where('help_request_id', $requestId)
            ->firstOrFail();

        // Update offer status
        $offer->update(['status' => 'accepted']);

        // Update help request status
        $helpRequest->update(['status' => HelpRequest::STATUS_IN_PROGRESS]);

        // Reject other offers
        HelpOffer::where('help_request_id', $requestId)
            ->where('id', '!=', $offerId)
            ->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Help offer accepted! You can now coordinate with the helper.');
    }

    /**
     * Mark help request as resolved
     */
    public function resolve(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'solution_notes' => 'nullable|string|max:1000'
        ]);

        $helpRequest = HelpRequest::findOrFail($id);
        
        // Authorization - only request owner can mark as resolved
        if ($helpRequest->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Get accepted offer to record who helped
        $acceptedOffer = $helpRequest->offers()->where('status', 'accepted')->first();
        $resolvedBy = $acceptedOffer ? $acceptedOffer->user_id : null;

        // Mark as resolved
        $helpRequest->markAsResolved($resolvedBy, $request->solution_notes);

        return redirect()->route('help.resolved')
            ->with('success', 'Help request marked as resolved! Thank you for updating the community.');
    }

    /**
     * Display user's help requests
     */
    public function myRequests(): View
    {
        $helpRequests = HelpRequest::where('user_id', Auth::id())
            ->withCount(['offers'])
            ->latest()
            ->paginate(10);

        return view('help.my-requests', compact('helpRequests'));
    }

    /**
     * Display help requests where user offered help
     */
    public function myOffers(): View
    {
        $helpOffers = HelpOffer::where('user_id', Auth::id())
            ->with(['helpRequest.user', 'helpRequest.offers'])
            ->latest()
            ->paginate(10);

        return view('help.my-offers', compact('helpOffers'));
    }
}