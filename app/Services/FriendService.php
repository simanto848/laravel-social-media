<?php

namespace App\Services;

use App\Repositories\Interfaces\FriendRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class FriendService
{
    protected $friendRepository;

    public function __construct(FriendRepositoryInterface $friendRepository)
    {
        $this->friendRepository = $friendRepository;
    }

    public function sendRequest($friendId)
    {
        $authUserId = Auth::id();

        if ($authUserId == $friendId) {
            return ['status' => false, 'message' => 'You cannot send a friend request to yourself'];
        }

        if ($this->friendRepository->getFriendRequests($authUserId, $friendId)->isNotEmpty()) {
            return ['status' => false, 'message' => 'Friend request already exists'];
        }

        $this->friendRepository->sendFriendRequest($authUserId, $friendId);
        return ['status' => true, 'message' => 'Friend request sent successfully'];
    }

    public function acceptRequest($friendId)
    {
        $authUserId = Auth::id();
        return $this->friendRepository->acceptFriendRequest($authUserId, $friendId);
    }

    public function rejectRequest($friendId)
    {
        $authUserId = Auth::id();
        return $this->friendRepository->rejectFriendRequest($authUserId, $friendId);
    }

    public function removeFriend($friendId)
    {
        $authUserId = Auth::id();
        return $this->friendRepository->unfriend($authUserId, $friendId);
    }

    public function getRequests()
    {
        $authUserId = Auth::id();
        return $this->friendRepository->getFriendRequests($authUserId);
    }

    public function listFriends()
    {
        $authUserId = Auth::id();
        return $this->friendRepository->getFriends($authUserId);
    }

    public function mutualFriends($friendId)
    {
        $authUserId = Auth::id();
        return $this->friendRepository->getMutualFriends($authUserId, $friendId);
    }
}
