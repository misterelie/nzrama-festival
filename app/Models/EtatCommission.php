<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtatCommission extends Model
{
    use HasFactory;
    protected $table = "etat_commissions";
    protected $guarded = ['id'];
    protected $fillable = ["commission_id",  "etat_id"];

    // public function etat()
    // {
    //     return $this->hasMany(Commission::class, "commission_id", "etat_id", "id");
    // }
}
