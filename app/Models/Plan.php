<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'witel',
        'link_a',
        'link_b',
        'activity',
        'km',
        'name',
        'phone_number',
        'operator',
        'operator_pic',
        'operator_phone_number',
        'date',
        'created_at',
        'updated_at',
    ];
}
