<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Commission;
use App\Models\Membre;
use App\Models\Attribution;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Arr;
use App\Http\Requests\MembreFormRequest;

class MembresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
       
    }

    //SECTION CATEGORIE MEMBRE
    public function add_categorie(){
        $data['categoriemembres'] = Categorie::orderBy('libelle_categorie','ASC')->get();
        $attributions = Attribution::all();
        return view('admin.categories.categorie_membre', compact('attributions'))->with($data);
    }
    public function save_categorie_membre(Request $request){
        $request->validate([
            'libelle_categorie' => 'required'
        ]);
        $categoriemembres = new Categorie();
        $categoriemembres->libelle_categorie = $request->libelle_categorie;
        $categoriemembres->save();
        return redirect()->back()->with('success','Félicitations ! Vous avez créé la catégorie avec avec succès ');
    }
    public function update_categorie_membre(Request $request, Categorie $categoriemembre){
        //dd($request->all());
        $request->validate([
            'libelle_categorie' => 'required'
        ]);
        $categoriemembre->libelle_categorie = $request->libelle_categorie;
        $categoriemembre->save();
        return redirect()->back()->with('success','Félicitations ! Vous avez mis à jour la catégorie avec avec succès ');
    }
    public function destroy_categorie(Categorie $categoriemembre)
    {
        $categoriemembre->delete();
        return back()->with("success", "Catégorie est Supprimée avec succès !");
    } // END SECTION CATEGORIE MEMBRE


     //SECTION MEMBRE
     public function membres(){
    
        $membres= Membre::orderBy('created_at', 'DESC')->get();
        // foreach($membres as $membre){
        //     if($membre->commission->attribution){
        //         foreach($membre->commission->attribution as $attribution){
        //             //dd($attribution->tache);
        //           if($attribution->tache)
        //           foreach($attribution->tache as $tache){
        //                 //dd($tache);
        //           }
        //         }
        //     };
        // }
        $categoriemembres = Categorie::all();
        $commissions = Commission::all();
        $attributions = Attribution::all();
        return view('admin.membres.add_membre', compact('categoriemembres', 'commissions', 'attributions', 'membres'));
     }

     public function store_membre(Request $request){
        //dd($request->all());
        $request->validate([
            "civilite" => "required",
            "nom_membre" => "required",
            "prenoms" => "required",
            "specicite_fonction_membre" => "required",
            "telephone" => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:10',
            "num_whatsapp" => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|max:10',
            'email' => 'required',
            "categorie_id" => "required", 
            "commission_id" => "required"
        ]);

        //* Vérifie si l'adresse email existe déjà
         if (Membre::where('email', $request->email)->exists()) {
            //dd($request->email);
            return redirect()->back()
                             ->with('error', 'Cet adresse email existe déjà, veuillez saisir une autre adresse email');
         }
         else {
            if (Membre::where('telephone', $request->telephone)->exists()) {
                return redirect()->back()
                                 ->with('error', 'Ce numéro de téléphone existe déjà, veuillez correctement votre numéro de téléphone');
             }

            $membres = new Membre();
            $membres->user_id = Auth::user()->id;
            $membres->civilite = $request->civilite;
            $membres->nom_membre = $request->nom_membre;
            $membres->prenoms = $request->prenoms;
            $membres->specicite_fonction_membre = $request->specicite_fonction_membre;
            $membres->telephone = $request->telephone;
            $membres->email = $request->email;
            $membres->num_whatsapp = $request->num_whatsapp;
            $membres->categorie_id = $request->categorie_id;
            $membres->commission_id = $request->commission_id;
            $membres->code_membre = rand(00001, 99999);
            // $membres->code_membre = Str::slug($membres->categorie_id.'-'.rand(00001, 99999));
            $membres->code_membre = Str::slug(mb_strtoupper('MEM').'-'.rand(00001, 99999));
            $membres->save();
            return redirect()->back()->with('success', 'Félicitations! Vous avez ajouté avec succès');
         }

     }

      //mettre à jour les informations d'un membre
      public function update_membre(Request $request, Membre $membre){
        //dd($request->all());
        $request->validate([
            "civilite" => "required",
            "nom_membre" => "required",
            "prenoms" => "required",
            "specicite_fonction_membre" => "nullable",
            "telephone" => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:10',
            "num_whatsapp" => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|max:10',
            'email' => 'required',
            "categorie_id" => "required", 
            "commission_id" => "required"
        ]);

        $membre->civilite = $request->civilite;
        $membre->nom_membre = $request->nom_membre;
        $membre->prenoms = $request->prenoms;
        $membre->specicite_fonction_membre = $request->specicite_fonction_membre;
        $membre->telephone = $request->telephone;
        $membre->email = $request->email;
        $membre->num_whatsapp = $request->num_whatsapp;
        $membre->categorie_id = $request->categorie_id;
        $membre->commission_id = $request->commission_id;
        $membre->save();
        return redirect()->back()
                         ->with('success','Félicitations ! Vous avez mis à jour les informations avec avec succès ');
      }

      public function  destroy_membre(Membre $membre)
      {
          $membre->delete();
          return back()->with("success", "Membre est Supprimé avec succès !");
      } 
  





}
