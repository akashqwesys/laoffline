<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Settings\State;

class CreateStatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            [
                'country_id' => '105', 
                'name' => 'Andaman and Nicobar Islands'
            ],
            [
                'country_id' => '105', 
                'name' => 'Andhra Pradesh'
            ],
            [
                'country_id' => '105', 
                'name' => 'Arunachal Pradesh'
            ],
            [
                'country_id' => '105', 
                'name' => 'Assam'
            ],
            [
                'country_id' => '105', 
                'name' => 'Bihar'
            ],
            [
                'country_id' => '105', 
                'name' => 'Chandigarh'
            ],
            [
                'country_id' => '105', 
                'name' => 'Chhattisgarh'
            ],
            [
                'country_id' => '105', 
                'name' => 'Dadra and Nagar Haveli'
            ],
            [
                'country_id' => '105', 
                'name' => 'Daman and Diu'
            ],
            [
                'country_id' => '105', 
                'name' => 'Delhi'
            ],
            [
                'country_id' => '105', 
                'name' => 'Goa'
            ],
            [
                'country_id' => '105', 
                'name' => 'Gujarat'
            ],
            [
                'country_id' => '105', 
                'name' => 'Haryana'
            ],
            [
                'country_id' => '105', 
                'name' => 'Himachal Pradesh'
            ],
            [
                'country_id' => '105', 
                'name' => 'Jammu and Kashmir'
            ],
            [
                'country_id' => '105', 
                'name' => 'Jharkhand'
            ],
            [
                'country_id' => '105', 
                'name' => 'Karnataka'
            ],
            [
                'country_id' => '105', 
                'name' => 'Kerala'
            ],
            [
                'country_id' => '105', 
                'name' => 'Lakshadweep'
            ],
            [
                'country_id' => '105', 
                'name' => 'Madhya Pradesh'
            ],
            [
                'country_id' => '105', 
                'name' => 'Maharashtra'
            ],
            [
                'country_id' => '105', 
                'name' => 'Manipur'
            ],
            [
                'country_id' => '105', 
                'name' => 'Meghalaya'
            ],
            [
                'country_id' => '105', 
                'name' => 'Mizoram'
            ],
            [
                'country_id' => '105', 
                'name' => 'Nagaland'
            ],
            [
                'country_id' => '105', 
                'name' => 'Odisha'
            ],
            [
                'country_id' => '105', 
                'name' => 'Puducherry'
            ],
            [
                'country_id' => '105', 
                'name' => 'Punjab'
            ],
            [
                'country_id' => '105', 
                'name' => 'Rajasthan'
            ],
            [
                'country_id' => '105', 
                'name' => 'Sikkim'
            ],
            [
                'country_id' => '105', 
                'name' => 'Tamil Nadu'
            ],
            [
                'country_id' => '105', 
                'name' => 'Telangana'
            ],
            [
                'country_id' => '105', 
                'name' => 'Tripura'
            ],
            [
                'country_id' => '105', 
                'name' => 'Uttar Pradesh'
            ],
            [
                'country_id' => '105', 
                'name' => 'Uttarakhand'
            ],
            [
                'country_id' => '105', 
                'name' => 'West Bengal'
            ],
        ];
  
        foreach ($states as $key => $value) {
            State::create($value);
        }
    }
}
