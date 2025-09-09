<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikanakhir extends Model
{
    use HasFactory;
    protected $table = 'pendidikanakhir';
    protected $fillable = ['santri_id','nama_sekolah','tahun_lulus','nilai_rata_rata'];
}
