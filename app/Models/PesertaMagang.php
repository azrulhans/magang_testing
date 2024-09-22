<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesertamagang extends Model
{
    use HasFactory;
    protected $table = 'pesertamagang';

    protected $fillable = ['id','nama', 'nim', 'alamat','judul','deskripsi','dokumentasi', 
                        'jk','email', 'id_jurusan','no_hp','id_pembimbing'];

     // Relasi ke User
     public function user()
     {
         return $this->belongsTo(User::class);
     }
 
     // Relasi ke Pengajuan
     public function pengajuan()
     {
         return $this->belongsTo(Pengajuan::class);
     }
}