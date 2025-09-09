<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    protected $table = 'artikel';
    protected $fillable = ['kategori_id','seo','judul','gambar','keterangan','status','view'];

    /**
     * Set the judul attribute with HTML special characters and entities encoding.
     *
     * @param string $value
     * @return void
     */
    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = htmlentities(htmlspecialchars($value, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Get the judul attribute with HTML special characters and entities decoding.
     *
     * @param string $value
     * @return string
     */
    public function getJudulAttribute($value)
    {
        return htmlspecialchars_decode(html_entity_decode($value, ENT_QUOTES, 'UTF-8'), ENT_QUOTES);
    }

    /**
     * Set the keterangan attribute with HTML special characters and entities encoding.
     *
     * @param string $value
     * @return void
     */
    public function setKeteranganAttribute($value)
    {
        $this->attributes['keterangan'] = htmlentities(htmlspecialchars($value, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Get the keterangan attribute with HTML special characters and entities decoding.
     *
     * @param string $value
     * @return string
     */
    public function getKeteranganAttribute($value)
    {
        return htmlspecialchars_decode(html_entity_decode($value, ENT_QUOTES, 'UTF-8'), ENT_QUOTES);
    }

	public function kategori(){
		return $this->belongsTo(Kategori::class,'kategori_id');
	}
}
