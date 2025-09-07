<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisPromosi extends Model
{
    use HasFactory;

    protected $table = 'jenis_promosi';
    protected $fillable = ['name'];
}
