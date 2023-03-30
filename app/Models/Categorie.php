<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $guarded = ['id'];
    protected $fillable = ["libelle_categorie"];

    public function membre(){
        return $this->hasMany(Membre::class);
    }
}
