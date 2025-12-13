<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google-auth/callback', function () {
    $user_google = Socialite::driver('google')->user();

    $user = User::updateOrCreate(
        ['google_id' => $user_google->id],
        [
            'name'  => $user_google->name,
            'email' => $user_google->email,
            'avatar'=> $user_google->avatar,
        ]
    );

    Auth::login($user);

    return redirect('/dashboard');

    // $user->token
});



Route::get('google-auth/redirect', function(){
    return Socialite::driver('google')->redirect();
});

Route::get('google-auth/callback', function(){
    $user = Socialite::driver('google')->user();

    // $user->token
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
