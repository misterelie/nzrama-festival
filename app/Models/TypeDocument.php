<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDocument extends Model
{
    use HasFactory;
    protected $table = "type_documents";
    protected $guarded = ['id'];
    protected $fillable = ["libelle", "user_id"];

    public function user(){
        return $this->belongsTo(User::class, "user_id");
    }

    public function document(){
        return $this->hasMany(Document::class);
    }
}
