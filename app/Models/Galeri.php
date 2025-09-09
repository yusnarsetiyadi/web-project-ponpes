<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;
    protected $table = 'galeri';
    protected $fillable = ['kategorigaleri_id','foto','judul','keterangan'];

    public function kategorigaleri(){
		return $this->belongsTo(Kategorigaleri::class,'kategorigaleri_id');
	}
}
