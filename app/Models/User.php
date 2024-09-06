<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
    
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'username',
    ];
    // public function role(string $role): bool
    // {
    //     return $this->role === $role;
    //     //untuk membandingkan dan menyamakan anatar 2 variable dan fungsi
    // }
    public function checkRole(string $role): bool
{
    return $this->role === $role;
}
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
      
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
     /**
     * Check if the user has a specific role.
     *
     * @param  string  $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }
        // Relasi dengan model Pengajuan
        public function pengajuan()
        {
            return $this->hasOne(Pengajuan::class, 'user_id');
        }

        public function PengajuanSekolah()
        {
            return $this->hasMany(PengajuanSekolah::class, 'user_id');
        }
        
        public function sekolah()
        {
            return $this->hasOne(Sekolah::class);
        }
        public function peserta()
        {
            return $this->hasOne(Peserta::class, 'user_id');
        }
        public function pembimbing()
        {
            return $this->hasOne(Pembimbing::class, 'user_id');
        }
}