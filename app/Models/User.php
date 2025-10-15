<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

        public function pengumuman()
        {
            return $this->belongsToMany(Pengumuman::class, 'notifikasi_user')->withPivot('read_at')->withTimestamps();
        }
    
        public function notifikasiBelumDibaca()
        {
            return $this->pengumuman()->wherePivotNull('read_at');
        }
    
        /**
         * The attributes that are mass assignable.
         *
         * @var list<string>
         */    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * Get the mahasiswa record associated with the user.
     */
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    }

    /**
     * Get all the mahasiswa records guided by the user (dosen).
     */
    public function mahasiswaBimbingan()
    {
        return $this->hasMany(Mahasiswa::class, 'dosen_pembimbing_id');
    }
}
