<?php

namespace Innerent\Contacts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'country_code',
        'area_code',
        'number',
        'type',
        'description',
    ];

    public function setNumberAttribute($value)
    {
        $this->attributes['number'] = preg_replace('/[^0-9]/', '', $value);
    }

    public function setCountryCodeAttribute($value)
    {
        $this->attributes['country_code'] = preg_replace('/[^0-9]/', '', $value);
    }

    public function setAreaCodeAttribute($value)
    {
        $this->attributes['area_code'] = preg_replace('/[^0-9]/', '', $value);
    }
}
