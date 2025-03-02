@props(['status' => session('status'), 'message' => session('message')])

@if (!is_null($message))
    <div 
        {{ $attributes->merge(['class' => 'fixed top-1 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 ease-in-out']) }}
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 5000)"
        :class="{ 
            'bg-green-100 text-green-800 border border-green-300': $status, 
            'bg-red-100 text-red-800 border border-red-300': !$status 
        }"
    >
        <div class="flex items-center justify-between">
            <span>
                @if ($status)
                    ✅ <strong>Success:</strong> {{ $message }}
                @else
                    ❌ <strong>Error:</strong> {{ $message }}
                @endif
            </span>
            <button 
                @click="show = false" 
                class="ml-4 text-lg font-bold focus:outline-none"
            >
                &times;
            </button>
        </div>
    </div>
@endif
