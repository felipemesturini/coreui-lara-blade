<?php


namespace App\Menus;


interface MenuInterface
{
    public function get(int $roleId, int $menuId);

}
