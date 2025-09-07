<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisAktivitas extends Model
{
    use HasFactory;
    protected $table = 'jenis_aktivitas';

    protected $fillable = ['name'];

    public function aktivitas()
    {
        return $this->hasMany(Aktivitas::class);
    }
}
