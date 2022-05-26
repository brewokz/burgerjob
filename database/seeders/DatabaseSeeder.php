<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'fullname' => 'Dani',
            'username' => 'dani',
            'email' => 'dani@gmail.com',
            'password' => Hash::make('123456'),
            'is_admin' => true,
            'sex' => 'male',
            'address' => 'munich',
            'is_deleted' => false,
            'phone_number' => '08123456789',
            'profile_picture' => 'unknown.png'
        ]);
        User::create([
            'fullname' => 'Erik',
            'username' => 'erik',
            'email' => 'erik@gmail.com',
            'password' => Hash::make('123456'),
            'is_admin' => false,
            'sex' => 'male',
            'address' => 'amsterdam',
            'is_deleted' => false,
            'phone_number' => '08123456780',
            'profile_picture' => 'unknown.png'
        ]);

        Product::create([
            'sku' => '12X2D8',
            'name' => 'Cheese Burger',
            'quantity' => '200',
            'description' => 'Burger with mozzarela',
            'price' => '50000',
            'is_deleted' => false,
            'product_picture' => '1647635177_product.jpg'
        ]);

        Product::create([
            'sku' => '13X2D8',
            'name' => 'Double Burger',
            'quantity' => '200',
            'description' => 'Burger with double beef',
            'price' => '50000',
            'is_deleted' => false,
            'product_picture' => '1647635198_product.jpg'
        ]);

        Product::create([
            'sku' => '14X2D8',
            'name' => 'Sweet Burger',
            'quantity' => '200',
            'description' => 'Burger with sweet paty',
            'price' => '50000',
            'is_deleted' => false,
            'product_picture' => '1647635217_product.jpg'
        ]);
        Product::create([
            'sku' => '15X2D8',
            'name' => 'Chicken Burger',
            'quantity' => '200',
            'description' => 'Burger with chicken',
            'price' => '50000',
            'is_deleted' => false,
            'product_picture' => '1647635251_product.jpg'
        ]);
        Product::create([
            'sku' => '16X2D8',
            'name' => 'Blackpaper Burger',
            'quantity' => '200',
            'description' => 'Burger with blackpaper',
            'price' => '50000',
            'is_deleted' => false,
            'product_picture' => '1647635263_product.jpg'
        ]);
        Product::create([
            'sku' => '16A2D8',
            'name' => 'Coca Cola',
            'quantity' => '500',
            'description' => 'Coke 500ml',
            'price' => '12000',
            'is_deleted' => false,
            'product_picture' => 'coca_cola.jpg'
        ]);
        Product::create([
            'sku' => '15A2C8',
            'name' => 'Pepsi',
            'quantity' => '500',
            'description' => 'Pepsi 500ml',
            'price' => '12000',
            'is_deleted' => false,
            'product_picture' => 'pepsi.jpg'
        ]);
    }
}
