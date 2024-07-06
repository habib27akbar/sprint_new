<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuangLingkup extends Model
{
    use HasFactory;
    protected $table = 'mst_ruang_lingkup';
    protected $guarded = ['id'];
}
