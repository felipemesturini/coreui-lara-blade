<?php

namespace App\Http\Middleware;

use App\Menus\LeftSidebarMenu;
use App\Models\Menu;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $role = Auth::user()->role->name;
        }

        $menus = new LeftSidebarMenu();
        $menulists = Menu::all();
        $role = Role::where('name', $role)->first();
        $result = array();
        foreach ($menulists as $menulist) {
            $result[$menulist->name] = $menus->get($role->id, $menulist->id);
        }
        view()->share('side_menu', $result['Sidebar Menu']);
        view()->share('top_menu', $result['Topbar Menu']);
        return $next($request);
    }
}
