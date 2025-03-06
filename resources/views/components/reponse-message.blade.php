@props(['status' => session('status'), 'message' => session('message')])

@if (!is_null($message))
    <div 
        {{ $attributes->merge([
            'class' => 'fixed top-16 right-4 z-50 max-w-sm w-full p-4 rounded-lg shadow-lg transition-all duration-300 ease-in-out'
        ]) }}
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 5000)"
        role="alert"
    >
        <div class="flex items-center gap-3">
            <span class="flex items-center gap-2">
                @if ($status)
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <strong class="font-semibold bg-green-50 text-green-800 border border-green-200">{{ $message }}</strong>
                @else
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <strong class="font-semibold bg-red-50 text-red-800 border border-red-200">{{ $message }}</strong> 
                @endif
            </span>
            <button 
                @click="show = false" 
                class="ml-auto text-xl font-medium text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 rounded-full"
                aria-label="Close notification"
            >
                &times;
            </button>
        </div>
    </div>
@endif