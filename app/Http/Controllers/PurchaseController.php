<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Purchases;
use App\Models\PurchaseDetails;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use Excel;

class PurchaseController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $purchases = Purchases::with(['users'])
              ->where('created_by', Auth::user()->idusers)
              ->get();
    // return $purchases;
    $content = [
      'purchase' => $purchases
    ];

    $pagecontent = view('purchase.index', $content);

  //masterpage
    $pagemain = array(
        'title' => 'Purchase',
        'menu' => 'purchase',
        'submenu' => '',
        'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
  }

  public function create_page()
  {
    $content = [
      'products' => Products::where('active', TRUE)->get()
    ];

    // return $content;
    $pagecontent = view('purchase.create', $content);

  //masterpage
    $pagemain = array(
        'title' => 'Purchase',
        'menu' => 'purchase',
        'submenu' => '',
        'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
  }

  public function save_create(Request $request)
  {
    // return $request->all();

    $request->validate([
      'name' => 'required|max:225',
      'date' => 'required|date'
    ]);

    $idproduct = $request->idproduct;
    $description = $request->description;
    $pembayaran = $request->pembayaran;
    $qty = $request->qty;
    $pendapatan = $request->pendapatan;
    $biaya = $request->biaya;
    $laba = $request->laba;

    for ($i=0; $i < count($idproduct) ; $i++) {
      if ($idproduct[$i] == 0) {
        return redirect()->back()->with('status_error', 'items null');
      }
    }

    $save_purchases = new Purchases;
    $save_purchases->idpurchases =  Uuid::uuid4();
    $save_purchases->name = $request->name;
    $save_purchases->date = date('Y-m-d', strtotime($request->date));
    $save_purchases->total = $request->total;
    $save_purchases->save();

    for ($i=0; $i < count($idproduct) ; $i++) {
      $save_pr_detail = new PurchaseDetails;
      $save_pr_detail->idpurchasedetails = Uuid::uuid4();
      $save_pr_detail->idpurchases = $save_purchases->idpurchases;
      $save_pr_detail->idproducts = $idproduct[$i];
      $save_pr_detail->description = $description[$i];
      $save_pr_detail->payments = $pembayaran[$i];
      $save_pr_detail->qty = $qty[$i];
      $save_pr_detail->pendapatan = $pendapatan[$i];
      $save_pr_detail->biaya = $biaya[$i];
      $save_pr_detail->laba = $laba[$i];
      $save_pr_detail->save();
    }
    return redirect('purchase')->with('success','Successfully created purchase');
  }

  public function update_page(Purchases $purchase)
  {
    $purchase = Purchases::with(['users',
                  'purchase_details' => function($prdet){
                    $prdet->with('products');
                  }
                ])
                ->where('idpurchases', $purchase->idpurchases)
                ->first();

    $content = [
      'products' => Products::where('active', TRUE)->get(),
      'purchase' => $purchase
    ];

    // return $content;
    $pagecontent = view('purchase.update', $content);

  //masterpage
    $pagemain = array(
        'title' => 'Purchase',
        'menu' => 'purchase',
        'submenu' => '',
        'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
  }

  public function update_save(Request $request, Purchases $purchase)
  {
    $request->validate([
      'name' => 'required|max:225',
      'date' => 'required|date'
    ]);

    $idprdet = $request->idprdetails;
    $idproduct = $request->idproduct;
    $description = $request->description;
    $pembayaran = $request->pembayaran;
    $qty = $request->qty;
    $pendapatan = $request->pendapatan;
    $biaya = $request->biaya;
    $laba = $request->laba;

    $save_purchases = Purchases::find($purchase->idpurchases);
    $save_purchases->name = $request->name;
    $save_purchases->date = date('Y-m-d', strtotime($request->date));
    $save_purchases->total = $request->total;
    $save_purchases->save();

    for ($i=0; $i < count($idprdet) ; $i++) {
      if ($idprdet[$i] == 'new') {
        $save_pr_detail = new PurchaseDetails;
        $save_pr_detail->idpurchasedetails = Uuid::uuid4();
        $save_pr_detail->idpurchases = $save_purchases->idpurchases;
      }else{
        $save_pr_detail = PurchaseDetails::find($idprdet[$i]);
      }
      $save_pr_detail->idproducts = $idproduct[$i];
      $save_pr_detail->description = $description[$i];
      $save_pr_detail->payments = $pembayaran[$i];
      $save_pr_detail->qty = $qty[$i];
      $save_pr_detail->pendapatan = $pendapatan[$i];
      $save_pr_detail->biaya = $biaya[$i];
      $save_pr_detail->laba = $laba[$i];
      $save_pr_detail->save();
    }

    $deleteidprd = $request->deleteindex;

    if (strlen($deleteidprd) > 0) {
        $delidprd = explode(',', $deleteidprd);
        $idprd  = array_values(array_filter($delidprd));
        PurchaseDetails::whereIn('idpurchasedetails',$idprd)->delete();
    }

    return redirect('purchase')->with('success','Successfully created purchase');
  }

  public function delete(Purchases $purchase)
  {
    $idpurchase = $purchase->idpurchases;
    $purchase = Purchases::where('idpurchases',$purchase->idpurchases);
    $purchase->delete();

    $purchase_details = PurchaseDetails::where('idpurchases',$idpurchase)->get();

    foreach ($purchase_details as $prdet) {
      PurchaseDetails::where('idpurchases',$prdet->idpurchases)->delete();
    }
    return redirect('purchase')->with('success','Successfully deleted purchase');
  }

  public function show(Request $request)
  {
      if (!$request->has('startdate') || !$request->has('enddate') || !$request->has('product')) {
        $startdate = 'startdate='.date('Y-m-d');
        $enddate = 'enddate='.date('Y-m-d');
        $product = 'product=';
        return redirect('/purchase/show?'.$startdate.'&'.$enddate.'&'.$product);
      }

      $prdets = PurchaseDetails::join('purchases','purchase_details.idpurchases','=','purchases.idpurchases')
                ->join('products','purchase_details.idproducts','=','products.idproducts')
                ->select(
                  'purchases.created_by as purchase_created',
                  'purchases.date as purchase_date',
                  'purchases.name as purchase_name',
                  'products.name as pro_name',
                  'products.idproducts as idproduct',
                  'purchase_details.qty as qty',
                  'purchase_details.pendapatan as pendapatan',
                  'purchase_details.biaya as biaya',
                  'purchase_details.laba as laba'


                  )
                ->where('purchases.created_by', Auth::user()->idusers)
                ->whereBetween('date',[$request->startdate,$request->enddate]);
                // ->get();
      if (strlen($request->product) > 0) {
        $prdets->where('products.idproducts', $request->product);
      }

      $content = [
        'prdets' => $prdets->get(),
        'products' => Products::where('active', TRUE)->get(),
      ];

      // return $content;
      $pagecontent = view('purchase.show', $content);

    //masterpage
      $pagemain = array(
          'title' => 'Purchase Show',
          'menu' => 'purchase',
          'submenu' => '',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
  }

  public function excel(Request $request)
  {
    if ($request->has('startdate') && $request->has('enddate') || $request->has('product')) {
      $prdets = PurchaseDetails::join('purchases','purchase_details.idpurchases','=','purchases.idpurchases')
                ->join('products','purchase_details.idproducts','=','products.idproducts')
                ->select(
                  'purchases.created_by as purchase_created',
                  'purchases.date as purchase_date',
                  'purchases.name as purchase_name',
                  'products.name as pro_name',
                  'products.idproducts as idproduct',
                  'purchase_details.qty as qty',
                  'purchase_details.pendapatan as pendapatan',
                  'purchase_details.biaya as biaya',
                  'purchase_details.laba as laba'


                  )
                ->where('purchases.created_by', Auth::user()->idusers)
                ->whereBetween('date',[$request->startdate,$request->enddate]);
                // ->get();
      if (strlen($request->product) > 0) {
        $prdets->where('products.idproducts', $request->product);
      }

      if (strlen($request->startdate) > 0 && strlen($request->enddate) > 0 || strlen($request->product) > 0) {
        $dataall = $prdets->get();
        // return $dataall;
      }
      $dataexcel = [];
      foreach ($dataall as $dataprdet) {
        $dataexcel[] = [
          'product' => $dataprdet->pro_name,
          'date' => date('Y-m-d',strtotime($dataprdet->purchase_date)),
          'qty' => $dataprdet->qty,
          'pendapatan' => $dataprdet->pendapatan,
          'biaya' => $dataprdet->biaya,
          'laba' => $dataprdet->laba
        ];
      }

      // return $dataexcel;
      Excel::create('Purchase Product Per Cabang', function($excel) use ($dataexcel) {
              $excel->sheet('Purchase', function($sheet) use ($dataexcel) {
                  //set the titles
                  $sheet->fromArray($dataexcel,null,'A1',false,false)->prependRow(
                      array(
                        'Product', 'Date','Qty','Pendapatan','Biaya','Laba'
                      )
                  );
              });
          })->export('xls');
    }
  }
}
