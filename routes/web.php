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
use App\Http\Controllers\Auth\RegisterEleveController;

// ====================
// ROUTES PUBLIQUES
// ====================
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/accueil', function () {
    return view('welcome');
})->name('accueil');

Route::get('/about', function () {
    return view('welcome');
})->name('about');

Route::get('/contact', function () {
    return view('welcome');
})->name('contact');

// Inscription des élèves
Route::get('/inscription/eleve', [RegisterEleveController::class, 'create'])
    ->name('eleve.register');
Route::post('/inscription/eleve', [RegisterEleveController::class, 'store'])
    ->name('eleve.register.store');

// Connexion
Route::get('/connexion', function () {
    return view('auth.connexion');
})->name('connexion');
Route::post('/connexion', [LoginController::class, 'login'])->name('connexion.post');

// Déconnexion
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout.get');

// ====================
// ROUTES PROTÉGÉES
// ====================
Route::middleware(['auth'])->group(function () {
    
    // ====================
    // ROUTES MESSAGES (Communes à tous)
    // ====================
    Route::prefix('messages')->group(function () {
        Route::get('/', function () {
            return redirect()->route('messages.inbox');
        })->name('messages.index');
        
        Route::get('/inbox', [MessageController::class, 'inbox'])
            ->name('messages.inbox');
        Route::get('/sent', [MessageController::class, 'sent'])
            ->name('messages.sent');
        Route::get('/create', [MessageController::class, 'create'])
            ->name('messages.create');
        Route::post('/send', [MessageController::class, 'send'])
            ->name('messages.send');
        Route::post('/', [MessageController::class, 'store'])->name('messages.store');
    });
    
    // ====================
    // ROUTES ANNONCES (Communes à tous)
    // ====================
    Route::prefix('annonces')->group(function () {
        Route::get('/', [AnnonceController::class, 'index'])->name('annonces.index');
        Route::get('/{id}', [AnnonceController::class, 'show'])->name('annonces.show');
        
        // Routes réservées aux professeurs
        Route::middleware(['isProfesseur'])->group(function () {
            Route::get('/create', [AnnonceController::class, 'create'])->name('annonces.create');
            Route::post('/store', [AnnonceController::class, 'store'])->name('annonces.store');
            Route::get('/{id}/edit', [AnnonceController::class, 'edit'])->name('annonces.edit');
            Route::put('/{id}', [AnnonceController::class, 'update'])->name('annonces.update');
            Route::delete('/{id}', [AnnonceController::class, 'destroy'])->name('annonces.destroy');
        });
    });
    
    // ====================
    // ROUTES COURS (Communes à tous)
    // ====================
    Route::prefix('cours')->group(function () {
        Route::get('/', [CoursController::class, 'index'])->name('cours.index');
        Route::get('/{id}', [CoursController::class, 'show'])->name('cours.show');
        
        // Routes réservées aux professeurs
        Route::middleware(['isProfesseur'])->group(function () {
            Route::get('/create', [CoursController::class, 'create'])->name('cours.create');
            Route::post('/store', [CoursController::class, 'store'])->name('cours.store');
        });
    });
    
    // ====================
    // ROUTES DOCUMENTS ET BIBLIOTHÈQUE (Communes à tous)
    // ====================
    Route::get('/bibliotheque', [BibliothequeController::class, 'index'])
        ->name('bibliotheque.index');
    
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])
        ->name('documents.download');
    
    // Routes réservées aux professeurs
    Route::middleware(['isProfesseur'])->group(function () {
        Route::get('/documents/create', [DocumentController::class, 'create'])
            ->name('documents.create');
        Route::post('/documents/store', [DocumentController::class, 'store'])
            ->name('documents.store');
    });
    
    // ====================
    // ROUTES PAR RÔLE
    // ====================
    
    // ADMIN - Doit être placé AVANT les routes paramétrées génériques
    Route::middleware(['isAdmin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        
        // Gestion des utilisateurs
        Route::get('/eleves', [AdminController::class, 'manageEleves'])->name('eleves');
        Route::get('/professeurs', [AdminController::class, 'manageProfesseurs'])->name('professeurs');
        
        // Gestion académique
        Route::get('/classes', [AdminController::class, 'classes'])->name('classes');
        Route::post('/classes/create', [AdminController::class, 'createClasse'])->name('classes.create');
        Route::delete('/classes/delete/{id}', [AdminController::class, 'deleteClasse'])->name('classes.delete');
        Route::post('/matieres/create', [AdminController::class, 'createMatiere'])->name('matieres.create');
        
        // Gestion des professeurs
        Route::post('/professeurs/add', [AdminController::class, 'addProf'])->name('professeurs.add');
        Route::post('/professeurs/assign-classe', [AdminController::class, 'assignClasse'])->name('professeurs.assign-classe');
        Route::post('/professeurs/assign-matiere', [AdminController::class, 'assignMatiere'])->name('professeurs.assign-matiere');
        
        // Gestion des documents
        Route::get('/documents/download/{id}', [AdminController::class, 'downloadDocument'])->name('documents.download');
        Route::post('/documents/upload', [AdminController::class, 'uploadDocument'])->name('documents.upload');
        
        Route::get('/bibliotheque', [BibliothequeController::class, 'index'])->name('bibliotheque.index');
        Route::get('/documents/download/{id}', [BibliothequeController::class, 'download'])->name('documents.download');
        
        // Gestion des annonces
        Route::get('/annonces', [AdminController::class, 'annonces'])->name('annonces');
        
        // Gestion des bulletins 
        Route::prefix('bulletins')->name('bulletins.')->group(function () {
            Route::get('/', [AdminController::class, 'bulletins'])->name('index');
            Route::get('/create', [AdminController::class, 'createBulletin'])->name('create');
            Route::post('/', [AdminController::class, 'storeBulletin'])->name('store');
            Route::post('/upload', [AdminController::class, 'uploadBulletin'])->name('upload');
            Route::delete('/{id}', [AdminController::class, 'destroyBulletin'])->name('destroy');
        });
        
        // Messages
        Route::post('/message/send', [MessageController::class, 'send'])->name('message.send');
    });
    
    // PROFESSEUR
    Route::middleware(['isProfesseur'])->prefix('prof')->name('prof.')->group(function () {
        Route::get('/', [ProfesseurController::class, 'index'])->name('dashboard');
        Route::get('/eleves', [ProfesseurController::class, 'manageEleves'])->name('eleves');
        Route::get('/annonces', [ProfesseurController::class, 'annonces'])->name('annonces');
        
        Route::get('/documents/download/{id}', [ProfesseurController::class, 'downloadDocument'])->name('documents.download');
        Route::post('/cours/add', [ProfesseurController::class, 'addCours'])->name('cours.add');
        Route::post('/message/send', [MessageController::class, 'send'])->name('message.send');
    });
    
    // ÉLÈVE
    Route::middleware(['isEleve'])->prefix('eleve')->name('eleve.')->group(function () {
        Route::get('/', [EleveController::class, 'index'])->name('dashboard');
        Route::get('/annonces', [EleveController::class, 'annonces'])->name('annonces');
        Route::get('/bulletins', [EleveController::class, 'bulletins'])->name('bulletins');
        Route::get('/documents/download/{id}', [EleveController::class, 'downloadDocument'])->name('documents.download');
        
        Route::post('/message/send', [MessageController::class, 'send'])->name('message.send');
        
        // Routes pour la gestion des élèves
        Route::resource('eleves', EleveController::class);
        Route::get('/gestion-eleves', [EleveController::class, 'index'])->name('gestion.eleves');
    });
});