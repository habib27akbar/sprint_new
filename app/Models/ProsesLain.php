<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsesLain extends Model
{
    use HasFactory;
    protected $table = 'mst_proses_lain';
    protected $guarded = ['id'];
}
