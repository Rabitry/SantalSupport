<?php

namespace App\Http\Controllers;

use App\Models\Population;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PopulationController extends Controller
{
    /**
     * Display a listing of the population data with optional filters.
     */
    public function index(Request $request)
    {
        $query = Population::query();

        // $query = Population::withCount(['ratings as ratings_count'])
        // ->withAvg('ratings as ratings_avg_rating', 'rating')
        // ->with('user'); 

        if ($request->filled('search_college')) {
            $collegeTerm = $request->input('search_college');
            $query->where('college_university', 'LIKE', "%{$collegeTerm}%");
        }

        // Search functionality - FIXED
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('occupation', 'like', "%{$search}%")
                  ->orWhere('district', 'like', "%{$search}%")
                  ->orWhere('division', 'like', "%{$search}%");
            });
        }

        // Filter by occupation - FIXED
        if ($request->has('occupation') && !empty($request->occupation) && $request->occupation !== 'all') {
            $query->where('occupation', $request->occupation);
        }

        // Filter by district - FIXED
        if ($request->has('district') && !empty($request->district) && $request->district !== 'all') {
            $query->where('district', $request->district);
        }
        // Filter by blood group - ADD THIS
        if ($request->has('blood_group') && !empty($request->blood_group) && $request->blood_group !== 'all') {
            $query->where('blood_group', $request->blood_group);
        }

        // Use paginate() instead of get()
        $populations = $query->latest()->paginate(10);

        // Get distinct values for filters - FIXED
        $occupations = Population::distinct()->whereNotNull('occupation')->pluck('occupation')->filter();
        $districts = Population::distinct()->whereNotNull('district')->pluck('district')->filter();

        // ADD blood groups data
        $bloodGroups = Population::distinct()->whereNotNull('blood_group')->pluck('blood_group')->filter();

        return view('population.index', compact('populations', 'occupations', 'districts', 'bloodGroups'));
    }

    /**
     * Display admin listing of the population data with filters and pagination.
     */
    public function adminIndex(Request $request)
    {
        $query = Population::query();

        // Search functionality - FIXED
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('occupation', 'like', "%{$search}%")
                  ->orWhere('district', 'like', "%{$search}%")
                  ->orWhere('division', 'like', "%{$search}%");
            });
        }

        // Filter by occupation - FIXED
        if ($request->has('occupation') && !empty($request->occupation) && $request->occupation !== 'all') {
            $query->where('occupation', $request->occupation);
        }

        // Filter by district - FIXED
        if ($request->has('district') && !empty($request->district) && $request->district !== 'all') {
            $query->where('district', $request->district);
        }

        // Use paginate() for admin as well
        $populations = $query->latest()->paginate(10);

        // Get distinct values for filters - FIXED
        $occupations = Population::distinct()->whereNotNull('occupation')->pluck('occupation')->filter();
        $districts = Population::distinct()->whereNotNull('district')->pluck('district')->filter();

        return view('admin.populations.index', compact('populations', 'occupations', 'districts'));
    }

    /**
     * Show the form for creating a new population record.
     */
    public function create()
    {
        return view('population.create');
    }

    /**
     * Store a newly created population record in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'name' => 'required|string|max:255',
            'sex' => 'required|string',
            'occupation' => 'required|string',
            'college_university' => 'nullable|string',
            'subject_department' => 'nullable|string',
            'blood_group' => 'nullable|string',
            'phone' => 'required|string|unique:populations',
            'email' => 'required|email|unique:populations',
            'division' => 'required|string',
            'district' => 'required|string',
            'upazila' => 'required|string',
            'current_address' => 'required|string',
        ]);

        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')->store('profiles', 'public');
        }

        // Assign logged-in user ID
        $validated['user_login_id'] = Auth::id();

        Population::create($validated);

        return redirect()->route('population.index')->with('success', 'Population profile created successfully!');
    }

    /**
     * Show the form for editing an existing population record.
     */
    public function edit($id)
    {
        $population = Population::findOrFail($id);
        return view('population.edit', compact('population'));
    }

    /**
     * Admin edit form for population record.
     */
    public function adminEdit($id)
    {
        $population = Population::findOrFail($id);
        return view('admin.populations.edit', compact('population'));
    }

    /**
     * Update the specified population record in the database.
     */
    public function update(Request $request, $id)
    {
        $population = Population::findOrFail($id);

        $validated = $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'name' => 'required|string|max:255',
            'sex' => 'required|string',
            'occupation' => 'required|string',
            'college_university' => 'nullable|string',
            'subject_department' => 'nullable|string',
            'blood_group' => 'nullable|string',
            'phone' => 'required|string|unique:populations,phone,' . $population->id,
            'email' => 'required|email|unique:populations,email,' . $population->id,
            'division' => 'required|string',
            'district' => 'required|string',
            'upazila' => 'required|string',
            'current_address' => 'required|string',
        ]);

        // Handle new image upload
        if ($request->hasFile('profile_picture')) {
            // Delete old image if exists
            if ($population->profile_picture && Storage::exists('public/' . $population->profile_picture)) {
                Storage::delete('public/' . $population->profile_picture);
            }

            // Store new one
            $validated['profile_picture'] = $request->file('profile_picture')->store('profiles', 'public');
        }

        $population->update($validated);

        return redirect()->route('population.index')->with('success', 'Profile updated successfully!');
    }

    /**
     * Admin update for population record.
     */
    public function adminUpdate(Request $request, $id)
    {
        $population = Population::findOrFail($id);

        $validated = $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'name' => 'required|string|max:255',
            'sex' => 'required|string',
            'occupation' => 'required|string',
            'college_university' => 'nullable|string',
            'subject_department' => 'nullable|string',
            'blood_group' => 'nullable|string',
            'phone' => 'required|string|unique:populations,phone,' . $population->id,
            'email' => 'required|email|unique:populations,email,' . $population->id,
            'division' => 'required|string',
            'district' => 'required|string',
            'upazila' => 'required|string',
            'current_address' => 'required|string',
        ]);

        // Handle new image upload
        if ($request->hasFile('profile_picture')) {
            // Delete old image if exists
            if ($population->profile_picture && Storage::exists('public/' . $population->profile_picture)) {
                Storage::delete('public/' . $population->profile_picture);
            }

            // Store new one
            $validated['profile_picture'] = $request->file('profile_picture')->store('profiles', 'public');
        }

        $population->update($validated);

        return redirect()->route('admin.populations.index')->with('success', 'Profile updated successfully!');
    }

    /**
     * Display the specified population record.
     */
    public function show($id)
    {
        $population = Population::findOrFail($id);
        return view('population.show', compact('population'));
    }

    /**
     * Admin show for population record.
     */
    public function adminShow($id)
    {
        $population = Population::with('user')->findOrFail($id);
        return view('admin.populations.show', compact('population'));
    }

    /**
     * Remove the specified population record from storage.
     */
    public function destroy($id)
    {
        $population = Population::findOrFail($id);

        // Delete profile image if exists
        if ($population->profile_picture && Storage::exists('public/' . $population->profile_picture)) {
            Storage::delete('public/' . $population->profile_picture);
        }

        $population->delete();

        return redirect()->route('population.index')->with('success', 'Profile deleted successfully!');
    }

    /**
     * Admin destroy for population record.
     */
    public function adminDestroy($id)
    {
        $population = Population::findOrFail($id);

        // Delete profile image if exists
        if ($population->profile_picture && Storage::exists('public/' . $population->profile_picture)) {
            Storage::delete('public/' . $population->profile_picture);
        }

        $population->delete();

        return redirect()->route('admin.populations.index')->with('success', 'Profile deleted successfully!');
    }
}