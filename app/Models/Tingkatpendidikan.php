<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tingkatpendidikan extends Model
{
    use HasFactory;
    protected $table = 'tingkatpendidikan';
    protected $fillable = ['nama','aktif'];
}
