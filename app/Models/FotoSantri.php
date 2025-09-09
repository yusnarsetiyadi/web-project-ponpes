<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoSantri extends Model
{
    use HasFactory;
    protected $fillable = ['santri_id', 'foto'];
}
