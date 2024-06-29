<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedomanSertifikasi extends Model
{
    use HasFactory;
    protected $table = 'pedoman_sertifikasi';
    protected $guarded = ['id'];
}
