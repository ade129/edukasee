<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products;
use Ramsey\Uuid\Uuid;

class ProductController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $content = [
      'products' => Products::all()
    ];

    $pagecontent = view('master.products.index', $content);

  //masterpage
    $pagemain = array(
        'title' => 'Product',
        'menu' => 'master',
        'submenu' => 'product',
        'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
  }

  public function create_page()
  {
    $content = [

    ];

    $pagecontent = view('master.products.create', $content);

  //masterpage
    $pagemain = array(
        'title' => 'Product',
        'menu' => 'master',
        'submenu' => 'product',
        'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
  }
  public function save_create(Request $request)
  {
    $request->validate([
      'name' => 'required'
    ]);

    $active = FALSE;
    if ($request->has('active')) {
      $active = TRUE;
    }

    $save_product = new Products;
    $save_product->idproducts = Uuid::uuid4();

    $save_product->name = $request->name;
    $save_product->active = $active;
    $save_product->save();
    return redirect('master/product')->with('success','Successfully created product');
  }

  public function update_page(Products $product)
  {
    $content = [
      'product' => $product
    ];

    $pagecontent = view('master.products.update', $content);

  //masterpage
    $pagemain = array(
        'title' => 'Product',
        'menu' => 'master',
        'submenu' => 'product',
        'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
  }

  public function save_update(Request $request,Products $product)
  {
    $request->validate([
      'name' => 'required'
    ]);

    $active = FALSE;
    if ($request->has('active')) {
      $active = TRUE;
    }

    $save_product = Products::find($product->idproducts);
    $save_product->name = $request->name;
    $save_product->active = $active;
    $save_product->save();
    return redirect('master/product')->with('success','Successfully update product');
  }

  public function delete(Products $product)
  {
    $product = Products::find($product->idproducts);
    $product->delete();
    return redirect('master/product')->with('success','Successfully deleted product');

  }
}
