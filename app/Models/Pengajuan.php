<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = 'pengajuan';

    protected $fillable = ['id','nama', 'jurusan', 'asal_sekolah', 'nim', 'tgl_awal', 'tgl_akhir',
                         'email','user_id', 'no_hp', 'alamat', 'foto' ,'surat', 'status','id_jurusan','pengajuan_id' ];

       public function user()
         {
             return $this->belongsTo(User::class,'id', 'user_id');
         }           
      // Relasi ke model Jurusan
    public function jurusan()
    {
        return $this->belongsTo(jurusan::class, 'id_jurusan');
    }
    public function pengajuan()
    {
        return $this->belongsTo(PengajuanSekolah::class, 'pengajuan_id');
    }
    // Relasi ke Pembimbing
    public function pembimbing() {
        return $this->belongsTo(Pembimbing::class,'pembimbing_id');
    }
    public function peserta()
    {
        return $this->hasMany(Peserta::class, 'pengajuan_id');
    }
    
}