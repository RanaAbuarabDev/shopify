<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeedBasedData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //add admin
        DB::transaction(function () {
            $admin = Admin::query()->create([]);
            $admin->user()->create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('123456')
            ]);
        });
    }
}
