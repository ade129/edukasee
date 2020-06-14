<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UsersController extends Controller
{
    public function index()
    {

      $content = [
        'users' => User::whereNotIn('name',['Super Admin'])->get(),
      ];

      $pagecontent = view('master.users.index', $content);

    //masterpage
      $pagemain = array(
          'title' => 'Home',
          'menu' => 'master',
          'submenu' => 'users',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function create_page()
    {
      $content = [
        // 'users' => User::whereNotIn('name',['Super Admin'])->get(),
      ];

      $pagecontent = view('master.users.create', $content);

    //masterpage
      $pagemain = array(
          'title' => 'User',
          'menu' => 'master',
          'submenu' => 'users',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function create_save(Request $request)
    {
      $request->validate([
        'name' => 'required|max:225',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6'
      ]);

      $save_users = new User;
      $save_users->idusers = Uuid::uuid4();
      $save_users->name = $request->name;
      $save_users->email = $request->email;
      $save_users->role = $request->role;
      $save_users->password = Hash::make($request->password);
      $save_users->save();

      return redirect('master/user')->with('success', 'Successfully created users');
    }

    public function update_page(User $user)
    {
      $user = User::where('idusers',$user->idusers)->first();

      $content = [
        'users' => $user,
      ];
      // return $content;

      $pagecontent = view('master.users.update', $content);

    //masterpage
      $pagemain = array(
          'title' => 'User',
          'menu' => 'master',
          'submenu' => 'users',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function update_save(User $user, Request $request)
    {
      $user_update = User::find($user->idusers);
      $user_update->name = $request->name;
      $user_update->email = $request->email;
      $user_update->role = $request->role;
      $user_update->save();

      return redirect('master/user')->with('success', 'Successfully update users');
    }

}
