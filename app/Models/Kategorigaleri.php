<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategorigaleri extends Model
{
    use HasFactory;
    protected $table = 'kategorigaleri';
    protected $fillable = ['seo','judul','aktif'];

    public function galeridata()
    {
        return $this->hasMany(Galeri::class, 'kategorigaleri_id', 'id');
    }
}
