<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertifikatReferensi extends Model
{
    use HasFactory;
    protected $table = 'mst_sertifikat';
    protected $guarded = ['id'];
}
