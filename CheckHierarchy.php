<?php
// app/Http/Middleware/CheckHierarchy.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckHierarchy
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        
        // Super Admin can access everything
        if ($user->role === 'super_admin') {
            return $next($request);
        }
        
        // For user management routes
        if ($request->route('user_code')) {
            $targetUser = User::where('system_code', $request->route('user_code'))->first();
            
            if (!$targetUser) {
                abort(404);
            }
            
            // Check hierarchy: either parent or creator
            if ($targetUser->parent_code !== $user->system_code && 
                $targetUser->created_by !== $user->system_code) {
                abort(403, 'Access denied: Outside hierarchy.');
            }
        }
        
        return $next($request);
    }
}
