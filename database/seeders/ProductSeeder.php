<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        Product::insert([
            [
                'name'              => 'Product A',
                'available_stock'   => 100,
                'updated_at'        => $now,
                'created_at'        => $now
            ],
            [
                'name'              => 'Product B',
                'available_stock'   => 200,
                'updated_at'        => $now,
                'created_at'        => $now
            ],
            [
                'name'              => 'Product C',
                'available_stock'   => 300,
                'updated_at'        => $now,
                'created_at'        => $now
            ],
            
        ]);
    }
}
