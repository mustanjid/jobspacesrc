<x-dashboard-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-2xl px-4 py-2 lg:py-2">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new role</h2>
            <form action="/admin/roles/add" method="POST">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="name"
                            class="focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                            placeholder="Type role name" required="">
                    </div>
                </div>

                <label class="mb-2 mt-6 block text-sm font-medium text-gray-900 dark:text-white">Click below for
                    assigning
                    tasks </label>
                {{-- user role --}}
                <div class="mt-6">
                    @foreach ($getPermission as $value)
                        <ul
                            class="w-full items-center rounded-lg border border-gray-200 bg-white text-sm font-medium text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:flex">

                            @foreach ($value['group'] as $group)
                                <li
                                    class="w-full border-b border-gray-200 dark:border-gray-600 sm:border-b-0 sm:border-r">
                                    <div class="flex items-center ps-3">
                                        <input id="{{ $group['name'] }}" type="checkbox" value="{{ $group['id'] }}"
                                            name="permission_id[]"
                                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:ring-offset-gray-700 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-700">
                                        <label for="{{ $group['name'] }}"
                                            class="ms-2 w-full py-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $group['name'] }}</label>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    @endforeach
                </div>
                <button type="submit"
                    class="mb-2 me-2 mt-6 rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                    role</button>
                <a class="mb-2 me-2 mt-6 rounded-lg bg-amber-300 px-5 py-2.5 text-sm font-medium text-black hover:bg-cyan-800"
                    href="/admin/roles">View Role</a>
            </form>
        </div>
    </section>
</x-dashboard-layout>
