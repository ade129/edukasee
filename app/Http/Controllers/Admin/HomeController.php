<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Purchases;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
      $user_login = User::where('last_login','!=' ,NULL)
                    ->orderBy('last_login','desc')
                    ->limit(8)
                    ->get();

      $users = User::whereNotIn('role',['s'])->get();
      $per_purchase =  Purchases::where('created_by',Auth::user()->idusers)->first();
      // return $per_purchase ;
      $content = [
        'per_purchase' =>  $per_purchase,
        'users' => $users,
        'user_login' => $user_login,
        'purchase' => Purchases::all()
      ];

      $pagecontent = view('home.index', $content);

    //masterpage
      $pagemain = array(
          'title' => 'Home',
          'menu' => 'home',
          'submenu' => '',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }
}
