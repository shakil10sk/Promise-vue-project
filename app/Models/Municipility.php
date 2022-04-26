<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Municipility extends Model
{
    protected $fillable = [
        'code',
        'name',
        'logo',
        'division_id',
        'district_id',
        'estabilish_year',
        'email',
        'website',
        'fax',
        'class',
        'status'
    ];

    use SoftDeletes;


    public function getLogoAttribute($value)
    {
        $logo = empty($value) ?  'defaultimage.png' : '/municipility/' . $value;

        return $logo;
    }

    public function district()
    {
        return $this->hasOne(BdLocation::class, 'id', 'district_id');
    }

    public function division()
    {
        return $this->hasOne(BdLocation::class, 'id', 'division_id');
    }


}
