<?php

use Illuminate\Database\Seeder;
use App\Quyen;
use App\Admin;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        $adminRoles = Quyen::where('roles_id','1')->where('roles_name','Admin')->first();
        $EditorRoles = Quyen::where('roles_id','2')->where('roles_name','Editor')->first();
        $CensorshipRoles = Quyen::where('roles_id','3')->where('roles_name','Censorship')->first();
        $UserRoles = Quyen::where('roles_id','4')->where('roles_name','User')->first();

        $Admin = Admin::create([
            'admin_name'=>'duykhanhadmin',
            'admin_email'=>'khanh@gmail.com',
            'admin_phone'=>'12345678912',
            'admin_password'=>bcrypt('123456')


        ]);
        $Editor = Admin::create([
            'admin_name'=>'duykhanheditor',
            'admin_email'=>'khanh1@gmail.com',
            'admin_phone'=>'12345678912',
            'admin_password'=>bcrypt('123456')
        ]);
        $Censorship = Admin::create([
            'admin_name'=>'duykhanhcensorship',
            'admin_email'=>'khanh2@gmail.com',
            'admin_phone'=>'12345678912',
            'admin_password'=>bcrypt('123456')
        ]);
        $user = Admin::create([
            'admin_name'=>'duykhanhUser',
            'admin_email'=>'khanh3@gmail.com',
            'admin_phone'=>'12345678912',
            'admin_password'=>bcrypt('123456')
        ]);

        $Admin->roles()->attach($adminRoles);
        $Editor->roles()->attach( $EditorRoles);
       $Censorship->roles()->attach($CensorshipRoles);
       $user->roles()->attach($UserRoles);
    }
}
