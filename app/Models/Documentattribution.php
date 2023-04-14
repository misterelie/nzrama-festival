<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentattribution extends Model
{
    use HasFactory;
    protected $table = "documentattributions";
    protected $guarded = ['id'];
    protected $fillable = ["type_document_id", "nom_fichier", "attribution_id", "libelle_attribution", "tache_id"];

    public function attribution()
    {
       return $this->belongsTo(Commission::class, "attribution_id");
    }

    public function TypeDocument()
    {
       return $this->belongsTo(TypeDocument::class, "type_document_id", 'id');
    }


}
