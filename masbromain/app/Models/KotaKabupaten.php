<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KotaKabupaten extends Model
{
    protected $table = 'kota_kabupaten';
    public function kecamatan() {
        return $this->hasMany(Kecamatan::class);
    }
}
