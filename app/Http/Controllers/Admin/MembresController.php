<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;

class MembresController extends Controller
{
    //SECTION CATEGORIE MEMBRE
    public function add_categorie(){
        $data['categoriemembres'] = Categorie::orderBy('libelle_categorie','ASC')->get();
        return view('admin.categories.categorie_membre')->with($data);
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

}
