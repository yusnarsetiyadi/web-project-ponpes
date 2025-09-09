<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orangtuawali extends Model
{
    use HasFactory;
    protected $table = 'orangtuawali';
    protected $fillable = ['santri_id','nama','pekerjaan','penghasilan_perbulan','kontak'];
}
