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
use Illuminate\Support\Facades\Storage;
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

// Inscription
// Route::get('/inscription', function () {
//     return view('inscription');
// })->name('auth.inscription');

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
    // ROUTES ANNONCES
    // ====================
    Route::prefix('annonces')->group(function () {
        Route::get('/', [AnnonceController::class, 'index'])->name('annonces.index');
        Route::get('/{id}', [AnnonceController::class, 'show'])->name('annonces.show');
        
        Route::middleware(['isProfesseur'])->group(function () {
            Route::get('/create', [AnnonceController::class, 'create'])->name('annonces.create');
            Route::post('/store', [AnnonceController::class, 'store'])->name('annonces.store');
            Route::get('/{id}/edit', [AnnonceController::class, 'edit'])->name('annonces.edit');
            Route::put('/{id}', [AnnonceController::class, 'update'])->name('annonces.update');
            Route::delete('/{id}', [AnnonceController::class, 'destroy'])->name('annonces.destroy');
        });
    });
    
    // ====================
    // ROUTES COURS
    // ====================
    Route::prefix('cours')->group(function () {
        Route::get('/', [CoursController::class, 'index'])->name('cours.index');
        Route::get('/{id}', [CoursController::class, 'show'])->name('cours.show');
        
        Route::middleware(['isProfesseur'])->group(function () {
            Route::get('/create', [CoursController::class, 'create'])->name('cours.create');
            Route::post('/store', [CoursController::class, 'store'])->name('cours.store');
        });
    });
    
    // ====================
    // ROUTES DOCUMENTS ET BIBLIOTHÈQUE
    // ====================
    Route::get('/bibliotheque', [BibliothequeController::class, 'index'])
        ->name('bibliotheque.index');
    
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])
        ->name('documents.download');
    
    Route::middleware(['isProfesseur'])->group(function () {
        Route::get('/documents/create', [DocumentController::class, 'create'])
            ->name('documents.create');
        Route::post('/documents/store', [DocumentController::class, 'store'])
            ->name('documents.store');
    });
    
    // ====================
    // ROUTES MESSAGES
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
        Route::post('/', [MessageController::class, 'store']);
        Route::post('/send', [MessageController::class, 'send'])
            ->name('messages.send');
    });
    
    // ====================
    // ROUTES PAR RÔLE
    // ====================
    
    // ADMIN
    Route::middleware(['isAdmin'])->prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // Gestion des utilisateurs
        Route::get('/eleves', [AdminController::class, 'manageEleves'])->name('admin.eleves');
        Route::get('/professeurs', [AdminController::class, 'manageProfesseurs'])->name('admin.professeurs');
        
        // Gestion académique
        Route::get('/classes', [AdminController::class, 'classes'])->name('admin.classes');
        Route::post('/classes/create', [AdminController::class, 'createClasse'])->name('admin.classes.create');
        Route::post('/matieres/create', [AdminController::class, 'createMatiere'])->name('admin.matieres.create');
        
        // Gestion des professeurs
        Route::post('/professeurs/add', [AdminController::class, 'addProf'])->name('admin.professeurs.add');
        Route::post('/professeurs/assign-classe', [AdminController::class, 'assignClasse'])->name('admin.professeurs.assign-classe');
        Route::post('/professeurs/assign-matiere', [AdminController::class, 'assignMatiere'])->name('admin.professeurs.assign-matiere');
        
        // Gestion des documents
        Route::get('/documents/download/{id}', [AdminController::class, 'downloadDocument'])->name('admin.documents.download');
        Route::post('/documents/upload', [AdminController::class, 'uploadDocument'])->name('admin.documents.upload');
        
        // Gestion des annonces
        Route::get('/annonces', [AdminController::class, 'annonces'])->name('admin.annonces');
        
        // Gestion des bulletins
        Route::get('/bulletins', [AdminController::class, 'bulletins'])->name('admin.bulletins.index');
        Route::get('/bulletins/create', [AdminController::class, 'createBulletin'])->name('admin.bulletins.create');
        Route::post('/bulletins', [AdminController::class, 'storeBulletin'])->name('admin.bulletins.store');
        Route::post('/bulletins/upload', [AdminController::class, 'uploadBulletin'])->name('admin.bulletins.upload');
        Route::delete('/bulletins/{id}', [AdminController::class, 'destroyBulletin'])->name('admin.bulletins.destroy');
        
        // Messages
        Route::post('/message/send', [MessageController::class, 'send'])->name('admin.message.send');

        //Routes pour la gestion des classes
        Route::middleware(['auth', 'isAdmin'])->group(function () {

            Route::get('/admin/classes', [AdminController::class, 'classes']);
            Route::post('/admin/classes/create', [AdminController::class, 'createClasse']);
            Route::delete('/admin/classes/delete/{id}', [AdminController::class, 'deleteClasse']);

});

    });
    
    // PROFESSEUR
    Route::middleware(['isProfesseur'])->prefix('prof')->group(function () {
        Route::get('/', [ProfesseurController::class, 'index'])->name('prof.dashboard');
        Route::get('/eleves', [ProfesseurController::class, 'manageEleves'])->name('prof.eleves');
        Route::get('/annonces', [ProfesseurController::class, 'annonces'])->name('prof.annonces');
        
        Route::get('/documents/download/{id}', [ProfesseurController::class, 'downloadDocument'])->name('prof.documents.download');
        Route::post('/cours/add', [ProfesseurController::class, 'addCours'])->name('prof.cours.add');
        Route::post('/message/send', [MessageController::class, 'send'])->name('prof.message.send');
    });
    
    // ÉLÈVE
    Route::middleware(['isEleve'])->prefix('eleve')->group(function () {
        Route::get('/', [EleveController::class, 'index'])->name('eleve.dashboard');
        Route::get('/annonces', [EleveController::class, 'annonces'])->name('eleve.annonces');
        Route::get('/bulletins', [EleveController::class, 'bulletins'])->name('eleve.bulletins');
        Route::get('/documents/download/{id}', [EleveController::class, 'downloadDocument'])->name('eleve.documents.download');
        
        Route::post('/message/send', [MessageController::class, 'send'])->name('eleve.message.send');
        
        // Routes pour la gestion des élèves (si nécessaire)
        Route::resource('eleves', EleveController::class);
        Route::get('/gestion-eleves', [EleveController::class, 'index'])->name('gestion.eleves');
    });
});