<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;
    protected $table = "commissions";
    protected $guarded = ['id'];
    protected $fillable = ["nom_commission", "description_commission", "user_id", "etat"];


    public function user(){
        return $this->belongsTo(User::class, "user_id");
    }

    public function document(){
        return $this->hasMany(Document::class, "commission_id");
    }

    public function etatStatus($etatId){
        $etat = Etat::find($etatId);
        return $etat;
    }

    public function membre(){
        return $this->hasMany(Membre::class);
    }

} 
