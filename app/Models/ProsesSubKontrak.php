<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsesSubKontrak extends Model
{
    use HasFactory;
    protected $table = 'proses_sub_kontrak';
    protected $guarded = ['id'];
}
