<nav x-data="{ open: false }" class="top-0 z-50 w-full bg-white border-b border-gray-200 shadow-sm">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Left Section -->
            <div class="flex items-center space-x-6">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <span class="text-2xl font-bold text-blue-600 hover:text-blue-700 transition-colors">Social</span>
                </a>

                <!-- Search Bar -->
                <div class="flex justify-center items-center">
                    <div class="relative">
                        <x-text-input id="search" 
                            class="w-96 lg:w-96 pl-4 pr-10 py-2 rounded-full bg-gray-100 border-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-200" 
                            type="text" 
                            name="search" 
                            autocomplete="off" 
                            placeholder="Search..." />
                            <button type="submit" class="absolute right-0 top-0 h-full p-2">
                                <i class="ri-search-line text-gray-500 absolute right-3 top-2"></i>
                            </button>
                    </div>
                </div>
            </div>

            <!-- Right Section -->
            <div class="flex items-center justify-center space-x-4">
                <!-- Desktop Navigation -->
                <div class="hidden sm:flex items-center space-x-6">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="hover:text-blue-600 transition-colors" title="Home">
                        <i class="ri-home-line text-xl"></i>
                    </x-nav-link>
                    <x-nav-link href="#" class="hover:text-blue-600 transition-colors" title="Messages">
                        <i class="ri-message-3-line text-xl"></i>
                    </x-nav-link>
                    <x-nav-link href="#" class="hover:text-blue-600 transition-colors" title="Notifications">
                        <i class="ri-notification-3-line text-xl"></i>
                    </x-nav-link>
                    <x-nav-link :href="route('friend.find')" :active="request()->routeIs('friend.find')" class="hover:text-blue-600 transition-colors" title="Find Friends">
                        <i class="ri-group-fill text-xl"></i>
                    </x-nav-link>

                    <!-- User Dropdown -->
                    <x-dropdown align="right" width="56">
                        <x-slot name="trigger">
                            <button class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 transition-colors duration-150 focus:outline-none">
                                <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                                <i class="ri-arrow-down-s-line text-gray-500"></i>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-2 border-b border-gray-200 bg-gray-50">
                                <span class="block text-sm text-gray-700">{{ Auth::user()->name }}</span>
                                <span class="block text-xs text-gray-500">{{ Auth::user()->email }}</span>
                            </div>
                            <x-dropdown-link :href="route('profile.edit')" class="hover:bg-gray-100">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" 
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="hover:bg-red-50 text-red-600">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Mobile Menu Button -->
                <div class="sm:hidden">
                    <button @click="open = !open" 
                            class="p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        <i class="ri-menu-line text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden border-t border-gray-200">
            <div class="px-4 pt-4 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    <i class="ri-home-line mr-2"></i> Home
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#">
                    <i class="ri-message-3-line mr-2"></i> Messages
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#">
                    <i class="ri-notification-3-line mr-2"></i> Notifications
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('friend.find')" :active="request()->routeIs('friend.find')">
                    <i class="ri-group-fill mr-2"></i> Friends
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('profile.edit')">
                    <i class="ri-user-line mr-2"></i> Profile
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-red-600 hover:bg-red-50">
                        <i class="ri-logout-box-line mr-2"></i> Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>