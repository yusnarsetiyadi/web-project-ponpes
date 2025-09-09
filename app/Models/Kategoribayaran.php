<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategoribayaran extends Model
{
    use HasFactory;
    protected $table = 'kategoribayaran';
    protected $fillable = ['nama','nominal','tingkat','aktif'];
}
