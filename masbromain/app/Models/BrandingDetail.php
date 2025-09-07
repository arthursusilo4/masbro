<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandingDetail extends Model
{
    use HasFactory;

    protected $table = 'branding_detail';
    protected $fillable = [
        'branding_id',
        'jenis_branding_id',
        'photo',
    ];

    public function branding()
    {
        return $this->belongsTo(Branding::class, 'branding_id');
    }

    public function jenisBranding()
    {
        return $this->belongsTo(JenisBranding::class, 'jenis_branding_id');
    }
}
