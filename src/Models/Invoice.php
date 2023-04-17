<?php

namespace Fridris\Invoice\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use  SoftDeletes;

    protected $fillable = [
        'id',
        'details',
    ];

    protected $casts = [
        'details'          => 'array',
    ];
}
