<?php

namespace App\Http\Controllers\Admin;

use App\Models\Etat;
use App\Models\Tache;
use App\Models\Document;
use App\Models\Attribution;
use Illuminate\Support\Str;
use App\Models\TypeDocument;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TacheController extends Controller
{
    //
    public function add_tasks(){
        $attributions = Attribution::all();
        $etats = Etat::all();
        $typedocuments = TypeDocument::all();
        $taches = Tache::orderBy('created_at', 'ASC')->get();
        return view('admin.taches.index', compact('attributions', 'taches', 'etats', 'typedocuments'));
    }

    public function store_tache(Request $request){
        $request->validate([
            "nom_tache" => "required",
            "description" => "nullable",
            "attribution_id" => "required",
        ]);
        $taches = new Tache();
        $taches->user_id = Auth::user()->id;
        $taches->nom_tache = $request->nom_tache;
        $taches->description = $request->description;
        $taches->attribution_id = $request->attribution_id;
        $taches->code_tache = rand(00001, 99999);
        $taches->code_tache = Str::slug(mb_strtoupper('TACH').'-'.rand(00001, 99999));
        $taches->save();
        return redirect()->back()->with('success', 'Félicitations! Vous avez enregistré la tâche avec succès ');
    }

    public function update(Request $request, Tache $tache){
        $request->validate([
            "nom_tache" => "required",
            "description" => "nullable",
            "attribution_id" => "nullable",
        ]);
        if (!is_null($request->tache)) {
            $tache->nom_tache = $request->nom_tache;
            $tache->description = $request->description;
            $tache->attribution_id = $request->attribution_id;
            $tache->save();
        }
        return redirect()->back()->with('success', 'Vous avez mis à jour la tâche avec succès ');
    }

    public function delete(Tache $tache){
        $tache = Tache::find($tache->id);
        $tache->delete();
        return back()->with("success", "La tache est supprimée avec succès !");
    }

    //STATUS DE LA TACHE
      public function update_etat_tache(Request $request, Tache $tache){
        $request->validate([
            'etat' => 'required',
        ]);
        $tache->etat = $request->etat;
        $tache->save();
        return back()->with("success", "Le statut de la tache a été mis à jour avec succès !");
    }

    //SAVE DOCUMENTS TACHES
    public function save_document_tache(Request $request){
        $request->validate([
            "type_document_id" => "required",
            "nom_fichier" => "required",
            "tache_id" =>  "required",
            'libelle' =>  'required',
        ]);
            $documents = new Document();
            $documents->type_document_id = $request->type_document_id;
            $documents->tache_id = $request->tache_id;
            $documents->nom_fichier = $request->nom_fichier;
            if ($request->hasFile('libelle')) {
                $files = $request->file('libelle');
                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $file->move(public_path("FichiersTaches"), $filename);
                    Document::create([
                        'type_document_id' => $request->type_document_id,
                        'nom_fichier' => $request->nom_fichier,
                        'tache_id' => $request->tache_id,
                        'libelle' => $filename,
                        ]);
                }
        }
           return redirect()->back()
           ->with('success', 'Félicitations ! Vous avez ajouté le document avec succès ');
    }

}




