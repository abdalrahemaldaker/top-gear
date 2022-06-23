<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpParser\Node\Expr\Assign;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name'=>'admin2','email'=>'admin@topgear.test','password'=>'password'])->assignrole('admin');
        User::create(['name'=>'entry','email'=>'entry@topgear.test','password'=>'password'])->assignrole('entry');
    }
}
