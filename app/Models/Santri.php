<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Authenticatable as Authen;
use  Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;

class Santri extends Model implements Authenticatable
{
    use HasFactory, SoftDeletes, Authen;
    protected $table = 'santri';
    protected $fillable = ['nama_lengkap', 'username', 'tempat_lahir','tanggal_lahir','jenis_kelamin','no_telepon','email','alamat','password','verifikasi','password_resets','diterima','alasan','jurusan_id','tingkat_pendidikan','pw_nohash'];

    public $dates = [
        'deleted_at'
    ];
    public function getAuthIdentifierName()
    {
        return 'email'; // Replace with your authentication identifier (e.g., 'email', 'username')
    }
    public function getAuthIdentifier()
    {
        return $this->email; // Replace with the attribute used for authentication (e.g., 'email', 'username')
    }
    public function getAuthPassword()
    {
        return $this->password; // Replace with the password attribute
    }

    public function ortu()
    {
        return $this->hasMany(Orangtuawali::class, 'santri_id', 'id');
    }

    public function pendidikan()
    {
        return $this->hasMany(Pendidikanakhir::class, 'santri_id', 'id');
    }

    public function jurusan(){
		return $this->belongsTo(Jurusan::class,'jurusan_id');
	}

    public function fotoSantri(){
        return $this->hasOne(FotoSantri::class, 'santri_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->username = Str::slug(Str::lower($model->nama_lengkap, '_',$model->no_telepon), '_');
        });

        static::updating(function ($model) {
            if ($model->isDirty('nama_lengkap')) {
                $model->username = Str::slug(Str::lower($model->nama_lengkap,'_',$model->no_telepon),'_');
            }
        });
    }

}
