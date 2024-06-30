<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPPTSNI extends Model
{
    use HasFactory;
    protected $table = 'sppt_sni';
    protected $guarded = ['id'];
}
