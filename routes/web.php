<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\StagiaireController;

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

Route::get('/', function () {
    return view('accueil');
})->name('accueil');

Route::get('/about', function () {
    return view('about');
})->name('about');

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')->middleware('stg');

Route::get('/admin/home', [DashboardController::class, 'index'])->name('admin.home')->middleware('admin');

Route::middleware('admin')->group(function () {

    Route::get('/admin/stgs', [StagiaireController::class, 'index'])->name('admin.stgs');
    Route::get('/admin/stg/{id}', [StagiaireController::class, 'show'])->name('admin.stg.show');
    Route::delete('/admin/destroy/stg/{id}', [StagiaireController::class, 'destroy'])->name('admin.stg.destroy');

    Route::get('/admin/offres', [OffreController::class, 'index'])->name('admin.offres');
    Route::put('/admin/publshcahe/offre/{id}', [OffreController::class, 'publierOuCacher'])->name('admin.offre.publishcache');
    Route::get('/admin/create/offre', [OffreController::class, 'create'])->name('admin.offre.create');
    Route::post('/admin/store/offre', [OffreController::class, 'store'])->name('admin.offre.store');
    Route::get('/admin/offre/{id}', [OffreController::class, 'show'])->name('admin.offre.show');
    Route::get('/admin/edit/offre/{id}', [OffreController::class, 'edit'])->name('admin.offre.edit');
    Route::put('/admin/update/offre/{id}', [OffreController::class, 'update'])->name('admin.offre.update');
    Route::delete('/admin/destroy/offre/{id}', [OffreController::class, 'destroy'])->name('admin.offre.destroy');


    Route::get('/admin/demandes', [DemandeController::class, 'index'])->name('admin.demandes');
    Route::put('/admin/update/accepter/demande/{id}', [DemandeController::class, 'accepter'])->name('admin.demande.accepter');
    Route::put('/admin/update/refuser/demande/{id}', [DemandeController::class, 'refuser'])->name('admin.demande.refuser');
    Route::put('/admin/update/encours/demande/{id}', [DemandeController::class, 'encours'])->name('admin.demande.encours');

    Route::get('/demande/cv/pdf/{path}/admin', [DemandeController::class, 'createPDFCV'])->name('admin.demande.cv.pdf');
    Route::get('/demande/lm/pdf/{path}/admin', [DemandeController::class, 'createPDFLM'])->name('admin.demande.lm.pdf');
    Route::get('/download-pdf-cv/{id}/admin', [DemandeController::class, 'downloadCV'])->name('admin.demande.cv');
    Route::get('/download-pdf-lm/{id}/admin', [DemandeController::class, 'downloadLM'])->name('admin.demande.lm');

    Route::get('/admin/create/demande', [DemandeController::class, 'create'])->name('admin.demande.create');
    Route::post('/admin/store/demande', [DemandeController::class, 'store'])->name('admin.demande.store');
    Route::get('/admin/demande/{id}', [DemandeController::class, 'show'])->name('admin.demande.show');
    Route::get('/admin/edit/demande/{id}', [DemandeController::class, 'edit'])->name('admin.demande.edit');
    Route::put('/admin/update/demande/{id}', [DemandeController::class, 'update'])->name('admin.demande.update');
    Route::delete('/admin/destroy/demande/{id}', [DemandeController::class, 'destroy'])->name('admin.demande.destroy');

    Route::get('/admin/stages', [StageController::class, 'index'])->name('admin.stages');
    Route::delete('/admin/destroy/stage/{id}', [StageController::class, 'destroy'])->name('admin.stage.destroy');

    Route::get('/stage/fc/pdf/{path}/admin', [StageController::class, 'createPDFFC'])->name('admin.stage.fc.pdf');
    Route::get('/stage/fe/pdf/{path}/admin', [StageController::class, 'createPDFFE'])->name('admin.stage.fe.pdf');
    Route::get('/stage/rap/pdf/{path}/admin', [StageController::class, 'createPDFRapport'])->name('admin.stage.rap.pdf');

    Route::get('/download-pdf-att/{id}/admin', [StageController::class, 'downloadAttestation'])->name('admin.stage.att');
    Route::get('/download-pdf-fc/{id}/admin', [StageController::class, 'downloadFC'])->name('admin.stage.fc');
    Route::get('/download-pdf-fe/{id}/admin', [StageController::class, 'downloadFE'])->name('admin.stage.fe');
    Route::get('/download-pdf-rap/{id}/admin', [StageController::class, 'downloadRapport'])->name('admin.stage.rap');

    Route::get('/admin/docs', [DocumentController::class, 'index'])->name('admin.docs');

    Route::get('/document/cv/pdf/{path}', [DocumentController::class, 'createPDFCV'])->name('admin.document.cv.pdf');
    Route::get('/document/lm/pdf/{path}', [DocumentController::class, 'createPDFLM'])->name('admin.document.lm.pdf');
    Route::get('/download-pdf-cv//doc/{id}', [DocumentController::class, 'downloadCV'])->name('admin.document.cv');
    Route::get('/download-pdf-lm/doc/{id}', [DocumentController::class, 'downloadLM'])->name('admin.document.lm');

    Route::get('/document/fc/pdf/{path}', [DocumentController::class, 'createPDFFC'])->name('admin.document.fc.pdf');
    Route::get('/document/fe/pdf/{path}', [DocumentController::class, 'createPDFFE'])->name('admin.document.fe.pdf');
    Route::get('/document/rap/pdf/{path}', [DocumentController::class, 'createPDFRapport'])->name('admin.document.rap.pdf');

    Route::get('/download-pdf-att/doc/{id}', [DocumentController::class, 'downloadAttestation'])->name('admin.document.att');
    Route::get('/download-pdf-fc/doc/{id}', [DocumentController::class, 'downloadFC'])->name('admin.document.fc');
    Route::get('/download-pdf-fe/doc/{id}', [DocumentController::class, 'downloadFE'])->name('admin.document.fe');
    Route::get('/download-pdf-rap/doc/{id}', [DocumentController::class, 'downloadRapport'])->name('admin.document.rap');

    Route::put('/stage/statut/prestage/{id}', [StageController::class, 'prestage'])->name('admin.stage.statut.prestage');
    Route::put('/stage/statut/encours/{id}', [StageController::class, 'encoursStage'])->name('admin.stage.statut.encours');
    Route::put('/stage/statut/finstage/{id}', [StageController::class, 'finStage'])->name('admin.stage.statut.finstage');

});

Route::get('users/offres', [OffreController::class, 'showPublishedOffres'])->name('users.offers.show');

Route::middleware('stg')->group(function () {
    Route::get('user/create/demande/offre/{offreId}', [DemandeController::class, 'create'])->name('user.offre.demande.create');
    Route::get('user/create/demande', [DemandeController::class, 'create'])->name('user.demande.create');
    Route::post('user/store/demande/offre/{offreId}', [DemandeController::class, 'store'])->name('user.offre.demande.store');
    Route::post('user/store/demande', [DemandeController::class, 'store'])->name('user.demande.store');
    Route::get('user/demandes', [DemandeController::class, 'index'])->name('user.demandes');
    Route::get('/demande/cv/pdf/{path}', [DemandeController::class, 'createPDFCV'])->name('user.demande.cv.pdf');
    Route::get('/demande/lm/pdf/{path}', [DemandeController::class, 'createPDFLM'])->name('user.demande.lm.pdf');
    Route::delete('/user/destroy/demande/{id}', [DemandeController::class, 'destroy'])->name('user.demande.destroy');
    Route::delete('/user/destroy/demande/{id}/offre/{offreId}', [DemandeController::class, 'destroy'])->name('user.offre.demande.destroy');

    Route::get('user/edit/demande/{id}', [DemandeController::class, 'edit'])->name('user.demande.edit');
    Route::put('user/update/demande/{id}', [DemandeController::class, 'update'])->name('user.demande.update');

    Route::get('user/edit/stg/{id}', [StagiaireController::class, 'edit'])->name('user.stg.edit');
    Route::put('user/update/stg/{id}', [StagiaireController::class, 'update'])->name('user.stg.update');

    Route::get('user/infos', [StagiaireController::class, 'index'])->name('user.infos');

    Route::get('/user/stages', [StageController::class, 'index'])->name('user.stages');

    Route::put('/stage/update/fc/{id}', [StageController::class, 'updateFC'])->name('user.stage.update.fc');
    Route::put('/stage/update/fe/{id}', [StageController::class, 'updateFE'])->name('user.stage.update.fe');
    Route::put('/stage/update/rap/{id}', [StageController::class, 'updateRapport'])->name('user.stage.update.rap');

    Route::get('/stage/fc/pdf/{path}', [StageController::class, 'createPDFFC'])->name('user.stage.fc.pdf');
    Route::get('/stage/fe/pdf/{path}', [StageController::class, 'createPDFFE'])->name('user.stage.fe.pdf');
    Route::get('/stage/rap/pdf/{path}', [StageController::class, 'createPDFRapport'])->name('user.stage.rap.pdf');

    Route::get('/download-pdf-att/{id}', [StageController::class, 'downloadAttestation'])->name('user.stage.att');
    Route::get('/download-pdf-fc/{id}', [StageController::class, 'downloadFC'])->name('user.stage.fc');
    Route::get('/download-pdf-fe/{id}', [StageController::class, 'downloadFE'])->name('user.stage.fe');
    Route::get('/download-pdf-rap/{id}', [StageController::class, 'downloadRapport'])->name('user.stage.rap');

    Route::delete('/user/destroy/stage/{id}', [StageController::class, 'index'])->name('user.stage.destroy');

});

Route::fallback(function () {
    return view('page404');
});
