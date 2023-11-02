<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GetInTouch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ([
        'name',
        'company_name',
        'contact_number',
        'date',
        'email',
        'message',
        'is_active',
    ]);
}
