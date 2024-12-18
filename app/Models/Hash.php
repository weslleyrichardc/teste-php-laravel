<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hash extends Model
{
    use HasFactory;

    protected $fillable = ['batch', 'block', 'string', 'key', 'hash', 'tries'];
}
