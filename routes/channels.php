<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

/**
 * [TAMBAHKAN INI]
 * Channel otorisasi untuk setiap pertandingan.
 * Ini mengizinkan semua pengguna yang sudah login untuk mendengarkan
 * event dari channel pertandingan yang spesifik.
 */
Broadcast::channel('pertandingan.{pertandinganId}', function ($user, $pertandinganId) {
    return Auth::check();
});
