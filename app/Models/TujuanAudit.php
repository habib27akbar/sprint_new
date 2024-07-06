<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TujuanAudit extends Model
{
    use HasFactory;
    protected $table = 'mst_tujuan_audit';
    protected $guarded = ['id'];
}
