<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenugasanPersonil extends Model
{
    use HasFactory;
    protected $table = 'penugasan_personil';
    protected $guarded = ['id'];
}
