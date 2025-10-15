<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KrsDetail extends Model
{
    use HasFactory;

    protected $table = 'krs_detail';

    protected $fillable = [
        'krs_id',
        'jadwal_id',
    ];

    public function krs()
    {
        return $this->belongsTo(Krs::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function nilai()
    {
        return $this->hasOne(Nilai::class);
    }

    public function mataKuliah()
    {
        return $this->hasOneThrough(MataKuliah::class, Jadwal::class,
            'id', // Foreign key on Jadwal table...
            'id', // Foreign key on MataKuliah table...
            'jadwal_id', // Local key on KrsDetail table...
            'mata_kuliah_id' // Local key on Jadwal table...
        );
    }
}