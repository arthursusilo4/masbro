<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';
    protected $fillable = ['role_id', 'name'];

    public function users()
    {
        return $this->hasMany(User::class, 'jabatan_id');
    }
}
