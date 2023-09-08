<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slh extends Model
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
        'system',
        'ne',
        'shelf',
        'slot',
        'port',
        'level',
        'level_ref',
        'delta',
        'created_at',
        'updated_at',
    ];
}
