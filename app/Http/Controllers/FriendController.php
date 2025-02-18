<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFriendRequest;
use App\Http\Requests\UpdateFriendRequest;
use App\Models\Friend;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function sendRequest($userId)
    {
        $authUserId = Auth::id();

        // Prevent sending friend request to self
        if($authUserId == $userId) {
            return response()->json(['message' => 'You cannot send friend request to yourself'], 400);
        }

        // Check if a request already exists
        $existingRequest = Friend::where(function($query) use ($authUserId, $userId) {
            $query->where('user1_id', $authUserId)->where('user2_id', $userId);
        })->orWhere(function($query) use ($authUserId, $userId) {
            $query->where('user1_id', $userId)->where('user2_id', $authUserId);
        })->first();

        if ($existingRequest) {
            return response()->json(['message' => 'Friend request already exists or you are already friends'], 409);
        }

        // Create new friend request
        $friendRequest = Friend::create([
            'user1_id' => $authUserId,
            'user2_id' => $userId,
            'status' => 'pending'
        ]);

        return response()->json(['message' => 'Friend request sent successfully', 'data' => $friendRequest], 201);
    }

    /**
     * Accept a friend request
     */
    public function acceptRequest($friendId)
    {
        $authUserId = Auth::id();
        
        $request = Friend::where('user1_id', $friendId)
            ->where('user2_id', $authUserId)
            ->where('status', 'pending')
            ->first();

        if (!$request) {
            return response()->json(['message' => 'Friend request not found'], 404);
        }

        $request->update(['status' => 'accepted']);

        return response()->json(['message' => 'Friend request accepted']);
    }

    /**
     * Reject a friend request
     */
    public function rejectRequest($friendId){
        $authUserId = Auth::id();
        
        $request = Friend::where('user1_id', $friendId)
            ->where('user2_id', $authUserId)
            ->where('status', 'pending')
            ->first();

        if (!$request) {
            return response()->json(['message' => 'Friend request not found'], 404);
        }

        $request->delete();

        return response()->json(['message' => 'Friend request rejected']);
    }

    /**
     * Remove a friend
     */
    public function removeFriend($friendId) {
        $authUserId = Auth::id();
        
        $friendship = Friend::where(function($query) use ($authUserId, $friendId) {
            $query->where('user1_id', $authUserId)->where('user2_id', $friendId);
        })->orWhere(function($query) use ($authUserId, $friendId) {
            $query->where('user1_id', $friendId)->where('user2_id', $authUserId);
        })->where('status', 'accepted')
        ->first();

        if (!$friendship) {
            return response()->json(['message' => 'Friendship not found'], 404);
        }

        $friendship->delete();

        return response()->json(['message' => 'Friend removed successfully']);
    }

    /**
     * List all friends of authenticated user
     */
    public function listFriends() {
        $authUserId = Auth::id();
        
        $friends = Friend::where(function($query) use ($authUserId) {
            $query->where('user1_id', $authUserId)->orWhere('user2_id', $authUserId);
        })->where('status', 'accepted')
        ->with(['user1', 'user2'])
        ->get()
        ->map(function($friendship) use ($authUserId) {
            return $friendship->user1_id === $authUserId 
                ? $friendship->user2 
                : $friendship->user1;
        });

        return response()->json(['friends' => $friends]);
    }
}
