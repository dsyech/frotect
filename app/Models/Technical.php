<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technical extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    // public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'witel',
        'node',
        'platform',
        'ne',
        'shelf',
        'slot',
        'port',
        'type_from',
        'ne_from',
        'port_from',
        'type_to',
        'ne_to',
        'port_to',
        'keterangan',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];
}
