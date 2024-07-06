<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTipe extends Model
{
    use HasFactory;
    protected $table = 'data_tipe';
    protected $guarded = ['id'];
}
