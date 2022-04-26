<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    protected $fillable = ['name','parent_id','type'];

    protected $table = 'department';

    use SoftDeletes;
}
