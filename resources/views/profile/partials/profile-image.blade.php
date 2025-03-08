<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Image') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile image.") }}
        </p>
    </header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="flex items-center justify-center">
                        <div class="w-24 h-24 overflow-hidden">
                            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover object-center" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="#" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mt-6">
            <div class="flex items-center justify-center gap-4">
                <input type="file" name="profile_image" id="profile_image" class="hidden" />
                <label for="profile_image" class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-900 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span>{{ __('Upload Image') }}</span>
                </label>
                <x-primary-button>{{ __('Save') }}</x-primary-button>
            </div>
        </div>
    </form>
</section>