<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribution;
use App\Models\Commission;
use App\Models\Membre;
use App\Models\Tache;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //dashboard

    public function dashboard(){
        $commissions = Commission::count();
        $membres = Membre::count();
        $taches = Tache::count();
        $attributions = Attribution::count();
        return view('admin.dash', compact('commissions', 'membres', 'taches', 'attributions'));
    }
}
