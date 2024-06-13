<?php

namespace Database\Seeders;

use App\Models\OrderDetails;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(500)
            ->hasOrders(3)
            ->hasDetails()
            ->create()
            ->each(function ($user) {
                $user->orders->each(function ($order) {
                    $order->details()->saveMany(OrderDetails::factory()->count(2)->make());
                });
            });
    }
}
