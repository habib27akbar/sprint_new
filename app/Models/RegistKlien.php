<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistKlien extends Model
{
    use HasFactory;
    protected $table = 'regist_klien';
    protected $guarded = ['id'];
}
