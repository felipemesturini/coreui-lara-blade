<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{

    private $menuId = null;
    private $dropdownId = array();
    private $dropdown = false;
    private $sequence = 1;
    private $joinData = array();
//    private $adminRole = null;
    private $userRole = null;
    private $guestRole = null;
    private $subFolder = '';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Get roles */
        $this->adminRole = Role::where('name' , '=' , 'admin' )->first();
        $this->userRole = Role::where('name', '=', 'user' )->first();
        //dd($this->userRole);
        //Multiselecttext Ctrl + G (com um texto selecionado)
//        $this->userRole = Role::create(['name' => 'user']);
//        $this->guestRole = Role::create(['name' => 'guest']);
        /* Create Sidebar menu - Lado esquerdo */
        DB::table('menus')->insert([
            'name' => 'Sidebar Menu'
        ]);
        $this->menuId = DB::getPdo()->lastInsertId();  //set menuId
        $this->insertLink('user', 'Dashboard', '/', 'cil-speedometer');
        $this->beginDropdown('user', 'Settings', 'cil-calculator');
        $this->insertLink('user', 'Notes',                   '/notes');
        $this->insertLink('user', 'Users',                   '/users');
        $this->insertLink('user', 'Edit menu',               '/menu/menu');
        $this->insertLink('user', 'Edit menu elements',      '/menu/element');
        $this->insertLink('user', 'Edit roles',              '/roles');
        $this->insertLink('user', 'Media',                   '/media');
        $this->insertLink('user', 'BREAD',                   '/bread');
        $this->insertLink('user', 'Email',                   '/mail');
        $this->endDropdown();
        $this->insertLink('guest', 'Login', '/login', 'cil-account-logout');
        $this->insertLink('guest', 'Register', '/register', 'cil-account-logout');
        $this->insertTitle('user', 'Theme');
        $this->insertLink('user', 'Colors', '/colors', 'cil-drop1');
        $this->insertLink('user', 'Typography', '/typography', 'cil-pencil');
        $this->beginDropdown('user', 'Base', 'cil-puzzle');
        $this->insertLink('user', 'Breadcrumb',    '/base/breadcrumb');
        $this->insertLink('user', 'Cards',         '/base/cards');
        $this->insertLink('user', 'Carousel',      '/base/carousel');
        $this->insertLink('user', 'Collapse',      '/base/collapse');
        $this->insertLink('user', 'Forms',         '/base/forms');
        $this->insertLink('user', 'Jumbotron',     '/base/jumbotron');
        $this->insertLink('user', 'List group',    '/base/list-group');
        $this->insertLink('user', 'Navs',          '/base/navs');
        $this->insertLink('user', 'Pagination',    '/base/pagination');
        $this->insertLink('user', 'Popovers',      '/base/popovers');
        $this->insertLink('user', 'Progress',      '/base/progress');
        $this->insertLink('user', 'Scrollspy',     '/base/scrollspy');
        $this->insertLink('user', 'Switches',      '/base/switches');
        $this->insertLink('user', 'Tables',        '/base/tables');
        $this->insertLink('user', 'Tabs',          '/base/tabs');
        $this->insertLink('user', 'Tooltips',      '/base/tooltips');
        $this->endDropdown();
        $this->beginDropdown('user', 'Buttons', 'cil-cursor');
        $this->insertLink('user', 'Buttons',           '/buttons/buttons');
        $this->insertLink('user', 'Buttons Group',     '/buttons/button-group');
        $this->insertLink('user', 'Dropdowns',         '/buttons/dropdowns');
        $this->insertLink('user', 'Brand Buttons',     '/buttons/brand-buttons');
        $this->endDropdown();
        $this->insertLink('user', 'Charts', '/charts', 'cil-chart-pie');
        $this->beginDropdown('user', 'Icons', 'cil-star');
        $this->insertLink('user', 'CoreUI Icons',      '/icon/coreui-icons');
        $this->insertLink('user', 'Flags',             '/icon/flags');
        $this->insertLink('user', 'Brands',            '/icon/brands');
        $this->endDropdown();
        $this->beginDropdown('user', 'Notifications', 'cil-bell');
        $this->insertLink('user', 'Alerts',     '/notifications/alerts');
        $this->insertLink('user', 'Badge',      '/notifications/badge');
        $this->insertLink('user', 'Modals',     '/notifications/modals');
        $this->endDropdown();
        $this->insertLink('user', 'Widgets', '/widgets', 'cil-calculator');
        $this->insertTitle('user', 'Extras');
        $this->beginDropdown('user', 'Pages', 'cil-star');
        $this->insertLink('user', 'Login',         '/login');
        $this->insertLink('user', 'Register',      '/register');
        $this->insertLink('user', 'Error 404',     '/404');
        $this->insertLink('user', 'Error 500',     '/500');
        $this->endDropdown();
        $this->insertLink('guest,user', 'Download CoreUI', 'https://coreui.io', 'cil-cloud-download');
        $this->insertLink('guest,user', 'Try CoreUI PRO', 'https://coreui.io/pro/', 'cil-layers');


        /* Create top menu */
        DB::table('menus')->insert([
            'name' => 'Topbar Menu'
        ]);
        $this->menuId = DB::getPdo()->lastInsertId();  //set menuId
        $this->beginDropdown('guest,user', 'Pages');
        $this->insertLink('guest,user', 'Dashboard',    '/');
        $this->insertLink('user', 'Notes',              '/notes');
        $this->insertLink('user', 'Users',                   '/users');
        $this->endDropdown();
        $this->beginDropdown('user', 'Settings');

        $this->insertLink('user', 'Edit menu',               '/menu/menu');
        $this->insertLink('user', 'Edit menu elements',      '/menu/element');
        $this->insertLink('user', 'Edit roles',              '/roles');
        $this->insertLink('user', 'Media',                   '/media');
        $this->insertLink('user', 'BREAD',                   '/bread');
        $this->endDropdown();

        $this->joinAllByTransaction(); ///   <===== Must by use on end of this seeder
        /// ///

        #region


    }


    /*
    Function assigns menu elements to roles
    Must by use on end of this seeder
    */
    private function joinAllByTransaction(){
        DB::beginTransaction();
        foreach($this->joinData as $data){
            DB::table('menu_item_role')->insert([
                'role_id' => $data['role_id'],
                'menu_item_id' => $data['menu_items_id'],
            ]);
        }
        DB::commit();
    }

    private function insertLink($roles, $name, $href, $icon = null){
        $href = $this->subFolder . $href;
        if($this->dropdown === false){
            DB::table('menu_items')->insert([
                'slug' => 'link',
                'name' => $name,
                'icon' => $icon,
                'href' => $href,
                'menu_id' => $this->menuId,
                'sequence' => $this->sequence
            ]);
        }else{
            DB::table('menu_items')->insert([
                'slug' => 'link',
                'name' => $name,
                'icon' => $icon,
                'href' => $href,
                'menu_id' => $this->menuId,
                'parent_id' => $this->dropdownId[count($this->dropdownId) - 1],
                'sequence' => $this->sequence
            ]);
        }
        $this->sequence++;
        $lastId = DB::getPdo()->lastInsertId();
        $this->join($roles, $lastId);
       // $permission = Permission::where('name', '=', $name)->get();
        //if(empty($permission)){
       //     $permission = Permission::create(['name' => 'visit ' . $name]);
       // }
//        $roles = explode(',', $roles);
//        if(in_array('user', $roles)){
//            $this->userRole->givePermissionTo($permission);
//        }
//        if(in_array('user', $roles)){
//            $this->adminRole->givePermissionTo($permission);
//        }
        return $lastId;
    }

    private function insertTitle($roles, $name){
        DB::table('menu_items')->insert([
            'slug' => 'title',
            'name' => $name,
            'menu_id' => $this->menuId,
            'sequence' => $this->sequence
        ]);
        $this->sequence++;
        $lastId = DB::getPdo()->lastInsertId();
        $this->join($roles, $lastId);
        return $lastId;
    }

    private function beginDropdown($roles, $name, $icon = ''){
        if(count($this->dropdownId)){
            $parentId = $this->dropdownId[count($this->dropdownId) - 1];
        }else{
            $parentId = null;
        }
        DB::table('menu_items')->insert([
            'slug' => 'dropdown',
            'name' => $name,
            'icon' => $icon,
            'menu_id' => $this->menuId,
            'sequence' => $this->sequence,
            'parent_id' => $parentId
        ]);
        $lastId = DB::getPdo()->lastInsertId();
        array_push($this->dropdownId, $lastId);
        $this->dropdown = true;
        $this->sequence++;
        $this->join($roles, $lastId);
        return $lastId;
    }

    private function endDropdown(){
        $this->dropdown = false;
        array_pop( $this->dropdownId );
    }

   private function join($roles, $menusId){
        $roles = explode(',', $roles);
        foreach($roles as $role){
            $roleId = DB::table('roles')->where('name', $role)->first()->id;
            array_push($this->joinData, array('role_id' => $roleId, 'menu_items_id' => $menusId));
        }
    }

}
