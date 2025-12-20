<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\EleveController;




Route::get('/', function () {
    return view('welcome');
});


//les routes complet des admins
Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // Classes
    Route::post('/admin/classes/create', [AdminController::class, 'createClasse']);

    // Matières
    Route::post('/admin/matieres/create', [AdminController::class, 'createMatiere']);

    // Professeurs (CRUD)
    Route::post('/admin/professeurs/add', [AdminController::class, 'addProf']);
    Route::post('/admin/professeurs/assign-classe', [AdminController::class, 'assignClasse']);
    Route::post('/admin/professeurs/assign-matiere', [AdminController::class, 'assignMatiere']);

    // Élèves & Professeurs
    Route::get('/admin/eleves', [AdminController::class, 'manageEleves']);
    Route::get('/admin/professeurs', [AdminController::class, 'manageProfesseurs']);

    // Documents
    Route::post('/admin/documents/upload', [AdminController::class, 'uploadDocument']);
    Route::get('/admin/documents/download/{id}', [AdminController::class, 'downloadDocument']);

    // Bulletins
    Route::post('/admin/bulletins/upload', [AdminController::class, 'uploadBulletin']);

    // Messages
    Route::post('/admin/message/send', [MessageController::class, 'send']);
});



//les rotes des profs
Route::middleware(['auth', 'isProfesseur'])->group(function () {

    Route::get('/prof', [ProfesseurController::class, 'index'])->name('prof.dashboard');

    // cours & documents
    Route::post('/prof/cours/add', [ProfesseurController::class, 'addCours']);
    Route::get('/prof/documents/download/{id}', [ProfesseurController::class, 'downloadDocument']);

    // élèves
    Route::get('/prof/eleves', [ProfesseurController::class, 'manageEleves']);

    // messages
    Route::post('/prof/message/send', [MessageController::class, 'send']);
});




//les routes des eleves
Route::middleware(['auth', 'isEleve'])->group(function () {

    Route::get('/eleve', [EleveController::class, 'index'])->name('eleve.dashboard');

    // Téléchargement documents
    Route::get('/eleve/documents/download/{id}', [EleveController::class, 'downloadDocument']);

    // Bulletins
    Route::get('/eleve/bulletins', [EleveController::class, 'bulletins']);

    // Annonces
    Route::get('/eleve/annonces', [EleveController::class, 'annonces']);

    // Messages
    Route::post('/eleve/message/send', [MessageController::class, 'send']);
});





//les routes pour les middlware
Route::middleware(['isAdmin'])->group(function () {
    // routes admin
});
Route::middleware(['isProfesseur'])->group(function () {
    // routes prof
});
Route::middleware(['isEleve'])->group(function () {
    // routes eleve
});

