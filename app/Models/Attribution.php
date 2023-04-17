<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribution extends Model
{
    use HasFactory;
    protected $table = "attributions";
    protected $guarded = ['id'];
    protected $fillable = ["nom_attribution", "commission_id", "description_attribution", "user_id", "code_attribution", "civilite", "etat", "date_creation"];

    public function commissionAttributtion(){
        return $this->belongsTo(Commission::class, "commission_id");
    }

    public function attributionuser(){
        return $this->belongsTo(User::class, "user_id");
    }

    public function etatStatus($etatId){
        $etat = Etat::find($etatId);
        return $etat;
    }

    public function document(){
        return $this->hasMany(Document::class);
    }

    public function tache(){
        return $this->hasMany(Tache::class);
    }
}
