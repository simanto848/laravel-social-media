<?php

use App\Http\Controllers\FriendController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('friend')->as('friend.')->group(function () {
    // Send friend request
    Route::post('/{friendId}/send-request', [FriendController::class, 'sendRequest'])->name('send-request');

    // Accept friend request
    Route::post('/{friendId}/accept-request', [FriendController::class, 'acceptRequest'])->name('accept-request');

    // Reject friend request
    Route::post('/{friendId}/reject-request', [FriendController::class, 'rejectRequest'])->name('reject-request');

    // Remove friend
    Route::delete('/{friendId}/remove-friend', [FriendController::class, 'removeFriend'])->name('remove-friend');

    // Get all friend requests
    Route::get('/requests', [FriendController::class, 'getRequests'])->name('requests');

    // Get all friends
    Route::get('/all', [FriendController::class, 'listFriends'])->name('all');

    // Get mutual friends
    Route::get('/{friendId}/mutual-friends', [FriendController::class, 'mutualFriends'])->name('mutual-friends');

    // Find friends
    Route::get('/find', [FriendController::class, 'findFriends'])->name('find');

    // Search friends
    Route::get('/search', [FriendController::class, 'searchFriends'])->name('search');
});