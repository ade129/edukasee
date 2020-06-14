<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
  public $incrementing = false;
  protected $table = 'products';
  protected $primaryKey = 'idproducts';

  protected $casts = [
      'active' => 'boolean'
  ];
}
