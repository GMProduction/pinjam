<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'tb_pinjam';
    protected $fillable = [
        'id_siswa',
        'id_barang',
        'qty',
        'status',
        'id_guru',
        'id_staf',
        'tanggal_pinjam',
        'tanggal_kembali'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getSiswa(){
        return $this->belongsTo(Siswa::class,'id_siswa');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getGuru(){
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getStaf(){
        return $this->belongsTo(Staf::class, 'id_staf');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getBarang(){
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getMapel(){
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }

}
