<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BdLocation extends Model
{
    protected $fillable = ['parent_id','name','type'];

    use SoftDeletes;
}
