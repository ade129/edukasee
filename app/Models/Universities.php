<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Universities extends Model
{
  use SoftDeletes;
  public $incrementing = false;
  protected $table = 'universities';
  protected $primaryKey = 'iduniversities';

  protected $casts = [
      'active' => 'boolean'
  ];

}
