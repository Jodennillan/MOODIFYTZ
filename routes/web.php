<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PeerChatController;
use App\Http\Controllers\MoodEntryController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\ForumReplyController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\TherapistChatController;
use App\Http\Controllers\Admin\UserManagementController;
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
    return view('intro');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Assessment routes
Route::get('/assessment/download/{assessment}', [AssessmentController::class, 'download'])
    ->name('assessment.download');
Route::get('/assessment', [AssessmentController::class, 'create'])->name('assessment.create');
Route::post('/assessment', [AssessmentController::class, 'store'])->name('assessment.store');
Route::get('/assessment/results/{assessment}', [AssessmentController::class, 'show'])->name('assessment.results');

Route::middleware(['auth'])->group(function () {
    Route::get('/mood/index', [MoodController::class, 'index'])->name('mood.index');
    Route::get('/mood/create', [MoodController::class, 'create'])->name('mood.create');
    Route::post('/mood', [MoodController::class, 'store'])->name('mood.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum/store', [ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forum.show');
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::post('/forum/{post}/like', [ForumController::class, 'like'])->name('forum.like');   
    Route::post('/forum/{post}/like-toggle', [ForumController::class, 'toggleLike'])->name('forum.like.toggle');

    
});
// Add these routes
Route::middleware(['auth'])->group(function () {
    // Forum routes
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum/store', [ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{post}', [ForumController::class, 'show'])->name('forum.show');
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::post('/forum/{post}/like-toggle', [ForumController::class, 'toggleLike'])->name('forum.toggle-like');
    Route::post('/forum/{post}/reply', [ForumController::class, 'storeReply'])->name('forum.reply.store');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/therapist-chat', [TherapistChatController::class, 'index'])->name('therapist.chat');
    Route::post('/therapist-chat/send', [TherapistChatController::class, 'send'])->name('therapist.message.send');
});



Route::middleware(['auth', 'is_therapist'])->group(function () {
    Route::get('/therapist-panel', [TherapistChatController::class, 'panel'])->name('therapist.panel');
    Route::get('/therapist-chat/{user}', [TherapistChatController::class, 'chatWithUser'])->name('therapist.chat.with');
     Route::post('/therapist-chat/send/{userId}', [TherapistChatController::class, 'sendToUser'])->name('therapist.message.send.to');
   Route::post('/therapist-chat/send/{userId}', [TherapistChatController::class, 'sendToUserJson'])->name('therapist.message.send.json');

});



// Group chat
Route::get('/ask-peer', [PeerChatController::class, 'index'])->name('peer.group');
Route::post('/ask-peer/send', [PeerChatController::class, 'sendMessage'])->name('peer.message.send');

// Private DM
Route::get('/ask-peer/{id}', [PeerChatController::class, 'privateChat'])->name('peer.dm');
Route::post('/ask-peer/{id}/send', [PeerChatController::class, 'sendPrivate'])->name('peer.dm.send');



Route::get('/therapist-chat/messages/{userId}', [TherapistChatController::class, 'fetchMessages'])
      ->name('therapist.chat.fetch')
      ->middleware(['auth', 'is_therapist']);
Route::get('/user-chat/fetch/{therapistId}', [TherapistChatController::class, 'fetchUserMessages'])
     ->middleware(['auth'])
     ->name('user.chat.fetch');



Route::middleware(['auth'])->group(function () {
    // Mood routes
    Route::get('/mood/create', [MoodController::class, 'create'])->name('mood.create');
    Route::post('/mood/store', [MoodController::class, 'store'])->name('mood.store');
    Route::get('/mood/feedback', [MoodController::class, 'feedback'])->name('mood.feedback');
    Route::get('/mood/history', [MoodController::class, 'history'])->name('mood.history');
    
    // Other routes
    Route::get('/therapist/chat', [TherapistController::class, 'chat'])->name('therapist.chat');
    Route::get('/journal/create', [JournalController::class, 'create'])->name('journal.create');
});

Route::post('/therapist-chat/conclusion/{userId}', [TherapistChatController::class, 'sendConclusion'])->name('therapist.conclusion.send');


Route::middleware(['auth'])->group(function () {
    // Journal routes
    Route::prefix('journal')->group(function () {
        Route::get('/history', [JournalController::class, 'history'])->name('journal.history');
        Route::get('/create', [JournalController::class, 'create'])->name('journal.create');
        Route::post('/store', [JournalController::class, 'store'])->name('journal.store');
        Route::get('/{entry}/edit', [JournalController::class, 'edit'])->name('journal.edit');
        Route::put('/{entry}', [JournalController::class, 'update'])->name('journal.update');
        Route::delete('/{entry}', [JournalController::class, 'destroy'])->name('journal.destroy');
    });
    

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Therapist routes
Route::post('/therapist/first-visit', [TherapistChatController::class, 'setFirstVisit'])->name('therapist.first-visit');
Route::get('/therapist/chat', [TherapistChatController::class, 'index'])->name('therapist.chat');
Route::post('/therapist/message/send', [TherapistChatController::class, 'send'])->name('therapist.message.send');
Route::get('/therapist/panel', [TherapistChatController::class, 'panel'])->name('therapist.panel');
Route::get('/therapist/chat/{userId}', [TherapistChatController::class, 'chatWithUser'])->name('therapist.chat.with');
Route::post('/therapist-chat/send/{userId}', [TherapistChatController::class, 'sendToUserJson']);
Route::get('/therapist-chat/fetch/{userId}', [TherapistChatController::class, 'fetchMessages']);
Route::post('/therapist/conclusion/{userId}', [TherapistChatController::class, 'sendConclusion'])->name('therapist.conclusion.send');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [UserManagementController::class, 'index'])->name('admin.users');
    Route::post('/users/add-therapist', [UserManagementController::class, 'addTherapist'])->name('admin.users.add.therapist');
    Route::get('/users/{id}/edit', [UserManagementController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [UserManagementController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserManagementController::class, 'destroy'])->name('admin.users.delete');
});

require __DIR__.'/auth.php';
