<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';
    protected $fillable = ['nip','nama_guru','provinsi_id','kabkot_id','kec_id','desa_id','kontak','alamat','foto','keterangan'];
}
