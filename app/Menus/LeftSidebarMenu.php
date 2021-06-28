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
    }
}
