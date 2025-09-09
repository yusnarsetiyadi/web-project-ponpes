<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdistricts extends Model
{
    use HasFactory;
    protected $table = 'subdistricts';
    protected $guarded = [];
    public $timestamps = false;
}
