<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankBranch extends Model
{
    protected $fillable = ['district_id','bank_id','branch_name'];
    
    use SoftDeletes;
}
