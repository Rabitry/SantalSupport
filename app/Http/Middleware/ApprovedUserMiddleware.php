<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApprovedUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        $user = Auth::user();

        // Allow admin users to access all routes
        if ($user->isAdmin()) {
            return $next($request);
        }

        // Check if user is approved
        if ($user->isApproved()) {
            return $next($request);
        }

        // Check if user is pending
        if ($user->isPending()) {
            return redirect()->route('dashboard')->with('error', 'Your account is pending approval. Please wait for admin verification.');
        }

        // Check if user is rejected
        if ($user->isRejected()) {
            $errorMessage = 'Your account has been rejected.';
            if ($user->rejection_reason) {
                $errorMessage .= ' Reason: ' . $user->rejection_reason;
            }
            return redirect()->route('dashboard')->with('error', $errorMessage);
        }

        // Default fallback
        return redirect()->route('dashboard')->with('error', 'You are not authorized to access this page.');
    }
}