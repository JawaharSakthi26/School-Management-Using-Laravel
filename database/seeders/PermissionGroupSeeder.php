<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionGroups = [
            [
                'name'  =>  'Admin'
            ],
            [
                'name'  =>  'Teacher'
            ],
            [
                'name'  =>  'Student'
            ],
        ];

        foreach($permissionGroups as $key => $value){
            PermissionGroup::create([
                'name' => $value['name']
            ]);
        }
    }
}