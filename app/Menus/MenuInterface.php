<?php


namespace App\Menus;


interface MenuInterface
{
    public function get(string $role, int $menuId);

}
