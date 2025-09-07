<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aktivitas extends Model
{
    use HasFactory;
    protected $table = 'aktivitas';

    protected $fillable = [
        'user_id',
        'jabatan_id',
        'branch_id',
        'cluster_id',
        'kota_kabupaten_id',
        'kecamatan_id',
        'jenis_activity_id',
        'activity_name',
        'activity_detail'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function cluster()
    {
        return $this->belongsTo(Cluster::class, 'cluster_id');
    }

    public function kotaKabupaten()
    {
        return $this->belongsTo(KotaKabupaten::class, 'kota_kabupaten_id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jenisAktivitas()
    {
        return $this->belongsTo(JenisAktivitas::class);
    }

     public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }
}
