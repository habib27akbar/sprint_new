<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkemaSertifikasi extends Model
{
    use HasFactory;
    protected $table = 'mst_skema_sertifikasi';
    protected $guarded = ['id'];
}
