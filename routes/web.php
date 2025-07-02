<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PeerChatController;
use App\Http\Controllers\MoodEntryController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\ForumReplyController;
use App\Http\Controllers\TherapistChatController;
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


Route::get('/assessment', [AssessmentController::class, 'create'])->name('assessment.create');
Route::post('/assessment', [AssessmentController::class, 'store'])->name('assessment.store');

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

Route::middleware(['auth'])->group(function () {
    Route::get('/therapist-chat', [TherapistChatController::class, 'index'])->name('therapist.chat');
    Route::post('/therapist-chat/send', [TherapistChatController::class, 'send'])->name('therapist.message.send');
});



Route::middleware(['auth', 'is_therapist'])->group(function () {
    Route::get('/therapist-panel', [TherapistChatController::class, 'panel'])->name('therapist.panel');
    Route::get('/therapist-chat/{user}', [TherapistChatController::class, 'chatWithUser'])->name('therapist.chat.with');
     Route::post('/therapist-chat/send/{userId}', [TherapistChatController::class, 'sendToUser'])->name('therapist.message.send.to');
    Route::post('/therapist-chat/send/{user}', [TherapistChatController::class, 'sendToUser'])->name('therapist.chat.send');
});


// Group chat
Route::get('/ask-peer', [PeerChatController::class, 'index'])->name('peer.group');
Route::post('/ask-peer/send', [PeerChatController::class, 'sendMessage'])->name('peer.message.send');

// Private DM
Route::get('/ask-peer/{id}', [PeerChatController::class, 'privateChat'])->name('peer.dm');
Route::post('/ask-peer/{id}/send', [PeerChatController::class, 'sendPrivate'])->name('peer.dm.send');


Route::post('/forum/{post}/reply', [ForumReplyController::class, 'store'])->middleware('auth')->name('forum.reply.store');

Route::get('/therapist-chat/messages/{userId}', [TherapistChatController::class, 'fetchMessages'])
      ->name('therapist.chat.fetch')
      ->middleware(['auth', 'is_therapist']);
Route::get('/user-chat/fetch/{therapistId}', [TherapistChatController::class, 'fetchUserMessages'])
     ->middleware(['auth'])
     ->name('user.chat.fetch');



Route::get('/mood/feedback', [MoodController::class, 'feedback'])->name('mood.feedback');
Route::get('/mood/history', [MoodController::class, 'history'])->name('mood.history');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
