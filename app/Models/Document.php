<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table = "documents";
    protected $guarded = ['id'];

  protected $fillable = ["type_document_id", "nom_fichier", "commission_id", "libelle", "tache_id"];


    public function TypeDocument()
    {
       return $this->belongsTo(TypeDocument::class, "type_document_id", 'id');
    }

    public function commission()
    {
       return $this->belongsTo(Commission::class, "commission_id");
    }

    public function tacheDocs()
    {
       return $this->belongsTo(Tache::class, "tache_id");
    }
}
