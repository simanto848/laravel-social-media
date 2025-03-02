<?php

namespace App\Http\Controllers;

use App\Services\FriendService;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    protected $friendService;

    public function __construct(FriendService $friendService)
    {
        $this->friendService = $friendService;
    }

    public function sendRequest($friendId)
    {
        $response = $this->friendService->sendRequest($friendId);
        return response()->json($response, $response['status'] ? 201 : 400);
    }

    public function acceptRequest($friendId)
    {
        $this->friendService->acceptRequest($friendId);
        return response()->json(['message' => 'Friend request accepted']);
    }

    public function rejectRequest($friendId)
    {
        $this->friendService->rejectRequest($friendId);
        return response()->json(['message' => 'Friend request rejected']);
    }

    public function removeFriend($friendId)
    {
        $this->friendService->removeFriend($friendId);
        return response()->json(['message' => 'Friend removed successfully']);
    }

    public function getRequests()
    {
        return response()->json(['requests' => $this->friendService->getRequests()]);
    }

    public function listFriends()
    {
        return response()->json(['friends' => $this->friendService->listFriends()]);
    }

    public function mutualFriends($friendId)
    {
        return response()->json(['mutual_friends' => $this->friendService->mutualFriends($friendId)]);
    }

    public function findFriends(Request $request) {
        $page = $request->page ?? 1;
        $limit = $request->limit ?? 10;
        // return response()->json(['friends' => $this->friendService->findFriends($page, $limit)]);
        return view('friends.find', ['suggestedFriends' => $this->friendService->findFriends($page, $limit)]);
    }

    public function searchFriends(Request $request) {
        $page = $request->page ?? 1;
        $limit = $request->limit ?? 10;
        $search = $request->search;
        return response()->json(['friends' => $this->friendService->searchFriends($search, $page, $limit)]);
    }

    // public function index() {
    //     $suggestedFriends = $this->friendService->findFriends(1, 10);
    //     return view('friends.index', compact('suggestedFriends'));
    // }
}
