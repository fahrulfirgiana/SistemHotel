<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;
    protected $table = "reservasi";
    protected $fillable = ['tgl_reservasi', 'nm_costumer', 'kd_costumer', 'kd_kamarr', 'jumlah'];
}
