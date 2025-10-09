<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MataKuliah extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     *
     * @var string
     */
    protected $table = 'mata_kuliah';

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
        'jenis',
        'deskripsi',
        'dosen_id',
    ];

    /**
     * Mendefinisikan relasi "belongsTo" ke model Dosen.
     * Setiap Mata Kuliah dimiliki oleh satu Dosen.
     */
    public function dosen(): BelongsTo
    {
        // Asumsi: Anda memiliki model Dosen di App\Models\Dosen
        return $this->belongsTo(Dosen::class);
    }
}
