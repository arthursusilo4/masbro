<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Backcheck extends Model
{
    protected $table = 'backcheck';
    protected $fillable = [
        'user_id', 'jabatan_id', 'branch_id', 'cluster_id', 'kota_kabupaten_id',
        'kecamatan_id','outlet_id', 'outlet_name', 'owner_phone',
        'display_share', 'sales_share_perdana', 'sales_share_renewal',
        'laporan_path', 'display_paths', 'branding_path',
        'latitude', 'longitude'
    ];

    protected $casts = [
        'display_share' => 'array',
        'sales_share_perdana' => 'array',
        'sales_share_renewal' => 'array',
        'display_paths' => 'array',
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

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }
}
