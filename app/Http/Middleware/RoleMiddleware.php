<?php

namespace App\Http\Middleware;

use App\Permission;
use App\Role;
use Closure;

class RoleMiddleware
{

    public function handle($request, Closure $next, $role = null, $permission = null )
    {
        if ($request->user()->email  == \Config::get('constants.options.def_user')){
            return $next($request);
        }

        if ($role != null && !$request->user()->hasRole($role)) {
            abort(404);
        }

        if ($permission !== null && !$request->user()->can($permission)) {

            abort(404);
        }
        $routeName = $request->route()->getName();
        $permission = Permission::where('route_name', $routeName)->first();

        //dd($permission['slug']);
        if ($permission == null || count($permission->all()) <= 0) {
            abort(404);
        }
        if (!$request->user()->can($permission['slug'])) {
            return redirect()->back()->with('warning', __('message.you_dont_have_permission_to_this_task'));
        }
        return $next($request);

    }
}
