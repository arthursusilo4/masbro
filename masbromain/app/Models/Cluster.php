<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    protected $table = 'cluster';
    public function kotaKabupaten() {
        return $this->hasMany(KotaKabupaten::class);
    }
}
