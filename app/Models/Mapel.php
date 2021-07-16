<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mapel extends Model
{
    use HasFactory;
    protected $table = 'tb_mapel';
    protected $fillable = ['nama_mapel','id_guru'];

    /**
     * @return BelongsTo
     */
    public function getGuru(){
        return $this->belongsTo(Guru::class,'id_guru');
    }
}
