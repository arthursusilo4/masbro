<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branding extends Model
{
    use HasFactory;

    protected $table = 'branding';
    protected $fillable = [
        'user_id',
        'jabatan_id',
        'branch_id',
        'cluster_id',
        'kota_kabupaten_id',
        'kecamatan_id',
        'outlet_id',
        'outlet_name',
        'latitude',
        'longitude'
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
    public function brandingDetail()
    {
        return $this->hasMany(BrandingDetail::class, 'branding_id');
    }

     public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }
}
