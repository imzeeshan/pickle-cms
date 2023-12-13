<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Modules\Roles\Entities\Permission as PermissionModel;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user            = $request->user();
        $role            = $user->role;
        $permissions     = PermissionModel::where("role_id", $role->id)->get();
        $access_allowed  = 0; // Permission denied by default

        foreach ($permissions as $permission) {

            // Example: if pickle-cms.test/admin/user matches the word - 'user' in any permission's entity name, request is allowed.

            if (Str::contains($request->url(), $permission->entity)) {
                $access_allowed = 1;
                return $next($request);
            }
        }
        return redirect('/');
    }
}
