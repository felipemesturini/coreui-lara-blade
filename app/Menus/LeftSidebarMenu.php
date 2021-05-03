<?php


namespace App\Menus;


use App\MenuBuilder\RenderFromDatabaseData;
use App\Models\Role;

class LeftSidebarMenu implements MenuInterface
{

    private $menus;

    public function get(int $roleId, int $menuId)
    {
        $this->menuFromDb($roleId, $menuId);
        $rfd = new RenderFromDatabaseData;
        return $rfd->render($this->menus);
    }

    private function menuFromDb( int $roleId,  int $menuId) {
        $this->menus = Role::find($roleId)
            ->menuItems()
            ->where('menu_id', $menuId)
            ->get();

            //->where('roles.role_id', $menuId)->get();

//        $this->menu = DB::table('menu_items')
//            ->join('menu_roles', 'menu_items.id', '=', 'menu_roles.menu_items_id')
//            ->select('menu_items.*')
//            ->where('menu_items.menu_id', '=', $menuId)
//            ->where('menu_roles.role_id', '=', $roleId)
//            ->orderBy('menu_items.sequence')
//            ->get();
       // dd($this->menus);
    }
}
