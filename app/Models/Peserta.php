<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;
    protected $table = 'peserta';

    protected $fillable = ['id','judul', 'deskripsi', 'tanggal','nim', 'dokumentasi','pembimbing_id', 'status', 'user_id','is_reopened','pengajuan_id','pembimbing_id'];
    public function getTanggalAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Model Peserta.php
    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class, 'pembimbing_id');
    }
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class,'pembimbing_id');
    }
    
}