<?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use App\Models\User;
// use App\Providers\RouteServiceProvider;
// use Illuminate\Auth\Events\Registered;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Validation\Rules;
// use Illuminate\View\View;

// class RegisteredUserController extends Controller
// {
//     /**
//      * Display the registration view.
//      */
//     public function create(): View
//     {
//         return view('auth.register');
//     }

//     /**
//      * Handle an incoming registration request.
//      *
//      * @throws \Illuminate\Validation\ValidationException
//      */
//     public function store(Request $request): RedirectResponse
//     {
//         $request->validate([
//             'name' => ['required', 'string', 'max:255'],
//             'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
//             'password' => ['required', 'confirmed', Rules\Password::defaults()],
//         ]);

//         $user = User::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//         ]);

//         event(new Registered($user));

//         //Auth::login($user);

//         //return redirect(RouteServiceProvider::HOME);
//         return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
//     }
// }

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'student_id' => ['nullable', 'string', 'max:50', 'unique:users'],
            'national_id' => ['required', 'string', 'max:50', 'unique:users'],
            'id_card_front' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'id_card_back' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => ['required', 'accepted'],
        ], [
            'national_id.required' => 'National ID or Birth Certificate number is required for verification.',
            'national_id.unique' => 'This National ID is already registered.',
            'student_id.unique' => 'This Student ID is already registered.',
            'id_card_front.required' => 'ID card front photo is required.',
            'id_card_back.required' => 'ID card back photo is required.',
            'id_card_front.image' => 'ID card front must be an image.',
            'id_card_back.image' => 'ID card back must be an image.',
            'id_card_front.max' => 'ID card front must not exceed 2MB.',
            'id_card_back.max' => 'ID card back must not exceed 2MB.',
            'terms.required' => 'You must agree to the terms and conditions.',
        ]);

        // Handle file uploads
        $idCardFrontPath = null;
        $idCardBackPath = null;

        if ($request->hasFile('id_card_front')) {
            $idCardFrontPath = $request->file('id_card_front')->store('id_cards', 'public');
        }

        if ($request->hasFile('id_card_back')) {
            $idCardBackPath = $request->file('id_card_back')->store('id_cards', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'student_id' => $request->student_id,
            'national_id' => $request->national_id,
            'id_card_front' => $idCardFrontPath,
            'id_card_back' => $idCardBackPath,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'status' => 'pending', // Default status is pending
        ]);

        event(new Registered($user));

        // Don't login automatically - wait for admin approval
        // Auth::login($user);

        return redirect()->route('register')->with('status', 'Registration submitted for admin approval. Your ID documents are under verification. You will be notified via email once approved.');
    }
}