<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBranding extends Model
{
    use HasFactory;

    protected $table = 'jenis_branding';
    protected $fillable = ['name'];

    public function branding()
    {
        return $this->hasMany(Branding::class);
    }

    public function details()
    {
        return $this->hasMany(BrandingDetail::class, 'jenis_branding_id');
    }
}
