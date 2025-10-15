<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';

    protected $fillable = [
        'krs_detail_id',
        'nilai',
    ];

    public function krsDetail()
    {
        return $this->belongsTo(KrsDetail::class);
    }

    // Accessor for nilai_angka
    public function getNilaiAngkaAttribute()
    {
        switch ($this->nilai) {
            case 'A': return 4;
            case 'B': return 3;
            case 'C': return 2;
            case 'D': return 1;
            case 'E': return 0;
            default: return 0;
        }
    }

    // Accessor for nilai_huruf (if needed, but 'nilai' already serves this)
    public function getNilaiHurufAttribute()
    {
        return $this->nilai;
    }
}