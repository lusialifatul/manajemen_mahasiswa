<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    use HasFactory;

    protected $table = 'krs';

    protected $fillable = [
        'mahasiswa_id',
        'dosen_pembimbing_id',
        'semester',
        'tahun_akademik',
        'total_sks',
        'status',
        'catatan_revisi',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function dosenPembimbing()
    {
        return $this->belongsTo(User::class, 'dosen_pembimbing_id');
    }

    public function jadwals()
    {
        return $this->belongsToMany(Jadwal::class, 'krs_detail');
    }

    public function krsDetails()
    {
        return $this->hasMany(KrsDetail::class);
    }
}