<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.redirect');

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();

    $user = User::updateOrCreate(
        ['google_id' => $googleUser->id],
        [
            'name'  => $googleUser->name,
            'email' => $googleUser->email,
            'avatar'=> $googleUser->avatar,
        ]
    );

    Auth::login($user);

    return redirect('/dashboard');
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
