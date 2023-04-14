<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;
    protected $table = "taches";
    protected $guarded = ['id'];
    protected $fillable = ["nom_tache", "attribution_id", "description", "code_tache", "user_id", "etat"];

    public function attribution(){
        return $this->belongsTo(Attribution::class, 'attribution_id');
    }

    public function document(){
        return $this->hasMany(Document::class);
    }

    public function user(){
        return $this->belongsTo(User::class, "user_id");
    }

    public function etatStatus($etatId){
        $etat = Etat::find($etatId);
        return $etat;
    }
}
