<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribution;
use App\Models\Commission;
use App\Models\TypeDocument;
use App\Models\Documentattribution;
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
            'libelle_attribution' =>  'required',
        ]);
            $doc_attributions = new Documentattribution();
            $doc_attributions->type_document_id = $request->type_document_id;
            $doc_attributions->attribution_id = $request->attribution_id;
            $doc_attributions->nom_fichier = $request->nom_fichier;

            if ($request->hasFile('libelle_attribution')) {
                $files = $request->file('libelle_attribution');
                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $file->move(public_path("FichiersAttribution"), $filename);
                    Documentattribution::create([
                        'type_document_id' => $request->type_document_id,
                        'nom_fichier' => $request->nom_fichier,
                        'attribution_id' => $request->attribution_id,
                        'libelle_attribution' => $filename,
                        ]);
                }
        }
           return redirect()->back()
           ->with('success', 'Félicitations ! Vous avez ajouté le document avec succès ');
    }
        public function documents_attributions(){
            $attributions = Attribution::all();
            $doc_attributions = Documentattribution::all();
            return view('admin.attributions.liste_document', compact('attributions', 'doc_attributions'));
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
