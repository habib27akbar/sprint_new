<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;
    protected $table = 'mst_sertifikat';
    protected $guarded = ['id'];

    public function getFullNamaPerusahaanAttribute()
    {
        return "{$this->id_perusahaan} {$this->jenis_badan_usaha} {$this->nama_perusahaan}";
    }
}
