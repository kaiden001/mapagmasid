<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class EnumeratorController extends Controller
{
    public function EnumeratorDashboard()
    {
        return view('enumerator.index');
    }
    public function Household()
    {
        return view('enumerator.household');
    }
    public function EnumeratorLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login-page');
    }
}
