<?php

namespace Innerent\Contacts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'description',
        'street',
        'number',
        'complement',
        'neighborhood',
        'zip',
        'county',
        'city',
        'state',
        'country',
    ];
}
