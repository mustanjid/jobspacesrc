@props(['fixed' => true])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,500;1,500&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,600;1,600&display=swap"
        rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>Job Space | Admin</title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <nav class="fixed top-0 z-50 w-full border-b border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center rounded-lg p-2 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 sm:hidden">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="h-6 w-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a href="/admin/dashboard" class="ms-2 flex md:me-24">
                        <span
                            class="self-center whitespace-nowrap text-xl font-semibold dark:text-white sm:text-2xl">Job
                            Space</span>
                    </a>
                </div>

                <div class="flex items-center">
                    <div class="ms-3 flex items-center">
                        <!-- Notification Button -->
                        <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification"
                            aria-expanded="false"
                            class="relative inline-flex items-center text-center text-sm font-medium text-gray-500 hover:text-gray-900 focus:outline-none dark:text-gray-400 dark:hover:text-white"
                            type="button">
                            <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 14 20">
                                <path
                                    d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z" />
                            </svg>
                            <!-- Notification Badge -->
                            <div id="notificationBadge"
                                class="absolute -top-0.5 start-2.5 hidden h-3 w-3 rounded-full border-2 border-white bg-red-500 dark:border-gray-900">
                            </div>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdownNotification"
                            class="z-20 hidden w-full max-w-sm divide-y divide-gray-100 rounded-lg bg-white shadow dark:divide-gray-700 dark:bg-gray-800"
                            aria-labelledby="dropdownNotificationButton">
                            <div
                                class="block rounded-t-lg bg-gray-50 px-4 py-2 text-center font-medium text-gray-700 dark:bg-gray-800 dark:text-white">
                                Notifications
                            </div>
                            <div id="notificationList" aria-live="polite"
                                class="max-h-96 divide-y divide-gray-100 overflow-y-auto dark:divide-gray-700">
                                <!-- Notifications will be dynamically appended here -->
                            </div>
                        </div>

                    </div>

                    <div class="ms-3 flex items-center">
                        <div>
                            <button type="button"
                                class="flex rounded-full bg-gray-800 text-sm focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full"
                                    src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                    alt="user photo">
                            </button>
                        </div>

                        <div class="z-50 my-4 hidden list-none divide-y divide-gray-100 rounded bg-white text-base shadow dark:divide-gray-600 dark:bg-gray-700"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="truncate text-sm font-medium text-gray-900 dark:text-gray-300" role="none">
                                    {{ Auth::user()->email }}
                                </p>
                                <p class="truncate text-sm font-medium text-gray-900 dark:text-gray-300" role="none">
                                    {{ $userPosition = \App\Models\Position::find(Auth::user()->position_id)->name }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <form method="POST" action="/logout">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Log
                                            Out</button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar"
        class="fixed left-0 top-0 z-40 h-screen w-64 -translate-x-full border-r border-gray-200 bg-white pt-20 transition-transform dark:border-gray-700 dark:bg-gray-800 sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full overflow-y-auto bg-white px-3 pb-4 dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <x-panel-nav-links href="/admin/dashboard">
                    <svg class="h-5 w-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </x-panel-nav-links>

                @php
                    $permissionUser = App\Models\PositionPermission::getPermission('user', Auth::user()->position_id);
                    $permissionEmployer = App\Models\PositionPermission::getPermission(
                        'employer',
                        Auth::user()->position_id,
                    );
                    $permissionJob = App\Models\PositionPermission::getPermission('job', Auth::user()->position_id);
                    $permissionRole = App\Models\PositionPermission::getPermission('role', Auth::user()->position_id);
                @endphp

                @if (!empty($permissionUser))
                    <li>
                        <a href="/admin/users"
                            class="group flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                            <svg class="h-5 w-5 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 18">
                                <path
                                    d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                            </svg>
                            <span class="ms-3 flex-1 whitespace-nowrap">Users</span>
                        </a>
                    </li>
                @endif

                @if (!empty($permissionEmployer))
                    <li>
                        <a href="/admin/employers"
                            class="group flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                            <svg class="h-5 w-5 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 18">
                                <path
                                    d="M4 3v18h16V3H4zm14 16H6V5h12v14zm-6-2h-2v-4h2v4zm0-6h-2v-4h2v4zm4 6h-2v-4h2v4zm0-6h-2v-4h2v4z" />
                            </svg>
                            <span class="ms-3 flex-1 whitespace-nowrap">Employers</span>
                        </a>
                    </li>
                @endif

                @if (!empty($permissionJob))
                    <li>
                        <a href="{{ url('admin/jobs') }}"
                            class="group flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                            <svg class="h-5 w-5 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 18 18">
                                <path d="M3 3h18v12H3zM5 5v8h14V5H5zm2 10v2h10v-2H7zm0 4v2h10v-2H7z" />
                            </svg>
                            <span class="ms-3 flex-1 whitespace-nowrap">Jobs</span>
                        </a>
                    </li>
                @endif

                @if (!empty($permissionRole))
                    <li>
                        <button type="button"
                            class="group flex w-full items-center rounded-lg p-2 text-base text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <svg class="h-5 w-5 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 18 21">
                                <path
                                    d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                            </svg>
                            <span class="ms-3 flex-1 whitespace-nowrap text-left rtl:text-right">Role</span>
                            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-example" class="hidden space-y-2 py-2">
                            <li>
                                <a href="/admin/roles"
                                    class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">View
                                    Role</a>
                            </li>
                            <li>
                                <a href="/admin/roles/add"
                                    class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Add
                                    Role</a>
                            </li>
                        </ul>
                    </li>
                @endif

                <li>
                    <a href="/"
                        class="group flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        <svg class="h-5 w-5 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 18 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                        </svg>
                        <span class="ms-3 flex-1 whitespace-nowrap">Home</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        <div class="mt-14 rounded-lg p-2">
            {{ $slot }}
        </div>
    </div>
    <x-footer :fixed="$fixed" />

    <script type="module">
        document.addEventListener("DOMContentLoaded", function() {
            const NOTIFICATION_KEY = "notifications";
            const MAX_DISPLAY_COUNT = 10;
            const DISPLAY_DURATION = 2 * 60 * 1000; // 2 minutes in milliseconds

            // Save a notification to localStorage
            function saveNotificationToStorage(notification) {
                const notifications = JSON.parse(localStorage.getItem(NOTIFICATION_KEY)) || [];
                notifications.push(notification);
                localStorage.setItem(NOTIFICATION_KEY, JSON.stringify(notifications));
            }

            // Fetch valid (unexpired) notifications from localStorage
            function getValidNotifications() {
                const now = Date.now();
                const notifications = JSON.parse(localStorage.getItem(NOTIFICATION_KEY)) || [];
                return notifications.filter((n) => now - n.timestamp < DISPLAY_DURATION);
            }

            function renderNotifications() {
                const notificationBadge = document.getElementById("notificationBadge");
                const notificationList = document.getElementById("notificationList");
                if (notificationList) {
                    notificationList.innerHTML = "";
                }
                const validNotifications = getValidNotifications();

                // Render each notification 
                validNotifications.slice(0, MAX_DISPLAY_COUNT).forEach((notification) => {
                    const newNotification = document.createElement("a");
                    newNotification.href = "#";
                    newNotification.className = "flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700";
                    newNotification.innerHTML = `
        <div class="w-full ps-3">
            <div class="mb-1.5 text-sm text-gray-500 dark:text-gray-400">
                New Job Posted: <span class="font-semibold text-gray-900 dark:text-white">
                    ${notification.title}
                </span>
            </div>
        </div>
        `;
                    // Add the notification to the top of the list
                    notificationList.prepend(newNotification);
                });

                // Update the badge visibility based on notification count
                if (notificationBadge) {
                    if (validNotifications.length > 0) {
                        notificationBadge.classList.remove("hidden");
                    } else {
                        notificationBadge.classList.add("hidden");
                    }
                }
            }

            // Initialize Echo and listen for notifications
            function initializeNotificationListener() {
                if (window.Echo) {
                    window.Echo.channel("notification").listen(".test.notification", (event) => {
                        console.log("Event received:", event);

                        const newNotification = {
                            title: event.title,
                            timestamp: Date.now(),
                        };

                        // Save the notification to localStorage
                        saveNotificationToStorage(newNotification);

                        // Re-render notifications
                        renderNotifications();
                    });
                } else {
                    console.error("Echo instance not initialized.");
                }
            }

            // Initialize notifications on page load
            renderNotifications();
            initializeNotificationListener();
        });
    </script>
    @livewireScripts
</body>

</html>
