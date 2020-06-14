<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Universities;
use Ramsey\Uuid\Uuid;

class UniversitiesController extends Controller
{
  public function index()
  {
    // code...
      $content = [
        'universities' => Universities::where('active',TRUE)->get(),
      ];
      $pagecontent = view('admin.master.universities.index', $content);
      //masterpage
      $pagemain = array(
        'title' => 'Universities',
        'menu' => 'master',
        'submenu' => 'unive',
        'pagecontent' => $pagecontent,
      );
      return view('admin/masterpage', $pagemain);
    }

    public function create_page()
    {
      $content = [
        // 'tags' => Tags::all(),
      ];
      $pagecontent = view('admin.master.universities.create', $content);
      //masterpage
      $pagemain = array(
        'title' => 'Universities',
        'menu' => 'master',
        'submenu' => 'unive',
        'pagecontent' => $pagecontent,
      );
      return view('admin/masterpage', $pagemain);
    }

    public function save_page(Request $request)
    {
      $request->validate([
           'name' => 'required',
           'email' => 'required|email|unique:universities',
           'no_telp1' => 'required',
           'address' => 'required',
           'type' => 'required|min:1'
       ]);
       //active
       $active = FALSE;
       if($request->has('active')) {
           $active = TRUE;
       }

       $save_unive = new Universities;
       $save_unive->iduniversities = Uuid::uuid4();
       $save_unive->name = $request->name;
       $save_unive->address = $request->address;
       $save_unive->email = $request->email;
       $save_unive->no_telp1 = $request->no_telp1;
       $save_unive->no_telp2 = $request->no_telp2;
       $save_unive->type = $request->type;
       $save_unive->active = $active;
       $save_unive->save();

       return redirect('admin/master/universities')->with('success','Successfully created universitas');
    }

    public function update_page(Universities $unive)
    {
      $content = [
        'universities' => Universities::where('iduniversities',$unive->iduniversities)->first(),
      ];

      $pagecontent = view('admin.master.universities.update', $content);
      //masterpage
      $pagemain = array(
        'title' => 'Universities',
        'menu' => 'master',
        'submenu' => 'unive',
        'pagecontent' => $pagecontent,
      );
      return view('admin/masterpage', $pagemain);
    }

    public function update_save(Universities $unive, Request $request)
    {
      $request->validate([
           'name' => 'required',
           'email' => 'required|email',
           'no_telp1' => 'required',
           'address' => 'required',
           'type' => 'required|min:1'
       ]);

       //active
       $active = FALSE;
       if($request->has('active')) {
           $active = TRUE;
       }

       $update_unive = Universities::find($unive->iduniversities);
       $update_unive->name = $request->name;
       $update_unive->address = $request->address;
       $update_unive->email = $request->email;
       $update_unive->no_telp1 = $request->no_telp1;
       $update_unive->no_telp2 = $request->no_telp2;
       $update_unive->type = $request->type;
       $update_unive->active = $active;
       $update_unive->save();

       return redirect('admin/master/universities')->with('success','Successfully updated universitas');
    }

    public function delete(Request $request)
    {
      $delete_unive = Universities::where('iduniversities', $request->iduniversities);
      $delete_unive->delete();
      return redirect('admin/master/universities')->with('success','Successfully deleted universitas');

    }
}
