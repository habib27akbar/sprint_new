<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerjanjianSertifikasi extends Model
{
    use HasFactory;
    protected $table = 'perjanjian_sertifikasi';
    protected $guarded = ['id'];
}
