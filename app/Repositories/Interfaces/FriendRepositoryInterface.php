<?php

namespace App\Repositories\Interfaces;

interface FriendRepositoryInterface {
    public function sendFriendRequest($userId, $friendId);
    public function acceptFriendRequest($userId, $friendId);
    public function rejectFriendRequest($userId, $friendId);
    public function unfriend($userId, $friendId);
    public function getFriendRequests($userId, $friendId = null);
    public function getFriends($userId);
    public function getMutualFriends($userId, $friendId);
}