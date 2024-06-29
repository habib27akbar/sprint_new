<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KBLI extends Model
{
    use HasFactory;
    protected $table = 'kbli';
    protected $guarded = ['id'];
}
