<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
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
        // return view('auth.login');
        return view('admin.admin_login');
    }
    public function Redirect()
    {
        $url = '';
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin') {
            $url = 'admin/dashboard';
        } else if (Auth::user()->role == 'enumerator') {
            $url = 'enumerator/dashboard';
        } else if (Auth::user()->role == 'user') {
            $url = '/dashboard';
        } else {
            $url = 'login-page';
        }
        return redirect()->intended($url);
    }
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $url = '';
        if ($request->user()->role == 'admin' || $request->user()->role == 'superadmin') {
            $url = 'admin/dashboard';
        } else if ($request->user()->role == 'enumerator') {
            $url = 'enumerator/dashboard';
        } else if ($request->user()->role == 'user') {
            $url = '/dashboard';
        } else {
            $url = 'login-page';
        }
        return redirect()->intended($url);
    }
    public function Logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login-page');
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login-page');
    }
}
