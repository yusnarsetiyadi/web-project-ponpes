<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class SidemenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = [
            [
                'id' => 7,
                'label' => 'Dashboard',
                'link' => '/home',
                'parent' => 0,
                'sort' => 0,
                'class' => 'dashboard',
                'menu' => 2,
                'depth' => 0,
                'created_at' => '2022-02-03T14:18:10.000000Z',
                'updated_at' => '2022-02-03T14:18:21.000000Z',
                'child' => array ()
            ],[
                'id' => 1,
                'label' => 'Menu Manger',
                'link' => '/menus',
                'parent' => 0,
                'sort' => 1,
                'class' => 'priority-low',
                'menu' => 2,
                'depth' => 0,
                'created_at' => '2022-02-03T11:01:58.000000Z',
                'updated_at' => '2022-02-03T14:18:21.000000Z',
                'child' => array ()
            ],[
                'id' => 6,
                'label' => 'Access Management',
                'link' => '#',
                'parent' => 0,
                'sort' => 2,
                'class' => 'diagram',
                'menu' => 2,
                'depth' => 0,
                'created_at' => '2022-02-03T14:16:18.000000Z',
                'updated_at' => '2022-02-03T14:18:21.000000Z',
                'child' => [
                    array (
                        'id' => 4,
                        'label' => 'Permission',
                        'link' => '/permissions',
                        'parent' => 6,
                        'sort' => 3,
                        'class' => NULL,
                        'menu' => 2,
                        'depth' => 1,
                        'created_at' => '2022-02-03T14:15:22.000000Z',
                        'updated_at' => '2022-02-03T14:18:21.000000Z',
                        'child' => array ()
                    ),
                    array(
                        'id' => 5,
                        'label' => 'Role',
                        'link' => '/roles',
                        'parent' => 6,
                        'sort' => 4,
                        'class' => NULL,
                        'menu' => 2,
                        'depth' => 1,
                        'created_at' => '2022-02-03T14:15:34.000000Z',
                        'updated_at' => '2022-02-03T14:18:22.000000Z',
                        'child' => array ()
                    ),
                ],
            ],[
                'id' => 8,
                'label' => 'User Management',
                'link' => '/users',
                'parent' => 0,
                'sort' => 5,
                'class' => 'users',
                'menu' => 2,
                'depth' => 0,
                'created_at' => '2022-02-03T14:19:55.000000Z',
                'updated_at' => '2022-02-03T14:20:33.000000Z',
                'child' => array(),
            ],[
                'id' => 2,
                'label' => 'Configurasi',
                'link' => '#',
                'parent' => 0,
                'sort' => 6,
                'class' => 'gears',
                'menu' => 2,
                'depth' => 0,
                'created_at' => '2022-02-03T11:02:36.000000Z',
                'updated_at' => '2022-02-03T14:20:33.000000Z',
                'child' => [
                    array (
                        'id' => 3,
                        'label' => 'Identitas Web',
                        'link' => '/iden',
                        'parent' => 2,
                        'sort' => 7,
                        'class' => NULL,
                        'menu' => 2,
                        'depth' => 1,
                        'created_at' => '2022-02-03T11:04:11.000000Z',
                        'updated_at' => '2022-02-03T14:20:33.000000Z',
                        'child' => array ( )
                    ),
                ],
            ]
        ];

        Menu::create($menu);
    }
}
