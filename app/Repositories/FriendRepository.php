<?php

namespace App\Repositories;

use App\Models\Friend;
use App\Models\User;
use App\Repositories\Interfaces\FriendRepositoryInterface;

class FriendRepository implements FriendRepositoryInterface {
    
    public function sendFriendRequest($userId, $friendId) {
        return Friend::create([
            'user_id' => $userId,
            'friend_id' => $friendId,
            'status' => 'pending'
        ]);
    }

    public function acceptFriendRequest($userId, $friendId) {
        return Friend::where(function ($query) use ($userId, $friendId) {
            $query->where('user_id', $friendId)->where('friend_id', $userId);
        })->orWhere(function ($query) use ($userId, $friendId) {
            $query->where('user_id', $userId)->where('friend_id', $friendId);
        })->where('status', 'pending')->update(['status' => 'accepted']);
    }

    public function rejectFriendRequest($userId, $friendId) {
        return Friend::where(function ($query) use ($userId, $friendId) {
            $query->where('user_id', $friendId)->where('friend_id', $userId);
        })->orWhere(function ($query) use ($userId, $friendId) {
            $query->where('user_id', $userId)->where('friend_id', $friendId);
        })->where('status', 'pending')->delete();
    }

    public function unfriend($userId, $friendId) {
        return Friend::where(function ($query) use ($userId, $friendId) {
            $query->where('user_id', $userId)->where('friend_id', $friendId);
        })->orWhere(function ($query) use ($userId, $friendId) {
            $query->where('user_id', $friendId)->where('friend_id', $userId);
        })->where('status', 'accepted')->delete();
    }

    public function getFriendRequests($userId, $friendId = null) {
        $query = Friend::where('friend_id', $userId)->where('status', 'pending');

        if ($friendId) {
            $query->where('user_id', $friendId);
        }

        return $query->with('user')->get();
    }

    public function getFriends($userId) {
        return Friend::where(function ($query) use ($userId) {
            $query->where('user_id', $userId)->orWhere('friend_id', $userId);
        })->where('status', 'accepted')
        ->with(['user', 'friend'])
        ->get()
        ->map(function ($friendship) use ($userId) {
            return $friendship->user_id === $userId ? $friendship->friend : $friendship->user;
        });
    }

    public function getMutualFriends($userId, $friendId) {
        $userFriends = Friend::where(function ($query) use ($userId) {
            $query->where('user_id', $userId)->orWhere('friend_id', $userId);
        })->where('status', 'accepted')
        ->pluck('user_id', 'friend_id')->toArray();

        $friendFriends = Friend::where(function ($query) use ($friendId) {
            $query->where('user_id', $friendId)->orWhere('friend_id', $friendId);
        })->where('status', 'accepted')
        ->pluck('user_id', 'friend_id')->toArray();

        return array_values(array_intersect($userFriends, $friendFriends));
    }

    public function findFriends($userId, $page, $limit) {
        return User::where('id', '!=', $userId)
            ->whereNotIn('id', function ($query) use ($userId) {
                $query->select('friend_id')
                    ->from('friends')
                    ->where('user_id', $userId)
                    ->whereIn('status', ['accepted', 'pending'])
                    ->union(
                        $query->select('user_id')
                            ->from('friends')
                            ->where('friend_id', $userId)
                            ->whereIn('status', ['accepted', 'pending'])
                    );
            })
            ->paginate($limit, ['*'], 'page', $page);
    }

    public function searchFriends($userId, $search, $page, $limit){
        return User::where('id', '!=', $userId)
            ->where('name', 'like', "%$search%")
            ->whereNotIn('id', function ($query) use ($userId) {
                $query->select('friend_id')
                    ->from('friends')
                    ->where('user_id', $userId)
                    ->whereIn('status', ['accepted', 'pending']);
            })
            ->whereNotIn('id', function ($query) use ($userId) {
                $query->select('user_id')
                    ->from('friends')
                    ->where('friend_id', $userId)
                    ->whereIn('status', ['accepted', 'pending']);
            })
            ->paginate($limit, ['*'], 'page', $page);
    }    
}
