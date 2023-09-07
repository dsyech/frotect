<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cut extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'id_telegram',
        'name',
        'phone_number',
        'witel',
        'link',
        'report',
        'photo',
        'lat',
        'long',
        'date',
        'created_at',
        'updated_at',
    ];
}