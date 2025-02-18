<?php

use App\Http\Controllers\FriendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('friend')->group(function () {
    Route::post('/requests/{userId}', [FriendController::class, 'sendRequest'])->name('friends.sendRequest');
    Route::patch('/requests/{friendId}', [FriendController::class, 'acceptRequest'])->name('friends.acceptRequest');
    Route::patch('/requests/{friendId}/reject', [FriendController::class, 'rejectRequest'])->name('friends.rejectRequest');
    Route::delete('/requests/remove/{friendId}', [FriendController::class, 'removeFriend'])->name('friends.removeFriend');
    Route::get('/requests', [FriendController::class, 'getRequests'])->name('friends.getRequests');
    Route::get('/list', [FriendController::class, 'getFriends'])->name('friends.getFriends');
});

require __DIR__.'/auth.php';
