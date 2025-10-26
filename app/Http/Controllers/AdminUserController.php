<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    public function pendingUsers()
    {
        $users = User::where('status', 'pending')->with(['approver', 'population'])->latest()->get();
        return view('admin.users.pending', compact('users'));
    }

    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        
        $user->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => auth()->id(),
            'rejection_reason' => null,
        ]);

        return redirect()->route('admin.users.pending')->with('success', 'User approved successfully!');
    }

    public function rejectUser(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $user = User::findOrFail($id);
        
        $user->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'approved_at' => null,
            'approved_by' => null,
        ]);

        return redirect()->route('admin.users.pending')->with('success', 'User rejected successfully!');
    }

    // public function index()
    // {
    //     $users = User::with(['approver', 'population'])->latest()->get();
    //     return view('admin.users.index', compact('users'));
    // }
    public function index(Request $request)
    {
        $query = User::query();
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('student_id', 'like', "%{$search}%")
                  ->orWhere('national_id', 'like', "%{$search}%");
            });
        }
        
        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }
        
        // Filter by role
        if ($request->has('role') && !empty($request->role)) {
            $query->where('role', $request->role);
        }
        
        // Filter by profile creation
        if ($request->has('profile_created') && !empty($request->profile_created)) {
            if ($request->profile_created === 'yes') {
                $query->has('population');
            } elseif ($request->profile_created === 'no') {
                $query->doesntHave('population');
            }
        }
        
        // Use paginate() instead of get() - this is crucial!
        $users = $query->with(['population', 'approver'])->latest()->paginate(10);
        
        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
            'student_id' => 'nullable|string|max:50|unique:users,student_id,' . $user->id,
            'national_id' => 'required|string|max:50|unique:users,national_id,' . $user->id,
        ]);

        $user->update($request->only('name', 'email', 'role', 'student_id', 'national_id'));

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot delete your own account!');
        }

        // Delete ID card images
        if ($user->id_card_front && Storage::disk('public')->exists($user->id_card_front)) {
            Storage::disk('public')->delete($user->id_card_front);
        }
        if ($user->id_card_back && Storage::disk('public')->exists($user->id_card_back)) {
            Storage::disk('public')->delete($user->id_card_back);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }
}