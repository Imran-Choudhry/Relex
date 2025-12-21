<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        switch ($user->role) {
            case 'super_admin':
                return $this->superAdminDashboard();
            case 'manager':
                return $this->managerDashboard();
            case 'provider':
                return $this->providerDashboard();
            case 'client':
                return $this->clientDashboard();
            default:
                abort(403);
        }
    }
    
    protected function superAdminDashboard()
    {
        $stats = [
            'total_managers' => User::where('role', 'manager')->count(),
            'total_providers' => User::where('role', 'provider')->count(),
            'total_clients' => User::where('role', 'client')->count(),
            'total_revenue' => User::where('role', 'super_admin')->sum('wallet_balance'),
            'pending_actions' => 0, // Will implement later
        ];
        
        return view('dashboard.super-admin', compact('stats'));
    }
    
    protected function managerDashboard()
    {
        $user = Auth::user();
        
        $stats = [
            'my_providers' => $user->children()->where('role', 'provider')->count(),
            'my_clients' => $user->children()->where('role', 'client')->count(),
            'total_earnings' => $user->wallet_balance,
            'pending_bookings' => 0, // Will implement later
        ];
        
        $recentProviders = $user->children()
            ->where('role', 'provider')
            ->latest()
            ->limit(5)
            ->get();
        
        return view('dashboard.manager', compact('stats', 'recentProviders'));
    }
    
    protected function providerDashboard()
    {
        $user = Auth::user();
        
        $stats = [
            'my_clients' => $user->children()->where('role', 'client')->count(),
            'wallet_balance' => $user->wallet_balance,
            'wallet_hold' => $user->wallet_hold,
            'upcoming_sessions' => 0, // Will implement later
        ];
        
        return view('dashboard.provider', compact('stats'));
    }
    
    protected function clientDashboard()
    {
        $user = Auth::user();
        
        $stats = [
            'wallet_balance' => $user->wallet_balance,
            'total_bookings' => 0, // Will implement later
            'upcoming_bookings' => 0,
        ];
        
        return view('dashboard.client', compact('stats'));
    }
}
