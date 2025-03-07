<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Suggested Friends') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-reponse-message />
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($suggestedFriends as $friend)
                            <div class="bg-white shadow-md rounded-lg p-4 flex flex-col items-center w-full max-w-xs">
                                <h3 class="text-lg font-semibold mt-2 text-center">{{ $friend->name }}</h3>
                                <form method="POST" action="{{ route('friend.send-request', $friend->id) }}" class="mt-3 w-full">
                                    @csrf
                                    <x-primary-button 
                                        type="submit" 
                                        class="bg-blue-500 text-white w-full px-4 py-2 rounded-md hover:bg-blue-600">
                                        {{ __('Send Request') }}
                                    </x-primary-button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                    
                    @if ($suggestedFriends->isEmpty())
                        <p class="text-center text-gray-500 mt-6">No suggested friends available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>