<?php

use App\Http\Controllers\FriendController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('friend')->as('friend')->group(function () {
    // Send friend request
    Route::post('/{friendId}/send-request', [FriendController::class, 'sendRequest']);

    // Accept friend request
    Route::post('/{friendId}/accept-request', [FriendController::class, 'acceptRequest']);

    // Reject friend request
    Route::post('/{friendId}/reject-request', [FriendController::class, 'rejectRequest']);

    // Remove friend
    Route::delete('/{friendId}/remove-friend', [FriendController::class, 'removeFriend']);

    // Get all friend requests
    Route::get('/requests', [FriendController::class, 'getRequests']);

    // Get all friends
    Route::get('/all', [FriendController::class, 'listFriends']);

    // Get mutual friends
    Route::get('/{friendId}/mutual-friends', [FriendController::class, 'mutualFriends']);

    // Find friends
    Route::get('/find', [FriendController::class, 'findFriends']);

    // Search friends
    Route::get('/search', [FriendController::class, 'searchFriends']);
});