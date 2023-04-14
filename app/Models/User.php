<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Nonstandard\Uuid;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use SebastianBergmann\ResourceOperations\generate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'prenoms',
        'profile_photo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'uuid',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
  {
    parent::boot();
    self::creating(function ($model) {
      $model->uuid = (string)Uuid::uuid4();
    });
  }

  public function commission()
    {
       return $this->hasMany(Commission::class, "commission_id");
    }
    
  public function TypeDocument()
  {
     return $this->hasMany(TypeDocument::class, "type_document_id");
  }

  public function membre()
    {
       return $this->hasMany(Membre::class, "membre_id");
    }

    public function attribution(){
      return $this->hasMany(Attribution::class);
  }

  public function tache(){
    return $this->hasMany(Tache::class, "user_id");
}

}
