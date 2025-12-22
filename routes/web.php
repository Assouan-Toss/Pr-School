<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\BibliothequeController;


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
    // ROUTES ANNONCES
    // ====================
    
    // Routes annonces spécifiques (professeurs)
    Route::middleware(['isProfesseur'])->group(function () {
        Route::get('/annonces/create', [AnnonceController::class, 'create'])->name('annonces.create');
        Route::post('/annonces/store', [AnnonceController::class, 'store'])->name('annonces.store');
        Route::get('/annonces/{id}/edit', [AnnonceController::class, 'edit'])->name('annonces.edit');
        Route::put('/annonces/{id}', [AnnonceController::class, 'update'])->name('annonces.update');
        Route::delete('/annonces/{id}', [AnnonceController::class, 'destroy'])->name('annonces.destroy');
    });
    
    // Routes annonces générales
    Route::get('/annonces', [AnnonceController::class, 'index'])->name('annonces.index');
    Route::get('/annonces/{id}', [AnnonceController::class, 'show'])->name('annonces.show');
    
    // ====================
    // ROUTES COURS
    // ====================
    
    // Route générale d'abord
    Route::get('/cours', [CoursController::class, 'index'])->name('cours.index');
    
    // Routes spécifiques professeurs
    Route::middleware(['isProfesseur'])->group(function () {
        Route::get('/cours/create', [CoursController::class, 'create'])->name('cours.create');
        Route::post('/cours/store', [CoursController::class, 'store'])->name('cours.store');
    });
    
    // Route avec paramètre en DERNIER
    Route::get('/cours/{id}', [CoursController::class, 'show'])->name('cours.show');
    
    // ====================
    // ROUTES DOCUMENTS (DÉPLACÉ ICI)
    // ====================
    Route::middleware(['isProfesseur'])->group(function () {
        Route::get('/documents/create', [DocumentController::class, 'create'])
            ->name('documents.create');
        Route::post('/documents/store', [DocumentController::class, 'store'])
            ->name('documents.store');
    });
    
    // ====================
    // ROUTE BIBLIOTHÈQUE (DÉPLACÉ ICI)
    // ====================
    Route::get('/bibliotheque', function () {
        return view('bibliotheque.index');
    })->name('bibliotheque.index');


    Route::middleware(['auth'])->group(function () {
    Route::get('/bibliotheque', [BibliothequeController::class, 'index'])
        ->name('bibliotheque.index');
    });

    

    
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
        
        Route::get('/annonces', [AdminController::class, 'annonces'])->name('admin.annonces');
    });
    
    // PROFESSEUR
    Route::middleware(['isProfesseur'])->prefix('prof')->group(function () {
        Route::get('/', [ProfesseurController::class, 'index'])->name('prof.dashboard');
        Route::get('/eleves', [ProfesseurController::class, 'manageEleves'])->name('prof.eleves');
        Route::get('/documents/download/{id}', [ProfesseurController::class, 'downloadDocument'])->name('prof.documents.download');
        
        Route::post('/cours/add', [ProfesseurController::class, 'addCours'])->name('prof.cours.add');
        Route::post('/message/send', [MessageController::class, 'send'])->name('prof.message.send');
        
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
// ROUTES DE FALLBACK (TOUJOURS EN DERNIER - ABSOLUMENT)
// ====================
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});