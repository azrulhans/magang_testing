<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSekolah extends Model
{
    use HasFactory;
    protected $table = 'PengajuanSekolah';

    protected $fillable = [   
    'id_pengajuan ',
    'no_surat',
    'tgl_surat',
    'tgl_mulai',
    'tgl_selesai',
    'surat',
    'user_id',
    'pengajuan_id',
    'balasan_id'
];

        public function balasan()
        {
            return $this->hasOne(Balasan::class, 'balasan_id');
        }


        public function user()
        {
            return $this->belongsTo(User::class, 'user_id');
        }          
        public function pengajuan()
        {
            return $this->hasMany(Pengajuan::class, 'pengajuan_id');
        }
}