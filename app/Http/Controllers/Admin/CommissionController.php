<?php

namespace App\Http\Controllers\Admin;

use App\Models\Etat;
use Carbon\Traits\Date;
use App\Models\Document;
use App\Models\Commission;
use Illuminate\Support\Str;
use App\Models\TypeDocument;
use Illuminate\Http\Request;
use App\Models\EtatCommssion;
use App\Models\EtatCommission;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add_commission(){
        // $commissions = Commission::all();
        $commissions = Commission::orderBy('created_at', 'ASC')->get();
        $etats = Etat::all();
        $typedocuments = TypeDocument::all();
        $documents = Document::all();
        return view('admin.commission.liste_commission', compact('commissions','typedocuments', 'documents', 'etats'));
    }

    public function save_commission(Request $request){
        $request->validate([
            "nom_commission" => "required",
            "description_commission" => "nullable",
        
        ]);
        $commissions = new Commission();
        $commissions->user_id = Auth::user()->id;
        $commissions->nom_commission = $request->nom_commission;
        //$commissions->date_creation = $request->date_creation->Carbon::now();
        $commissions->description_commission = $request->description_commission;
        $commissions->code_commission = rand(00001, 99999);
        $commissions->code_commission = Str::slug(mb_strtoupper('COM').'-'.rand(00001, 99999));
        $commissions->save();
        return redirect()->back()->with('success', 'Félicitations! Vous avez enregistré la commission avec succès ');
    }

    //METTRE A JOUR LA COMMISSION
    public function update(Request $request, Commission $commissions){
        $request->validate([
            "nom_commission" => "required",
            "description_commission" => "required",
        ]);

        if (!is_null($request->commissions)) {
            $commissions->nom_commission = $request->nom_commission;
            $commissions->description_commission = $request->description_commission;
            $commissions->save();
        }
        return redirect()->back()->with('success', 'Félicitations! Vous avez mis à jour la commission avec succès');
    }

    public function destroy(Commission $commissions)
    {
        $commissions->delete();
        return back()->with("success", "La commission est Supprimée avec succès !");
    }

    
    //SECTION TYPE DOCUMENT
    public function typedoc(){
        $typedocuments = TypeDocument::orderBy('created_at', 'DESC')->get();
        return view('admin.type_documents.add_typedocs', compact('typedocuments'));
    }

    public function store_typedoc(Request $request){
        $request->validate([
            "libelle" => "required",
        ]);
        
        $typedocuments = new TypeDocument();
        $typedocuments->user_id = Auth::user()->id;
        $typedocuments->libelle = $request->libelle;
        $typedocuments->date_creation = Carbon::now()->format('Y-m-d H:i:s');
        $typedocuments->save();
        return redirect()->back()->with('success', 'Félicitations! Vous avez ajouté avec succès ');
    }

    //mettre le à jour le type document
    public function update_typedocument(Request $request, TypeDocument $typedocument){
        $request->validate([
            "libelle" => "required",
        ]);
        if (!is_null($typedocument)) {
            $typedocument->libelle = $request->libelle;
            $typedocument->save();
            return redirect()->back()->with('success', 'Félicitations ! Vous avez mis à jour avec succès ');
        }
    }
    //suppression du type document
    public function destroy_typedoc(TypeDocument $typedocument){
        $typedocument->delete();
        return back()->with("success", "Vous avez supprimé avec succès !");

    }//FIN SECTION TYPE DOCUMENT

    //SECTION DOCUMENT
     public function all_docs(){
        $typedocuments = TypeDocument::all();
        $documents = Document::orderBy('created_at', 'ASC')->get();
        $commissions = Commission::orderBy('created_at', 'ASC')->has('document')->get();
        return view('admin.commission.docs', compact('commissions', 'documents', 'typedocuments'));
    }
    
    public function store_document(Request $request){
        $request->validate([
            "type_document_id" => "required",
            "nom_fichier" => "required",
            "commission_id" =>  "required",
            'libelle' =>  'required',
        ]);
            $documents = new Document();
            $documents->type_document_id = $request->type_document_id;
            $documents->commission_id = $request->commission_id;
            $documents->nom_fichier = $request->nom_fichier;

            if ($request->hasFile('libelle')) {
                $files = $request->file('libelle');
                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $file->move(public_path("FichierCommission"), $filename);
                    Document::create([
                        'type_document_id' => $request->type_document_id,
                        'nom_fichier' => $request->nom_fichier,
                        'commission_id' => $request->commission_id,
                        'libelle' => $filename,
                        ]);
                }
        }
           return redirect()->back()
           ->with('success', 'Félicitations ! Vous avez ajouté le document avec succès ');
    }


    public function update_document(Request $request, Document $document){
        //dd($request->all());
        $request->validate([
             "type_document_id" => "required",
             "nom_fichier" => "required",
             "commission_id" =>  "required",
             "libelle" => "nullable",
         ]);
             $document->type_document_id = $request->type_document_id;
             $document->commission_id = $request->commission_id;
             $document->nom_fichier = $request->nom_fichier;

             if ($request->hasFile('libelle')) {
                 $files = $request->file('libelle');
                 //dd($files);
                 foreach ($files as $file) {
                     $filename = $file->getClientOriginalName();
                     $file->move(public_path("FichierCommission"), $filename);
                     $document->Update([
                         'type_document_id' => $request->type_document_id,
                         'nom_fichier' => $request->nom_fichier,
                         'commission_id' => $request->commission_id,
                         'libelle' => $filename,
                         ]);
                 }
         }
            $document->save();
            return redirect()->back()->with('success', 'Félicitations ! Vous avez mis à jour le document avec succès ');
     }
     
        public function delete_document(Document $document){
            $document->delete();
            return back()->with("success", "Document est Supprimé avec succès !");
        }



     //gestion de satus
     public function add_status()
     {
        $etats = Etat::all();
        return view('admin.etats.status', compact('etats'));
     }
    public function store_status(Request $request){
        $request->validate([
            "status" => "required",
            "statu_color" => "required"
        ]);
        $etats = new Etat();
        $etats->status = $request->status;
        $etats->etat_color = $request->statu_color;
        $etats->save();
        return redirect()->back()
         ->with('success','Félicitations ! Vous avez enregistré le status avec avec succès '); 
    }
    public function update_status(Request $request, Etat $etat)
    {
        $request->validate([
            "status" => "required",
        ]);
        $etat->status = $request->status;
        $etat->save();
        return redirect()->back()->with('success','Félicitations ! Vous avez à mis jour le status avec avec succès ');
    }
    public function destroy_status(Etat $etat)
    {
        $etat->delete();
        return back()->with("success", "Status est Supprimé avec succès !");
    }
    
    // public function update_etat(Request $request, Commission $commissions){
    //     //dd($request->all());
    //     $request->validate([
    //         'etat' => 'required',
    //     ]);
    //     $commissions->etat = $request->etat;
    //     $commissions->save();
    //     return back()->with("success", "Statut est mis jour avec succès !");
    // }

    
}
