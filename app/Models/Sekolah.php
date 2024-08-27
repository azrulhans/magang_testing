<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;
    protected $table = 'sekolah';

    protected $fillable = [   
    'name',
    'email',
    'alamat',
    'no_telp',
    'user_id' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}