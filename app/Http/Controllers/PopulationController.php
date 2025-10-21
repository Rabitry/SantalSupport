<?php

namespace App\Http\Controllers;

use App\Models\Population;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PopulationController extends Controller
{
    /**
     * Display a listing of the population data with optional filters.
     */
    public function index(Request $request)
    {
        $occupationFilter = $request->get('occupation', 'all');
        $districtFilter = $request->get('district', 'all');

        $query = Population::query();

        if ($occupationFilter !== 'all') {
            $query->where('occupation', $occupationFilter);
        }

        if ($districtFilter !== 'all') {
            $query->where('district', $districtFilter);
        }

        $populations = $query->get();

        $occupations = Population::select('occupation')->distinct()->pluck('occupation');
        $districts = Population::select('district')->distinct()->pluck('district');

        return view('population.index', compact('populations', 'occupations', 'districts'));
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
            'district' => 'required|string',
            'upazila' => 'required|string',
        ]);

        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')->store('profiles', 'public');
        }

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
            'district' => 'required|string',
            'upazila' => 'required|string',
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
}
