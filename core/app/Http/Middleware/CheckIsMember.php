<?php

namespace App\Http\Middleware;

use App\Models\Project;
use App\Models\UserToProject;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIsMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $member = UserToProject::where('user_id', Auth::id())->first();
        $admin = Project::where('admin_id', Auth::id())->first();

        if (!$member && !$admin) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
