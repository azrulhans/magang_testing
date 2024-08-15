<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = 'pengajuan';

    protected $fillable = ['id','nama', 'jurusan', 'asal_sekolah', 'nim', 'tgl_awal', 'tgl_akhir',
                         'email', 'no_hp', 'alamat', 'foto' ,'surat', 'status' ];
}