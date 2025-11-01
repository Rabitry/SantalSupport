<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Population;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'population_id' => 'required|exists:populations,id',
            'rating' => 'required|integer|between:1,5',
            'feedback' => 'nullable|string|max:1000'
        ]);

        // Get the population being rated
        $population = Population::findOrFail($request->population_id);

        // Prevent users from rating their own profile
        if ($population->user_id === Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot rate your own profile.'
            ], 422);
        }

        // Check if user has already rated this population
        $existingRating = Rating::where('population_id', $request->population_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingRating) {
            return response()->json([
                'success' => false,
                'message' => 'You have already rated this profile.'
            ], 422);
        }

        $rating = Rating::create([
            'population_id' => $request->population_id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'feedback' => $request->feedback
        ]);

        // Calculate new average rating
        $population->load('ratings');
        $averageRating = $population->ratings->avg('rating');
        $ratingCount = $population->ratings->count();

        return response()->json([
            'success' => true,
            'message' => 'Rating submitted successfully.',
            'average_rating' => round($averageRating, 1),
            'rating_count' => $ratingCount
        ]);
    }
}