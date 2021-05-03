<?php

namespace App\Http\Middleware;

use App\Menus\LeftSidebarMenu;
use App\Models\Menu;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class BuildMenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $role = 'guest';
        if (Auth::check()) {
//            $role =  Auth::user()->menuroles;
            $role = Auth::user()->role->name;
            //dd($userRole);
            //$userRoles = $userRoles['items'];
            //$roleHierarchy = RoleHierarchy::select('role_hierarchy.role_id', 'roles.name')
            //    ->join('roles', 'roles.id', '=', 'role_hierarchy.role_id')
            //    ->orderBy('role_hierarchy.hierarchy', 'asc')->get();
//            $flag = false;
//            foreach ($roleHierarchy as $roleHier) {
//                foreach ($userRoles as $userRole) {
//                    if ($userRole == $roleHier['name']) {
//                        $role = $userRole;
//                        $flag = true;
//                        break;
//                    }
//                }
//                if ($flag === true) {
//                    break;
//                }
//            }
        }

        //session(['prime_user_role' => $role]);
        $menus = new LeftSidebarMenu();
        $menulists = Menu::all();
        $role = Role::where('name', $role)->first();
        $result = array();
        foreach ($menulists as $menulist) {
            $result[$menulist->name] = $menus->get($role->id, $menulist->id);
        }
//        dd($result['Sidebar Menu']);
        view()->share('side_menu', $result['Sidebar Menu']);
        view()->share('top_menu', $result['Topbar Menu']);
        return $next($request);
    }
}
