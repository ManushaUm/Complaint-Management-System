@auth
<div x-data="{ sidebarOpen: true }" class="relative">
    <!-- Toggle Button for Mobile -->
    <button @click="sidebarOpen = !sidebarOpen"
        class="fixed top-4 left-4 z-40 lg:hidden bg-gray-800 text-white p-2 rounded-md shadow-lg">
        <svg x-show="!sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Sidebar -->
    <div :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen, 'w-64': sidebarOpen, 'w-16': !sidebarOpen && $screen.lgAndUp}"
        class="fixed inset-y-0 left-0 z-30 bg-gray-800 overflow-y-auto transition-all duration-300 ease-in-out transform shadow-lg lg:translate-x-0">
        <div class="flex h-16 items-center justify-between border-b border-gray-700 px-4">
            <h2 class="text-xl font-bold text-white truncate" x-show="sidebarOpen">Complaint Manager</h2>
            <h2 class="text-xl font-bold text-white" x-show="!sidebarOpen">CM</h2>
            <!-- Desktop Toggle Button -->
            <button @click="sidebarOpen = !sidebarOpen" class="hidden lg:block text-gray-400 hover:text-white">
                <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                </svg>
                <svg x-show="!sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <div class="h-[calc(100%-4rem)] overflow-y-auto">
            @if(Session('role') == 'admin')
            <!-- Admin Menu -->
            <div class="py-4">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Menu</p>

                <div class="mt-2">
                    <!-- Dashboard -->
                    <a href="{{route('dashboard')}}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-blue-400" :class="{'mr-3': sidebarOpen}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span x-show="sidebarOpen">Dashboard</span>
                        <span x-show="sidebarOpen" class="ml-auto bg-blue-500 text-xs font-medium px-2 py-0.5 rounded-full text-white">04</span>
                    </a>

                    <!-- Complaints Dropdown -->
                    <div x-data="{ open: true }">
                        <button @click="open = !open" class="w-full flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-blue-400" :class="{'mr-3': sidebarOpen}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <span x-show="sidebarOpen">Complaints</span>
                            <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': open}" class="ml-auto h-4 w-4 transition-transform transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open && sidebarOpen" class="pl-12 pr-3 py-1 bg-gray-900 rounded-sm">
                            <a href="{{route('newcomplaint')}}" class="block py-2 text-sm text-gray-400 hover:text-white transition-colors">New Complaints</a>
                            <a href="{{route('viewcomplaint')}}" class="block py-2 text-sm text-gray-400 hover:text-white transition-colors">View Complaints</a>
                            <a href="{{route('closed-jobs')}}" class="block py-2 text-sm text-gray-400 hover:text-white transition-colors">Closed Complaints</a>
                        </div>
                    </div>

                    <!-- Search -->
                    <a href="{{route('search.complaints')}}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-blue-400" :class="{'mr-3': sidebarOpen}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span x-show="sidebarOpen">Search</span>
                        <span x-show="sidebarOpen" class="ml-auto bg-green-500 text-xs font-medium px-2 py-0.5 rounded-full text-white">New</span>
                    </a>

                    <!-- Internal Services Dropdown -->
                    <div x-data="{ open: false }">
                        <button @click="open = !open" class="w-full flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-blue-400" :class="{'mr-3': sidebarOpen}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <span x-show="sidebarOpen">Internal Services</span>
                            <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': open}" class="ml-auto h-4 w-4 transition-transform transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open && sidebarOpen" class="pl-12 pr-3 py-1 bg-gray-900 rounded-sm">
                            <a href="{{route('departments')}}" class="block py-2 text-sm text-gray-400 hover:text-white transition-colors">Departments Management</a>
                            <a href="{{route('users')}}" class="block py-2 text-sm text-gray-400 hover:text-white transition-colors">User Management</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if(Session('role') == 'head' || Session('role') == 'd-head')
            <!-- Department Head Menu -->
            <div class="py-4">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Menu</p>

                <div class="mt-2">
                    <!-- Dashboard -->
                    <a href="{{route('dashboard')}}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-400 group-hover:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Dashboard</span>
                        <span class="ml-auto bg-blue-500 text-xs font-medium px-2 py-0.5 rounded-full text-white">04</span>
                    </a>

                    <!-- Complaints Dropdown -->
                    <div x-data="{ open: true }">
                        <button @click="open = !open" class="w-full flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-400 group-hover:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <span>Complaints</span>
                            <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': open}" class="ml-auto h-4 w-4 transition-transform transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" class="pl-12 pr-3 py-1 bg-gray-900 rounded-sm">
                            <a href="{{route('viewcomplaint')}}" class="block py-2 text-sm text-gray-400 hover:text-white transition-colors">View Complaints</a>
                            <a href="{{route('my-jobs')}}" class="block py-2 text-sm text-gray-400 hover:text-white transition-colors">My Jobs</a>
                            <a href="{{route('closed-jobs')}}" class="block py-2 text-sm text-gray-400 hover:text-white transition-colors">Closed Jobs</a>
                        </div>
                    </div>

                    <!-- Search -->
                    <a href="{{route('search.complaints')}}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-400 group-hover:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span>Search</span>
                        <span class="ml-auto bg-green-500 text-xs font-medium px-2 py-0.5 rounded-full text-white">New</span>
                    </a>
                </div>
            </div>
            @endif

            @if(Session('role') == 'member')
            <!-- Members Menu -->
            <div class="py-4">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Menu</p>

                <div class="mt-2">
                    <!-- Dashboard -->
                    <a href="{{route('dashboard')}}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-400 group-hover:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Dashboard</span>
                        <span class="ml-auto bg-blue-500 text-xs font-medium px-2 py-0.5 rounded-full text-white">04</span>
                    </a>

                    <!-- Complaints Dropdown -->
                    <div x-data="{ open: true }">
                        <button @click="open = !open" class="w-full flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-400 group-hover:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <span>Complaints</span>
                            <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': open}" class="ml-auto h-4 w-4 transition-transform transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" class="pl-12 pr-3 py-1 bg-gray-900 rounded-sm">
                            <a href="{{route('viewcomplaint')}}" class="block py-2 text-sm text-gray-400 hover:text-white transition-colors">View Complaints</a>
                            <a href="{{route('my-jobs')}}" class="block py-2 text-sm text-gray-400 hover:text-white transition-colors">My Jobs</a>
                            <a href="{{route('completedJobs')}}" class="block py-2 text-sm text-gray-400 hover:text-white transition-colors">Completed Jobs</a>
                        </div>
                    </div>

                    <!-- Search -->
                    <a href="{{route('search.complaints')}}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-400 group-hover:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span>Search</span>
                        <span class="ml-auto bg-green-500 text-xs font-medium px-2 py-0.5 rounded-full text-white">New</span>
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Alpine.js (required for dropdowns) -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Main Content Area -->
    <div :class="{'lg:ml-64': sidebarOpen, 'lg:ml-16': !sidebarOpen}"
        class="transition-all duration-300 ease-in-out">
        <!-- Your main content goes here -->
        <div class="p-4">
            @yield('content')
        </div>
    </div>
    @endauth