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
                'access_permissions' => '[58,59,60,61,62,63,64,65,73,72,71,70,69,68,67,66,74,75,76,77,78,79,80,81,88,87,86,85,84,83,82]',
                'modify_permissions' => '[89,90,91,92,93,94,95,96,104,103,102,101,100,99,98,97,105,106,107,108,109,110,111,112,119,118,117,116,115,114,113]',
                'roles_id' => '1',
            ]
        ];
  
        foreach ($userGroup as $key => $value) {
            UserGroup::create($value);
        }
    }
}
