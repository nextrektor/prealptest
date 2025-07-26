<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'email' => 'Invalid credentials.',
    ])->onlyInput('email');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/clear-laravel', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache'); // Rebuild config from .env
    return 'Laravel cache cleared';
});

Route::post('/greq-web', function () {
    $secret = 'Yiaa%72y12ii98_ba%m^R$';
    $signature = request()->header('X-Hub-Signature-256');
    $payload = file_get_contents('php://input');

    if (!$signature || !hash_equals('sha256=' . hash_hmac('sha256', $payload, $secret), $signature)) {
        abort(403, 'Unauthorized');
    }

    $json = json_decode($payload, true);
    if (isset($json['zen'])) {
        return response()->json(['message' => 'Ping received!']);
    }

    exec('/home/u912061746/domains/temanmajulogistics.com/laravel/prealptest/deploy.sh 2>&1', $output);
    return response()->json(['output' => $output]);
});


Route::get('/te', function () {
    return 'This is done';
});
