<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserGroup;

class CreateUserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userGroup = [
            [
                'name' => 'Admin',
                'access_permissions' => '[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31]',
                'modify_permissions' => '[32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62]',
                'roles_id' => '1',
            ]
        ];
  
        foreach ($userGroup as $key => $value) {
            UserGroup::create($value);
        }
    }
}
