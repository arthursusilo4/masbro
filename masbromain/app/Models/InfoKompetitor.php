<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InfoKompetitor extends Model
{
    use HasFactory;

    protected $table = 'infokompetitor';

    protected $fillable = [
        'user_id',
        'jabatan_id',
        'branch_id',
        'cluster_id',
        'kota_kabupaten_id',
        'kecamatan_id',
        'channel',
        'outlet_id',
        'outlet_name',
        'kompetitor_id',
        'promotion_id',
        'photo',
        'latitude',
        'longitude',
    ];

    public function branch() {
        return $this->belongsTo(Branch::class);
    }
    public function cluster() {
        return $this->belongsTo(Cluster::class);
    }
    public function kotaKabupaten() {
        return $this->belongsTo(KotaKabupaten::class);
    }
    public function kecamatan() {
        return $this->belongsTo(Kecamatan::class);
    }
    public function kompetitor() {
        return $this->belongsTo(Kompetitor::class, 'kompetitor_id');
    }
    public function promotion() {
        return $this->belongsTo(JenisPromosi::class, 'promotion_id');
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
     public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }
}
