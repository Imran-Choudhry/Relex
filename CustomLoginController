<?php
// app/Http/Controllers/Auth/CustomLoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CustomLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'system_code' => 'required|string|max:20',
            'password' => 'required|string',
            'pin' => 'sometimes|string|digits:6'
        ]);

        $user = User::where('system_code', $request->system_code)
                    ->where('is_active', true)
                    ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'system_code' => __('Invalid credentials.'),
            ]);
        }

        // PIN Verification if set
        if ($user->pin_hash && !Hash::check($request->pin, $user->pin_hash)) {
            throw ValidationException::withMessages([
                'pin' => __('Invalid PIN.'),
            ]);
        }

        // 2FA Check
        if ($user->two_factor_enabled) {
            $request->session()->put('2fa:user:id', $user->id);
            return redirect()->route('2fa.verify');
        }

        Auth::login($user);
        $user->update(['last_login_at' => now()]);

        return $this->authenticated($request, $user);
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->route($user->role . '.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
