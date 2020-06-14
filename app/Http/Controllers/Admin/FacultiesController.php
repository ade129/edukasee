<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacultiesController extends Controller
{
  public function index()
  {


    $content = [

    ];

    $pagecontent = view('admin.master.faculties.index', $content);

  //masterpage
    $pagemain = array(
        'title' => 'Faculties',
        'menu' => 'master',
        'submenu' => 'faculties',
        'pagecontent' => $pagecontent,
    );

    return view('admin/masterpage', $pagemain);
  }

  public function create_page()
  {
    $content = [

    ];

    $pagecontent = view('admin.master.faculties.create', $content);

  //masterpage
    $pagemain = array(
        'title' => 'Faculties',
        'menu' => 'master',
        'submenu' => 'faculties',
        'pagecontent' => $pagecontent,
    );

    return view('admin/masterpage', $pagemain);
  }
}
