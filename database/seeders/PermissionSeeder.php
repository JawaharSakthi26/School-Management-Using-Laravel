<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name'  =>  'Admin Create',
                'permission_group_id' => PermissionGroup::where('name','Admin')->first()->id 
            ],
            [
                'name'  =>  'Admin List',
                'permission_group_id' => PermissionGroup::where('name','Admin')->first()->id 

            ],
            [
                'name'  =>  'Admin Edit',
                'permission_group_id' => PermissionGroup::where('name','Admin')->first()->id 
            ],
            [
                'name'  =>  'Admin Delete',
                'permission_group_id' => PermissionGroup::where('name','Admin')->first()->id 
            ],
            [
                'name'  =>  'Teacher Create',
                'permission_group_id' => PermissionGroup::where('name','Teacher')->first()->id 
            ],
            [
                'name'  =>  'Teacher List',
                'permission_group_id' => PermissionGroup::where('name','Teacher')->first()->id 
            ],
            [
                'name'  =>  'Teacher Edit',
                'permission_group_id' => PermissionGroup::where('name','Teacher')->first()->id 
            ],
            [
                'name'  =>  'Teacher Delete',
                'permission_group_id' => PermissionGroup::where('name','Teacher')->first()->id 
            ],
            [
                'name'  =>  'Student Create',
                'permission_group_id' => PermissionGroup::where('name','Student')->first()->id 
            ],
            [
                'name'  =>  'Student List',
                'permission_group_id' => PermissionGroup::where('name','Student')->first()->id 
            ],
            [
                'name'  =>  'Student Edit',
                'permission_group_id' => PermissionGroup::where('name','Student')->first()->id 
            ],
            [
                'name'  =>  'Student Delete',
                'permission_group_id' => PermissionGroup::where('name','Student')->first()->id 
            ],
        ];
        foreach($permissions as $key => $value){
            Permission::create([
                'name' => $value['name'],
                'permission_group_id' => $value['permission_group_id']
            ]);
        }
    }
}