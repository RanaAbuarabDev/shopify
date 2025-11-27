<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateAdminComand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::transaction(function () {
            $admin = Admin::query()->create([]);
            $name=$this->ask("enter admin name");
            $email=$this->ask("enter admin email");
            $password=$this->ask("enter admin password");
            $admin->user()->create([
                'name' => $name,
                'email' => $email,
                'password' =>$password,
            ]);
        });
        $this->info("Admin created successfully");
    }
}
