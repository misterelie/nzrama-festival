<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CommissionController  as AdminCommissionController ;
use App\Http\Controllers\Admin\MembresController  as AdminMembresController ;
use App\Http\Controllers\Admin\DashboardController  as AdminDashboardController ;
use App\Http\Controllers\Users\UserController  as UsersUserController ;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [AdminDashboardController::class, 'dashboard']);

Route::get('/', function () {
    return view('admin.dash');
})->middleware(['auth', 'verified'])->name('admin.dash');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//type documents
Route::get('/type-document', [AdminCommissionController::class, 'typedoc'])->name("admin.type_documents.add_typedocs");
Route::post('/store.typedocument', [AdminCommissionController::class, 'store_typedoc'])->name('store.typedocument');
Route::put('/update/typedocument/{typedocument}', [AdminCommissionController ::class, 'update_typedocument']);
Route::delete('/supprime/typedocument/{typedocument}', [AdminCommissionController ::class, 'destroy_typedoc']);
Route::post('/save/documents', [AdminCommissionController::class, 'store_document'])->name('save.documents');

//section commission
Route::get('/nos-commssions', [AdminCommissionController::class, 'add_commission'])->name("nos-commssions");
Route::post('/store/commission', [AdminCommissionController::class, 'save_commission']);
Route::put('/update/commission/{commissions}', [AdminCommissionController ::class, 'update']);
Route::delete('/supprime/commission/{commissions}', [AdminCommissionController ::class, 'destroy']);
Route::put('/update.etat/{commissions}', [AdminCommissionController ::class, 'update_etat'])->name('update.etat'); 

//section status
Route::get('/etat/stauts', [AdminCommissionController::class, 'add_status']);
Route::post('/save.etat', [AdminCommissionController::class, 'store_status'])->name('save.etat');
Route::put('/update.status/{etat}', [AdminCommissionController ::class, 'update_status'])->name('update.status');

Route::delete('/delete_status/{etat}', [AdminCommissionController ::class, 'destroy_status'])->name('delete_status');
Route::post('/etat.commission', [AdminCommissionController::class, 'status_commission'])->name('etat.commission');

//gestion des utilisateurs
Route::get('/admin.add_user', [UsersUserController::class, 'users'])->name('admin.add_user');
Route::post('store/users', [UsersUserController::class, 'save_user']);
Route::put('/utilisateur.update/{utilisateur}', [UsersUserController::class, 'update_user'])->name('utilisateur.update');
Route::delete('/delete.user/{utilisateur}', [UsersUserController::class, 'delete_user'])->name('delete.user');

//SECTION MEMBRES
Route::get('/categorie-membre', [AdminMembresController::class, 'add_categorie'])->name('categorie.membre');
Route::post('/store.categorie_membre', [AdminMembresController::class, 'save_categorie_membre'])->name('store.categorie_membre');
Route::put('/update.categorie_membre/{categoriemembre}', [AdminMembresController::class, 'update_categorie_membre'])->name('update.categorie_membre');
Route::delete('/delete.categorie/{categoriemembre}', [AdminMembresController::class, 'destroy_categorie'])->name('delete.categorie');