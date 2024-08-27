<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balasan extends Model
{
    use HasFactory;
    protected $table = 'Balasan';

    protected $fillable = [   
    'surat_balasan',
    'status',
    'alasan'
];
public function PengajuanSekolah()
{
    return $this->belongsTo(PengajuanSekolah::class, 'balasan_id');
}

}