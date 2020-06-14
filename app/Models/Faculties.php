<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\DatabaseEloquent\SoftDeletes;

class Faculties extends Model
{
  use SoftDeletes;
  public $incrementing = false;
  protected $table = 'faculties';
  protected $primaryKey = 'idfaculties';
}
