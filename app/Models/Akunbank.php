<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akunbank extends Model
{
    use HasFactory;
    protected $table = 'akunbank';
    protected $fillable = ['norek','atas_nama','nama_bank','aktif'];
}
