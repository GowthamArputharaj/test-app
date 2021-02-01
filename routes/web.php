<?php

use Illuminate\Support\Facades\Route;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
// use App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('git.auth.redirect');

Route::get('/auth/callback', function (Request $request) {

    // returns user details..
    $user = Socialite::driver('github')->user();
    
    // find user with email else create with email, name, password
    $user = User::firstOrCreate(
        [
            'email' => $user->getEmail()
        ],
        [
            'name' => $user->getName(),
            'password' => Hash::make('12345678')
        ]
    );

    // logins user
    auth()->login($user);

    // redirect to dashboard
    return redirect('dashboard');
    
});

Route::get('/translate', 'App\Http\Controllers\TranslateController@index');
Route::get('/translateText', 'App\Http\Controllers\TranslateController@translate');