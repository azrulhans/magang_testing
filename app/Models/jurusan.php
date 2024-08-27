<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurusan extends Model
{
    use HasFactory;
    protected $table = 'jurusan';

    protected $fillable = ['nama_jurusan'];

     // Relasi ke model Pengajuan
     public function pengajuan()
     {
         return $this->hasMany(Pengajuan::class, 'id_jurusan');
     }
}