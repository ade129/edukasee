<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;

class UsersTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(User $user)
    {
       $roles = ['s','a'];
       foreach ($roles as $role) {
         $save_user = new User;
         $save_user->idusers = Uuid::uuid4();
         if ($role == 's') {
           $save_user->name = 'Super Admin';
           $save_user->email ='root@root.com';
           $save_user->password =  bcrypt('rootroot');
        }elseif($role == 'a') {
           $save_user->name = 'Admin';
           $save_user->email ='admin@admin.com';
           $save_user->password =  bcrypt('123456');
        }
         $save_user->role = $role;
         $save_user->save();
    }


    }
}
