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
    'pengajuan_id'
];
       
        public function balasan()
        {
            return $this->belongsTo(Balasan::class, 'balasan_id');
        }

        public function user()
        {
            return $this->belongsTo(User::class);
        }          
        public function pengajuan()
        {
            return $this->hasMany(Pengajuan::class, 'pengajuan_id');
        }
}