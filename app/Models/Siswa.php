<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'tb_siswa';

    protected $fillable = [
        'id_user',
        'alamat',
        'nama',
        'tanggal',
        'kelas',
        'no_hp',
        'image'

    ];

}
