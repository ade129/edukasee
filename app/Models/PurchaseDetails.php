<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PurchaseDetails extends Model
{
  use SoftDeletes;

  public $incrementing = false;
  protected $table = 'purchase_details';
  protected $primaryKey = 'idpurchasedetails';

  protected static function boot()
  {
    parent::boot();

    static::creating(function ($model) {
        $model->created_by = Auth::user()->idusers;
        return true;
    });

    static::updating(function ($model) {
        $model->updated_by = Auth::user()->idusers;
        return true;
    });
  }

  public function products()
  {
    return $this->belongsTo('App\Models\Products', 'idproducts');
  }

  public function purchases()
  {
    return $this->belongsTo('App\Models\Purchases', 'idpurchases');
  }

}
