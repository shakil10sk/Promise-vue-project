<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    protected $fillable = ['branch_name'];

    protected $table = 'branches';

    use SoftDeletes;

}
