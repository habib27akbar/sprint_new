<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstPejabat extends Model
{
    use HasFactory;
    protected $table = 'mst_pejabat';
    protected $guarded = ['id'];
}
