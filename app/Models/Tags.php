<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tags extends Model
{
    use SoftDeletes;
    public $incrementing = false;
    protected $table = 'tags';
    protected $primaryKey = 'idtags';

    protected $casts = [
        'active' => 'boolean'
    ];

  
}
