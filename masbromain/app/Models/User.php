<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nik',
        'name',
        'email',
        'password',
        'role_id',
        'branch_id',
        'cluster_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Use NIK for login instead of email
     */
    public function username()
    {
        return 'nik';
    }

    public function getEmailForPasswordReset()
    {
        return $this->nik;
    }

    public function backchecks()
    {
        return $this->hasMany(Backcheck::class);
    }

    public function brandings()
    {
        return $this->hasMany(Branding::class);
    }

    public function infokompetitors()
    {
        return $this->hasMany(Infokompetitor::class);
    }

    public function aktivitas()
    {
        return $this->hasMany(Aktivitas::class);
    }

    public function sessionjabatan()
    {
        return $this->hasMany(SessionJabatan::class);
    }

    public function cluster()
    {
        return $this->belongsTo(Cluster::class, 'cluster_id');
    }

}
