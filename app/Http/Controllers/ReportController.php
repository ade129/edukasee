<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchases;
use App\Models\PurchaseDetails;
use App\Models\Products;
use Excel;
class ReportController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index(Request $request)
  {
    if (!$request->has('product') || !$request->has('cabang')) {
      $startdate = 'startdate='.date('Y-m-d');
      $enddate = 'enddate='.date('Y-m-d');
      $product = 'product=';
      $cabang = 'cabang=';
      return redirect('report?'.$startdate.'&'.$enddate.'&'.$product.'&'.$cabang);
    }
    $purchase_details = PurchaseDetails::join('purchases','purchase_details.idpurchases','=','purchases.idpurchases')
                        ->join('products','purchase_details.idproducts','=','products.idproducts')
                        ->select(
                          'products.name as pro_name',
                          'purchases.name as pur_name',
                          'purchases.date as date_pur',
                          'purchase_details.qty as qty',
                          'purchase_details.pendapatan as pendapatan',
                          'purchase_details.biaya as biaya',
                          'purchase_details.laba as laba'
                        )
                        ->whereBetween('date',[$request->startdate,$request->enddate]);


    if (strlen($request->product) ) {
      $purchase_details->where('products.idproducts',$request->product);
    }
    if (strlen($request->cabang)) {
      $purchase_details->where('purchases.idpurchases',$request->cabang);
    }

    // $getprdet =  $purchase_details->get();

    $content = [
      'datapurchase' =>   $purchase_details->get(),
      'products' => Products::where('active',TRUE)->get(),
      'purchase' => Purchases::all()
    ];

    $pagecontent = view('report.index', $content);

  //masterpage
    $pagemain = array(
        'title' => 'Report',
        'menu' => 'report',
        'submenu' => '',
        'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
  }

  public function excel(Request $request)
  {
    if ($request->has('product') && $request->has('cabang')) {

      $purchase_details = PurchaseDetails::join('purchases','purchase_details.idpurchases','=','purchases.idpurchases')
                          ->join('products','purchase_details.idproducts','=','products.idproducts')
                          ->select(
                            'products.name as pro_name',
                            'purchases.name as pur_name',
                            'purchases.date as date_pur',
                            'purchase_details.qty as qty',
                            'purchase_details.pendapatan as pendapatan',
                            'purchase_details.biaya as biaya',
                            'purchase_details.laba as laba'
                          )->whereBetween('date',[$request->startdate,$request->enddate]);

      if (strlen($request->product) > 0 ) {
        $purchase_details->where('products.idproducts',$request->product);
      }
      if (strlen($request->cabang) > 0) {
        $purchase_details->where('purchases.idpurchases',$request->cabang);
      }

      if (strlen($request->startdate) > 0 && strlen($request->enddate) > 0 || strlen($request->product) > 0 || strlen($request->cabang) > 0) {
        $getprdet = $purchase_details->get();
      }

      $dataexcel = [];
      foreach ($getprdet as $datapr) {
        $dataexcel[] = [
          'cabang' =>  $datapr->pur_name,
          'product' => $datapr->pro_name,
          'date' => date('Y-m-d', strtotime($datapr->date_pur)),
          'qty' => $datapr->qty,
          'pendapatan'=> number_format($datapr->pendapatan),
          'biaya' => number_format($datapr->biaya),
          'laba' => number_format($datapr->laba)
        ];
      }
      // return $dataexcel;
      Excel::create('Purchase', function($excel) use ($dataexcel) {
	            $excel->sheet('Purchase', function($sheet) use ($dataexcel) {
	                //set the titles
	                $sheet->fromArray($dataexcel,null,'A1',false,false)->prependRow(
	                    array(
	                        'Cabang', 'Product', 'Date','Qty','Pendapatan','Biaya','Laba'
	                    )
	                );
	            });
	        })->export('xls');
    }
  }
}
