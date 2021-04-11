<?php


namespace App\Menus;


use App\MenuBuilder\RenderFromDatabaseData;
use Illuminate\Support\Facades\DB;

class LeftSidebarMenu implements MenuInterface
{

    private $menu;

    public function get(string $role, int $menuId)
    {
        $this->menuFromDb($role, $menuId);
        $rfd = new RenderFromDatabaseData;
        return $rfd->render($this->menu);
    }

    private function menuFromDb( $role,  $menuId) {
        $this->menu = DB::table('menu_items')
            ->join('menu_roles', 'menu_items.id', '=', 'menu_roles.menu_items_id')
            ->select('menu_items.*')
            ->where('menu_items.menu_id', '=', $menuId)
            ->where('menu_roles.role_name', '=', $role)
            ->orderBy('menu_items.sequence')
            ->get();
    }
}
