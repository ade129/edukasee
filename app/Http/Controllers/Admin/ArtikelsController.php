<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Quotes;
use App\Models\Tags;
use Ramsey\Uuid\Uuid;
use Image;
use Illuminate\Support\Str;
use File;

class ArtikelsController extends Controller
{
    public function index()
    {
      $content = [
        'quotes' => Quotes::with('users')->get(),
      ];
      // return $content;
      $pagecontent = view('admin.artikels.index', $content);

    //masterpage
      $pagemain = array(
          'title' => 'Artikel',
          'menu' => 'artikel',
          'submenu' => '',
          'pagecontent' => $pagecontent,
      );

      return view('admin/masterpage', $pagemain);
    }

    public function create_page()
    {
      $tag = Tags::where('active', TRUE)->get();
      $content = [
        'tags' => $tag,
      ];

      $pagecontent = view('admin.artikels.create-page', $content);

    //masterpage
      $pagemain = array(
          'title' => 'Artikel',
          'menu' => 'artikel',
          'submenu' => '',
          'pagecontent' => $pagecontent,
      );

      return view('admin/masterpage', $pagemain);
    }

    public function create_save(Request $request)
    {
      $request->validate([
           'title' => 'required',
           'body' => 'required',
           // 'photos_quotes' => 'required',
       ]);

       $slug = str_slug($request->title,'-');
        if (Quotes::where('slug',$slug)->first() !=null)
        $slug = $slug .'-'.time();

        $photos = $request->photos;
        // $filename = $photos->getClientOriginalName();
        $filename = Str::random(10).'.'.$photos->getClientOriginalExtension();
        $destinationPath = 'img-quote';
        $photos->move($destinationPath, $filename);

       $save_quotes = new Quotes;
       $save_quotes->idquotes = Uuid::uuid4();
       $save_quotes->title = $request->title;
       $save_quotes->body = $request->body;
       $save_quotes->slug = $slug;
       $save_quotes->photos_quotes = $filename;
       $save_quotes->idusers = \Auth::user()->idusers;
       $save_quotes->save();


       $save_quotes->tags()->attach($request->tags);
       return redirect('admin/artikel')->with('success', 'Successfully create artikel');

    }

    public function update_page(Quotes $quotes)
    {
      $quotes = Quotes::with('users')->where('idquotes',$quotes->idquotes)->first();
      // return $quotes;
      $selected = [];
      foreach ($quotes->tags as $tag) {
        $selected[]= $tag->idtags;
      }
      $tags = Tags::where('active', TRUE)->get();

      // return $selected;
      $content = [
        'tags' => $tags,
        'selected' => $selected,
        'quotes' => $quotes,
      ];

      $pagecontent = view('admin.artikels.update', $content);

    //masterpage
      $pagemain = array(
          'title' => 'Artikel',
          'menu' => 'artikel',
          'submenu' => '',
          'pagecontent' => $pagecontent,
      );

      return view('admin/masterpage', $pagemain);
    }

    public function update_save(Request $request,Quotes $quotes)
    {
      // return $slug;
      $request->validate([
           'title' => 'required',
           'body' => 'required',
           'photos' => 'mimes:jpeg,jpg,png|image',
       ]);
       $slug = str_slug($request->title,'-');
        $quote = Quotes::where('slug',$slug)->first();
        if ($quote != NULL )
        {
          $slug = $slug;
        }

       $update_quotes =  Quotes::find($quotes->idquotes);
       $update_quotes->title = $request->title;
       $update_quotes->body = $request->body;
       $update_quotes->slug = $slug;
       //update photo
       $filename  = public_path('img-quote/').$update_quotes->photos_quotes;
       if (File::exists($filename)) {
         $photos = $request->photos;
         $filephoto = Str::random(10).'.'.$photos->getClientOriginalExtension();
         $destinationPath = 'img-quote';
         $photos->move($destinationPath, $filephoto);
         $update_quotes->photos_quotes = $filephoto;
       }
       $update_quotes->idusers = \Auth::user()->idusers;
       $update_quotes->save();
       //replace image
       File::delete($filename);  
       //tag update
       $update_quotes->tags()->sync($request->tags);

       return redirect('admin/artikel')->with('success', 'Successfully updated artikel');
    }

    public function delete(Request $request)
    {
      $quotes = Quotes::where('idquotes',$request->idquotes)->first();
      $quotes->delete();

      $filename  = public_path('img-quote/').$quotes->photos_quotes;
      if (File::exists($filename)) {
          File::delete($filename);
      }
      return redirect('admin/artikel')->with('success', 'Successfully delete artikel');

    }
}
