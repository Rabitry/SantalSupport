<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

// class AuthenticatedSessionController extends Controller
// {
//     /**
//      * Display the login view.
//      */
//     public function create(): View
//     {
//         return view('auth.login');
//     }

//     /**
//      * Handle an incoming authentication request.
//      */
//     public function store(LoginRequest $request): RedirectResponse
//     {
//         $request->authenticate();

//         $request->session()->regenerate();

//         return redirect()->intended(RouteServiceProvider::HOME);
//     }

//     /**
//      * Destroy an authenticated session.
//      */
//     public function destroy(Request $request): RedirectResponse
//     {
//         Auth::guard('web')->logout();

//         $request->session()->invalidate();

//         $request->session()->regenerateToken();

//         return redirect('/population');
//     }
// }



class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // Check if user is approved
        if ($user->status === 'pending') {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Your account is pending approval. Please wait for admin verification.',
            ])->onlyInput('email');
        }

        // Check if user is rejected
        if ($user->status === 'rejected') {
            $errorMessage = 'Your account has been rejected.';
            if ($user->rejection_reason) {
                $errorMessage .= ' Reason: ' . $user->rejection_reason;
            }
            
            Auth::logout();
            return back()->withErrors([
                'email' => $errorMessage,
            ])->onlyInput('email');
        }

        //return redirect()->intended(route('population.index', absolute: false));
        //return redirect()->intended(route('dashboard.index', absolute: false));
        //return redirect()->intended(route('dashboard', absolute: false));
        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        } else {
            return redirect()->intended(route('dashboard', absolute: false));
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}