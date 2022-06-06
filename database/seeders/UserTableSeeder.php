<?php

namespace Database\Seeders;
use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        $adminRoles = Roles::where('name','admin')->first();
        $authorRoles = Roles::where('name','author')->first();
        $userRoles = Roles::where('name','user')->first();

        $admin = Admin::create([
            'admin_name' => 'anhvuadmin',
            'admin_email' => 'anhvuadmin@gmail.com',
            'admin_phone' => '0999111222',
            'admin_password' => md5('123456')

        ]);
        $author = Admin::create([
            'admin_name' => 'anhvuauthor',
            'admin_email' => 'anhvuauthor@gmail.com',
            'admin_phone' => '0999111222',
            'admin_password' => md5('123456')

        ]);
        $user = Admin::create([
            'admin_name' => 'anhvuuser',
            'admin_email' => 'anhvuuser@gmail.com',
            'admin_phone' => '0999111222',
            'admin_password' => md5('123456')

        ]);

        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
        $user->roles()->attach($userRoles);


    }
}
