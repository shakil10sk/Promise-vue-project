<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeQuota extends Model
{
    use SoftDeletes;

    protected $fillable = ['municipility_class', 'designation_id', 'total_quota'];

    private $municipility_class = [1 => 'ক', 2 => 'খ', 3 => 'গ'];


    public function getMunicipilityClassAttribute($value)
    {
        return $this->municipility_class[$value];
    }

    public function designation()
    {
        return $this->hasOne(Department::class, 'id', 'designation_id');
    }
}
