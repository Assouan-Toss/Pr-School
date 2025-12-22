<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AnnonceController;

// ====================
// ROUTES PUBLIQUES
// ====================
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/connexion', function () {
    return view('auth.connexion');
})->name('connexion');

Route::post('/connexion', [LoginController::class, 'login'])->name('connexion.post');

// ====================
// ROUTES PROTÉGÉES
// ====================
Route::middleware(['auth'])->group(function () {
    
    // ====================
    // ROUTES ANNONCES (AJOUTÉ ICI)
    // ====================
    
    // Routes annonces spécifiques AVANT la route avec paramètre {id}
    Route::middleware(['isProfesseur'])->group(function () {
        Route::get('/annonces/create', [AnnonceController::class, 'create'])->name('annonces.create');
        Route::post('/annonces/store', [AnnonceController::class, 'store'])->name('annonces.store');
        Route::get('/annonces/{id}/edit', [AnnonceController::class, 'edit'])->name('annonces.edit');
        Route::put('/annonces/{id}', [AnnonceController::class, 'update'])->name('annonces.update');
        Route::delete('/annonces/{id}', [AnnonceController::class, 'destroy'])->name('annonces.destroy');
    });
    
    // Routes annonces générales (APRÈS les spécifiques)
    Route::get('/annonces', [AnnonceController::class, 'index'])->name('annonces.index');
    Route::get('/annonces/{id}', [AnnonceController::class, 'show'])->name('annonces.show');
    
    // ====================
    // ROUTES COURS SPÉCIFIQUES
    // ====================
    
    Route::middleware(['isProfesseur'])->group(function () {
        Route::get('/cours/create', [CoursController::class, 'create'])->name('cours.create');
        Route::post('/cours/store', [CoursController::class, 'store'])->name('cours.store');
    });
    
    // ====================
    // ROUTES AVEC PARAMÈTRES
    // ====================
    Route::get('/cours/{id}', [CoursController::class, 'show'])->name('cours.show');
    
    // ====================
    // ROUTES GÉNÉRALES
    // ====================
    Route::get('/cours', [CoursController::class, 'index'])->name('cours.index');
    
    // ====================
    // ROUTES PAR RÔLE
    // ====================
    
    // ADMIN
    Route::middleware(['isAdmin'])->prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/eleves', [AdminController::class, 'manageEleves'])->name('admin.eleves');
        Route::get('/professeurs', [AdminController::class, 'manageProfesseurs'])->name('admin.professeurs');
        Route::get('/documents/download/{id}', [AdminController::class, 'downloadDocument'])->name('admin.documents.download');
        
        Route::post('/classes/create', [AdminController::class, 'createClasse'])->name('admin.classes.create');
        Route::post('/matieres/create', [AdminController::class, 'createMatiere'])->name('admin.matieres.create');
        Route::post('/professeurs/add', [AdminController::class, 'addProf'])->name('admin.professeurs.add');
        Route::post('/professeurs/assign-classe', [AdminController::class, 'assignClasse'])->name('admin.professeurs.assign-classe');
        Route::post('/professeurs/assign-matiere', [AdminController::class, 'assignMatiere'])->name('admin.professeurs.assign-matiere');
        Route::post('/documents/upload', [AdminController::class, 'uploadDocument'])->name('admin.documents.upload');
        Route::post('/bulletins/upload', [AdminController::class, 'uploadBulletin'])->name('admin.bulletins.upload');
        Route::post('/message/send', [MessageController::class, 'send'])->name('admin.message.send');
        
        // Routes annonces pour admin aussi (si besoin)
        Route::get('/annonces', [AdminController::class, 'annonces'])->name('admin.annonces');
    });
    
    // PROFESSEUR
    Route::middleware(['isProfesseur'])->prefix('prof')->group(function () {
        Route::get('/', [ProfesseurController::class, 'index'])->name('prof.dashboard');
        Route::get('/eleves', [ProfesseurController::class, 'manageEleves'])->name('prof.eleves');
        Route::get('/documents/download/{id}', [ProfesseurController::class, 'downloadDocument'])->name('prof.documents.download');
        
        Route::post('/cours/add', [ProfesseurController::class, 'addCours'])->name('prof.cours.add');
        Route::post('/message/send', [MessageController::class, 'send'])->name('prof.message.send');
        
        // Routes annonces pour prof
        Route::get('/annonces', [ProfesseurController::class, 'annonces'])->name('prof.annonces');
    });
    
    // ÉLÈVE
    Route::middleware(['isEleve'])->prefix('eleve')->group(function () {
        Route::get('/', [EleveController::class, 'index'])->name('eleve.dashboard');
        Route::get('/bulletins', [EleveController::class, 'bulletins'])->name('eleve.bulletins');
        Route::get('/annonces', [EleveController::class, 'annonces'])->name('eleve.annonces');
        Route::get('/documents/download/{id}', [EleveController::class, 'downloadDocument'])->name('eleve.documents.download');
        
        Route::post('/message/send', [MessageController::class, 'send'])->name('eleve.message.send');
    });
});

// ====================
// ROUTES DE DÉCONNEXION
// ====================
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ====================
// ROUTES DE FALLBACK (TOUJOURS EN DERNIER)
// ====================
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});