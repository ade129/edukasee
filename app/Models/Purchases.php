<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Purchases extends Model
{
  use SoftDeletes;

  public $incrementing = false;
  protected $table = 'purchases';
  protected $primaryKey = 'idpurchases';

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

  public function users()
  {
    return $this->belongsTo('App\Models\User', 'created_by', 'idusers');
  }

  public function purchase_details()
  {
    return $this->hasMany('App\Models\PurchaseDetails', 'idpurchases');
  }
}
