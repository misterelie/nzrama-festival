<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Users\UserController  as UsersUserController ;
use App\Http\Controllers\Admin\MembresController  as AdminMembresController ;
use App\Http\Controllers\Admin\DashboardController  as AdminDashboardController ;
use App\Http\Controllers\Admin\CommissionController  as AdminCommissionController ;
use App\Http\Controllers\Admin\AttributionController  as AdminAttributionController ;
use App\Http\Controllers\Admin\TacheController  as AdminTacheController ;


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


Route::get('/clear-config', function () {
    Artisan::call('config:clear');
});



// Route::get('/', [AdminDashboardController::class, 'dashboard']);

Route::get('/', [AdminDashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/', function () {
//     return view('admin.dash');
// })->middleware(['auth', 'verified'])->name('admin.dash');

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

// les documents des commissions
Route::get('/document.commission', [AdminCommissionController::class, 'all_docs'])->name('document.commission');
Route::post('/save/documents', [AdminCommissionController::class, 'store_document'])->name('save.documents');
Route::put('/update.docs/{document}', [AdminCommissionController ::class, 'update_document'])->name('update.docs');
Route::delete('/supprime_document/{document}', [AdminCommissionController ::class, 'delete_document'])->name('supprime_document');

//section commission
Route::get('/nos-commssions', [AdminCommissionController::class, 'add_commission'])->name("nos-commssions");
Route::post('/store/commission', [AdminCommissionController::class, 'save_commission']);
Route::put('/update/commission/{commissions}', [AdminCommissionController ::class, 'update']);
Route::delete('/supprime/commission/{commissions}', [AdminCommissionController ::class, 'destroy']);

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

//SECTION CATEGORIES
Route::get('/categorie-membre', [AdminMembresController::class, 'add_categorie'])->name('categorie.membre');
Route::post('/store.categorie_membre', [AdminMembresController::class, 'save_categorie_membre'])->name('store.categorie_membre');
Route::put('/update.categorie_membre/{categoriemembre}', [AdminMembresController::class, 'update_categorie_membre'])->name('update.categorie_membre');
Route::delete('/delete.categorie/{categoriemembre}', [AdminMembresController::class, 'destroy_categorie'])->name('delete.categorie');

//SECTION MEMBRE
Route::get('/liste/membres',[AdminMembresController::class, 'membres']);
Route::post('/save_membres', [AdminMembresController::class, 'store_membre'])->name('save_membres');
Route::put('/update.membre/{membre}', [AdminMembresController::class, 'update_membre'])->name('update.membre');
Route::delete('/supprime_membre/{membre}', [AdminMembresController::class, 'destroy_membre'])->name('supprime_membre');

//SECTION ATTRIBUTION
Route::get('/liste.attribution',[AdminAttributionController::class, 'add_attribu'])->name('liste.attribution');
Route::post('/attributions', [AdminAttributionController::class, 'store_attribution'])->name('save.attribution');
Route::put('/update/attribution/{attribution}', [AdminAttributionController ::class, 'update']);
Route::delete('/supprime/attribution/{attribution}', [AdminAttributionController::class, 'destroy']);
Route::post('/store.documents', [AdminAttributionController::class, 'store_document_attribu'])->name('store.documents');
Route::put('/update/etat/{attribution}', [AdminAttributionController ::class, 'update_etat'])->name('etat.attribution');
Route::get('/document.attribution', [AdminAttributionController::class, 'documents_attributions'])->name('document.attribution');

Route::put('/update.docsattribu/{document}', [AdminAttributionController ::class, 'update_doc_attribution'])->name('update.docsattribu');
Route::delete('/supprimedocument/{document}', [AdminAttributionController ::class, 'destroy_document'])->name('supprimedocument');


//SECTION TACHES
Route::get('/liste/taches',[AdminTacheController::class, 'add_tasks'])->name('admin.taches.index');
Route::post('/storeTache', [AdminTacheController::class, 'store_tache'])->name('save_tache');
Route::put('/tache_update/{tache}', [AdminTacheController::class,'update'])->name('tache_update');
Route::delete('/supprime/{tache}', [AdminTacheController::class, 'delete'])->name('delete_tache');
Route::put('/update.etat/{tache}', [AdminTacheController::class,'update_etat_tache'])->name('update.etat');
Route::post('/storeDocuments', [AdminTacheController::class, 'save_document_tache'])->name('save.documents');

Route::get('/document.tache', [AdminTacheController::class, 'docs_tache'])->name('document.tache');
Route::put('/update.docstache/{document}', [AdminTacheController::class, 'update_docs_tache'])->name('update.docstache');
Route::delete('/delete_document/{document}', [AdminTacheController ::class, 'destroy_document_tache'])->name('delete_document');
