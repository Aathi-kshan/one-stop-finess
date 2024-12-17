<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
    // Authenticate the user
    $request->authenticate();

    // Regenerate the session
    $request->session()->regenerate();

    // Check the role of the authenticated user and redirect accordingly
    if (auth()->user()->role === 'admin') {
        // Redirect to the admin dashboard
        return redirect()->route('admin.users');
    }

    if (auth()->user()->role === 'coach') {
        // Redirect to the coach dashboard
        return redirect()->route('coach.sessions.create');
    }

    // Default redirect (for general users)
    return redirect()->intended(route('home'));
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
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ];
    }

}
