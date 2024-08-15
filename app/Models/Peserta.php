<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;
    protected $table = 'peserta';

    protected $fillable = ['id','judul', 'deskripsi', 'tanggal', 'dokumentasi', 'status'];
    public function getTanggalAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
    
}