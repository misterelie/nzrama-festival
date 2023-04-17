<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribution;
use App\Models\Commission;
use App\Models\TypeDocument;
use App\Models\Document;
use App\Models\Etat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class AttributionController extends Controller
{
    //liste des attributions
    public function add_attribu(){
        $commissions = Commission::all();
        $etats = Etat::all();
        $typedocuments = TypeDocument::all();
        $attributions = Attribution::orderBy('created_at', 'ASC')->get();
        return view('admin.attributions.add_attribution', compact('commissions', 'attributions', 'etats','typedocuments'));
    }

    public function documents_attributions(){
        $typedocuments = TypeDocument::all();
        $documents = Document::orderBy('created_at', 'ASC')->get();
        $attributions = Attribution::orderBy('created_at', 'ASC')->has('document')->get();
        return view('admin.attributions.liste_document', compact('attributions', 'typedocuments', 'documents'));
    }

    //save attribution
    public function store_attribution(Request $request){
        //dd($request->all());
        $request->validate([
            "nom_attribution" => "required",
            "commission_id" => "required",
            "description_attribution" => "required",
        ]);
        $attributions = new Attribution();
        $attributions->user_id = Auth::user()->id;
        $attributions->nom_attribution = $request->nom_attribution;
        $attributions->commission_id = $request->commission_id;
        $attributions->description_attribution = $request->description_attribution;
        $attributions->code_attribution = rand(00001, 99999);
        $attributions->code_attribution = Str::slug(mb_strtoupper('att').'-'.rand(00001, 99999));
        $attributions->save();
        return back()->with("success", "L'attribution a été ajouté avec succès !");
    }

    public function update(Request $request, Attribution $attribution){
        //dd($request->all());
        $request->validate([
            "nom_attribution" => "required",
            "commission_id" => "required",
            "description_attribution" => "required",
        ]);
        if (!is_null($request->attribution)) {
            $attribution->nom_attribution = $request->nom_attribution;
            $attribution->commission_id = $request->commission_id;
            $attribution->description_attribution = $request->description_attribution;
            $attribution->save();
        } 
        return back()->with("success", "L' attribution a été mise à jour avec succès !");
    }

    public function destroy(Attribution $attribution)
    {
        $attribution->delete();
        return back()->with("success", "L' attribution a été Supprimé avec succès !");
    }

    public function store_document_attribu(Request $request){
        //dd($request->all());
        $request->validate([
            "type_document_id" => "required",
            "nom_fichier" => "required",
            "attribution_id" =>  "required",
            'libelle' =>  'required',
        ]);
            $documents = new Document();
            $documents->type_document_id = $request->type_document_id;
            $documents->attribution_id = $request->attribution_id;
            $documents->nom_fichier = $request->nom_fichier;
            if ($request->hasFile('libelle')) {
                $files = $request->file('libelle');
                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $file->move(public_path("FichiersAttribution"), $filename);
                    Document::create([
                        'type_document_id' => $request->type_document_id,
                        'nom_fichier' => $request->nom_fichier,
                        'attribution_id' => $request->attribution_id,
                        'libelle' => $filename,
                        ]);
                }
        }
           return redirect()->back()->with('success', 'Félicitations ! Vous avez ajouté le document avec succès ');
    }


    public function update_doc_attribution(Request $request, Document $document){
        //dd($request->all());
        $request->validate([
             "type_document_id" => "required",
             "nom_fichier" => "required",
             "attribution_id" =>  "required",
             "libelle" => "nullable",
         ]);
             $document->type_document_id = $request->type_document_id;
             $document->attribution_id = $request->attribution_id;
             $document->nom_fichier = $request->nom_fichier;

             if ($request->hasFile('libelle')) {
                 $files = $request->file('libelle');
                 //dd($files);
                 foreach ($files as $file) {
                     $filename = $file->getClientOriginalName();
                     $file->move(public_path("FichiersAttribution"), $filename);
                     $document->Update([
                         'type_document_id' => $request->type_document_id,
                         'nom_fichier' => $request->nom_fichier,
                         'attribution_id' => $request->attribution_id,
                         'libelle' => $filename,
                         ]);
                 }
         }
            $document->save();
            return redirect()->back()->with('success', 'Félicitations ! Vous avez mis à jour le document avec succès ');
     }

     public function destroy_document(Document $document){
        $document->delete();
        return back()->with("success", "Document est Supprimé avec succès !");
    }



     //statuts attribution
     public function update_etat(Request $request, Attribution $attribution){
        $request->validate([
            'etat' => 'required',
        ]);
        $attribution->etat = $request->etat;
        $attribution->save();
        return back()->with("success", "Statut est mis jour avec succès !");
    }

}
