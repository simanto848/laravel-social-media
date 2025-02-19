@props(['friendId'])

<form action="{{ route('friends.sendRequest', $friendId) }}" method="POST" class="inline">
    @csrf
    <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-300">Add Friend</button>
</form>