<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistStatus extends Model
{
    use HasFactory;
    protected $table = 'regist_status';
    protected $guarded = ['id'];
}
