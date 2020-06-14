<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotes extends Model
{
  use SoftDeletes;
  public $incrementing = false;
  protected $table = 'quotes';
  protected $primaryKey = 'idquotes';

  public function users()
  {
    return $this->belongsTo('App\Models\User','idusers');
  }

  public function tags()
  {
    return $this->belongsToMany('App\Models\Tags','quote_tag','idquotes','idtags');
  }

}
