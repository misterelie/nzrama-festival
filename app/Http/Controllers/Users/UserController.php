<?php

namespace App\Http\Controllers\Users;

use DateTime;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function users(){
        $data['utilisateurs'] = User::orderBy('name','ASC')->get();
        return view('admin.users.index')->with($data);

    }

    public function save_user(Request $request)
    {
        //dd($request->all());
        $date = new DateTime();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'prenoms' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'profile_photo' => 'required|max:2000',
        ]);

        $utilisateur = [
            'nom' => mb_strtoupper(trim($request->nom)),
            'prenoms' => ucwords(strtolower(trim($request->prenoms))),
            'email' => trim($request->email),
          ];    
            $utilisateur = new User();
            $utilisateur->name = $request->name;
            $utilisateur->prenoms = $request->prenoms;
            $utilisateur->email = $request->email;
            if ($request->password !='') {
                $request->validate([
                    'password' => 'required|confirmed|min:8',
                    'password_confirmation' => 'required|min:8',
                ]);
                $utilisateur['password'] = Hash::make($request->password);
            }
            if ($request->hasFile('profile_photo')) {
                $imag = $request->profile_photo;
                //dd($imag);
                $imageName = time() . '.' . $imag->Extension();
                $imag->move(public_path("UsersPhoto"), $imageName);
                $utilisateur->profile_photo = $imageName;
            }
            $utilisateur->save();
            return redirect()->back()->with('success', 'Félicitations! Utilisateur crée avec succès !. ');
    }

    //mettre a jour l'utilisateur
    public function update_user(Request $request, $utilisateur){
        //dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'prenoms' => 'required',
            'email' => 'required',
            'profile_photo' => 'nullable|max:2000',
        ]);
                $utilisateur = User::findOrFail($utilisateur);
                $utilisateur->name = $request->name;
                $utilisateur->prenoms = $request->prenoms;
                $utilisateur->email = $request->email;
                if ($request->hasFile('profile_photo')) 
                {
                    $imag = $request->profile_photo;
                    $imageName = time() . '.' . $imag->Extension();
                    $imag->move(public_path("UsersPhoto"), $imageName);
                    $utilisateur->profile_photo = $imageName;
                }
                    $utilisateur->save();
            return redirect()->back()->with('success', 'Félicitations! Vous mis à jour vos informations avec succès!. ');
    }
     public function delete_user(User $utilisateur){
        $utilisateur->delete();
        return back()->with("success", "L'utilisateur a été bien supprimé avec succès !");

    }

}
