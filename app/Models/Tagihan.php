<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tagihan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tagihan';
    protected $fillable = ['santri_id','kategoribayaran_id','nominal','tingkatpendidikan','bulan','tahun','status_pembyaran','bank_id','bukti'];

    public $dates = [
        'deleted_at'
    ];

    public function santri(){
		return $this->belongsTo(Santri::class,'santri_id');
	}

    public function pembayaran(){
		return $this->belongsTo(Kategoribayaran::class,'kategoribayaran_id');
	}

  public function bank() {
    return $this->belongsTo(Akunbank::class, 'bank_id');
}
}
