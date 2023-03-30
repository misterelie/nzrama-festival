<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    use HasFactory;
    protected $table = "membres";
    protected $guarded = ['id'];
    protected $fillable = ["nom_membre", "prenoms","fonction", "telephone", "num_whatsapp", "commission_id", "categorie_id", "user_id", "specicite_fonction_membre", "code_membre"];

    public function user(){
        return $this->belongsTo(User::class, "user_id");
    }

    public function commission()
    {
       return $this->belongsTo(Commission::class, "commission_id");
    }

    public function categorie()
    {
       return $this->belongsTo(Categorie::class, "categorie_id");
    }
}
