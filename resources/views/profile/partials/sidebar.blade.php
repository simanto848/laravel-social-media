<aside id="default-sidebar" class="fixed top-16 left-0 z-40 w-64 h-[calc(100vh-4rem)] transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-4 py-4 overflow-y-auto bg-white shadow-lg dark:bg-white dark:shadow border-r border-gray-700 dark:border-gray-700">
        <!-- Sidebar Menu -->
        <ul class="space-y-1 font-medium">
            <li>
                <a href="{{ route('profile.edit') }}" class="flex items-center p-2 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-blue-500 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-blue-500 transition-colors duration-150 group">
                    <i class="ri-user-line w-5 h-5 text-gray-400 group-hover:text-blue-500 dark:group-hover:text-blue-500 transition-colors duration-150"></i>
                    <span class="ms-3">Profile</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-blue-500 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-blue-500 transition-colors duration-150 group">
                    <i class="ri-message-3-line w-5 h-5 text-gray-400 group-hover:text-blue-500 dark:group-hover:text-blue-500 transition-colors duration-150"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Inbox</span>
                    <span class="inline-flex items-center justify-center w-5 h-5 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>
                </a>
            </li>
            <li>
                <a href="{{ route('friend.find') }}" class="flex items-center p-2 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-blue-500 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-blue-500 transition-colors duration-150 group">
                    <i class="ri-group-fill w-5 h-5 text-gray-400 group-hover:text-blue-500 dark:group-hover:text-blue-500 transition-colors duration-150"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Friends</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-blue-500 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-blue-500 transition-colors duration-150 group">
                    <i class="ri-image-line w-5 h-5 text-gray-400 group-hover:text-blue-500 dark:group-hover:text-blue-500 transition-colors duration-150"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Pictures</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); this.closest('form').submit();" 
                       class="flex items-center p-2 text-red-500 rounded-lg hover:bg-red-900 hover:text-red-400 dark:text-red-500 dark:hover:bg-red-900 dark:hover:text-red-400 transition-colors duration-150 group">
                        <i class="ri-logout-box-line w-5 h-5 text-red-500 group-hover:text-red-400 dark:group-hover:text-red-400 transition-colors duration-150"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
                    </a>
                </form>
            </li>
        </ul>
    </div>
</aside>