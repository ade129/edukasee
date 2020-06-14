<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tags;
use Ramsey\Uuid\Uuid;

class TagsController extends Controller
{
    public function index()
    {

      $content = [
        'tags' => Tags::all(),
      ];
        $pagecontent = view('admin.master.tags.index', $content);
      //masterpage
        $pagemain = array(
            'title' => 'Tag',
            'menu' => 'master',
            'submenu' => 'tags',
            'pagecontent' => $pagecontent,
        );

        return view('admin/masterpage', $pagemain);
    }

    public function create_page()
    {
        $content = [];
        $pagecontent = view('admin.master.tags.create', $content);
      //masterpage
        $pagemain = array(
            'title' => 'Tag',
            'menu' => 'master',
            'submenu' => 'tags',
            'pagecontent' => $pagecontent,
        );

        return view('admin/masterpage', $pagemain);
    }

    public function save_page(Request $request)
    {
      $request->validate([
           'name' => 'required',
       ]);

       //active
       $active = FALSE;
       if($request->has('active')) {
           $active = TRUE;
       }
       $save_tags = new Tags;
       $save_tags->idtags = Uuid::uuid4();
       $save_tags->name = $request->name;
       $save_tags->active = $active;
       $save_tags->save();

       return redirect('admin/master/tags')->with('success','Successfully created tags');
    }

    public function update_page(Tags $tag)
    {
      $tags = Tags::where('idtags',$tag->idtags)->first();
      $content = [
          'tags' =>   $tags,
      ];

      $pagecontent = view('admin.master.tags.update', $content);

      $pagemain = array(
          'title' => 'Tag',
          'menu' => 'master',
          'submenu' => 'tags',
          'pagecontent' => $pagecontent,
      );

      return view('admin/masterpage', $pagemain);
    }

    public function update_save(Request $request ,Tags $tag)
    {
      $request->validate([
           'name' => 'required',
       ]);

       //active
       $active = FALSE;
       if($request->has('active')) {
           $active = TRUE;
       }
       $update_tags = Tags::find($tag->idtags);
       $update_tags->name = $request->name;
       $update_tags->active = $active;
       $update_tags->save();

       return redirect('admin/master/tags')->with('success','Successfully Updated tags');
    }

    public function delete(Request $request)
    {
      $tags = Tags::where('idtags',$request->idtags);
      $tags->delete();
      return redirect('admin/master/tags')->with('success','Successfully deleted tags');
    }
}
