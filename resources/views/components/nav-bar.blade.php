@props(['activeRoute' => null])

<nav class="fixed start-0 top-0 z-20 w-full border-b border-gray-200 bg-white dark:border-gray-600 dark:bg-gray-900">
    <div class="mx-auto flex max-w-screen-xl flex-wrap items-center justify-between p-4">
        <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center whitespace-nowrap text-2xl font-semibold dark:text-white">Job Space</span>
        </a>
        <div class="flex space-x-3 rtl:space-x-reverse md:order-2 md:space-x-0">
            @guest
                @if (Route::is('loginForm'))
                    <x-nav-button href="{{ url('/register') }}">Sign Up</x-nav-button>
                @elseif (Route::is('signupForm'))
                    <x-nav-button href="{{ url('/login') }}">Log in</x-nav-button>
                @else
                    <x-nav-button href="{{ url('/login') }}">Log in</x-nav-button>
                @endif
            @endguest

            @auth
                <div class="mx-auto flex justify-between gap-4">
                    @if (Auth::user()->position_id)
                        <x-nav-button href="{{ url('/admin/dashboard') }}">View Dashboard</x-nav-button>
                    @else
                        @if (Auth::user()->status && Auth::user()->employer)
                            <x-nav-button href="{{ url('/jobs/create ') }}">Post a Job</x-nav-button>
                        @endif
                        <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar"
                            class="flex rounded-full bg-gray-800 text-sm focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 md:me-0"
                            type="button">
                            <span class="sr-only">Open user menu</span>
                            @if (Storage::url(Auth::user()->employer->logo) != '')
                                <img class="h-8 w-8 rounded-full" src="{{ Storage::url(Auth::user()->employer->logo) }}"
                                    alt="user photo">
                            @else
                                <img class="h-8 w-8 rounded-full" src="https://picsum.photos" alt="user photo">
                            @endif
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdownAvatar"
                            class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:divide-gray-600 dark:bg-gray-700">
                            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="truncate font-medium">{{ Auth::user()->email }}</div>
                                <div class="truncate font-medium">{{ Auth::user()->employer->name }}</div>
                            </div>
                            @if (Auth::user()->status && Auth::user()->employer)
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownUserAvatarButton">
                                    <li>
                                        <a href="{{ url('/jobs/create ') }}"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Post
                                            a Job</a>
                                        <a href="{{ url('/emp-job-view') }}"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">View
                                            Jobs</a>
                                        <a href="/employers/{{ Auth::user()->employer->id }}"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Update
                                            Info</a>
                                        <a href="/update-password"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Update
                                            Password</a>
                                    </li>
                                </ul>
                            @else
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownUserAvatarButton">
                                    <li>
                                        <p class="p-1 text-red-500">Account not activated yet</p>
                                    </li>
                                </ul>
                            @endif

                            <div class="py-2">
                                <form method="POST" action="/logout">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Log
                                        Out</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            @endauth

            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-lg p-2 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 md:hidden"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>

        <div class="hidden w-full items-center justify-between md:order-1 md:flex md:w-auto" id="navbar-sticky">
            <ul
                class="mt-4 flex flex-col rounded-lg border border-gray-100 bg-gray-50 p-4 font-medium rtl:space-x-reverse dark:border-gray-700 dark:bg-gray-800 md:mt-0 md:flex-row md:space-x-8 md:border-0 md:bg-white md:p-0 md:dark:bg-gray-900">
                <x-nav-links href="/" :active="$activeRoute == 'home'">Home</x-nav-links>
                <x-nav-links href="/all-jobs" :active="$activeRoute === 'all-jobs'">All Jobs</x-nav-links>
            </ul>
        </div>

    </div>
</nav>
