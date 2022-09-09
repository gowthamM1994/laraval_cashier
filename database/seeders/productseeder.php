<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\product;
class productseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        product::insert([
            
            [
                'name' => 'tv',
                'price' => '5000',
                'description' => 'all contain tv available'
            ],
            [
                'name' => 'mobile',
                'price' => '10000',
                'description' => 'all contain mobile available'
            ],
            [
                'name' => 'laptop',
                'price' => '15000',
                'description' => 'all contain laptop available'
            ],
            
        ]);
        
        
    }
}
