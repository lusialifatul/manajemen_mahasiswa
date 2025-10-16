<?php

namespace App\Models;

use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mahasiswa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mahasiswa';

    protected $fillable = [
        'user_id',
        'dosen_pembimbing_id',
        'nim',
        'semester_aktif',
        'ipk',
        'nama_lengkap',
        'tgl_lahir',
        'gender',
        'jurusan',
        'alamat',
        'no_hp',
        'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dosenPembimbing()
    {
        return $this->belongsTo(User::class, 'dosen_pembimbing_id');
    }

    /**
     * Get the KRS records for the student.
     */
    public function krs(): HasMany
    {
        return $this->hasMany(Krs::class);
    }
}
