<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionJabatan extends Model
{
    protected $table = 'session_jabatan';
    protected $fillable = ['session_id', 'user_id', 'jabatan_id'];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
