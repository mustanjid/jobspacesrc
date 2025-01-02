<div>
    @props(['fixed' => false, 'activeRoute'])
    <x-layout :fixed="$fixed" :activeRoute="$activeRoute">
        <div class="space-y-4">

            <!-- Filters Section -->
            <div class="flex flex-col gap-4 sm:flex-row sm:gap-2 sm:justify-between items-center w-full">

                <!-- Search Input -->
                <div class="relative w-full sm:w-1/3 p-2">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20" aria-hidden="true">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search" wire:model.live.debounce.300ms="search"
                        class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="by title, employer, and location" />
                </div>

                <!-- Per Page Filter -->
                <div class="flex items-center space-x-2">
                    <label class="text-sm w-15 font-medium text-gray-900 dark:text-gray-300">Per Page</label>
                    <select wire:model.live="perPage"
                        class="block rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>

                <!-- Status Filter -->
                <div class="flex items-center space-x-2">
                    <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Status</label>
                    <select wire:model.live.debounce.300ms="isStatus"
                        class="block rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">All</option>
                        <option value="1">Featured</option>
                        <option value="0">Unfeatured</option>
                    </select>
                </div>

                <!-- Tags Filter -->
                <div class="flex items-center space-x-2">
                    <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Tags</label>
                    <select wire:model.live.debounce.300ms="isTag"
                        class="block rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">All</option>
                        @foreach (\App\Models\Tag::whereHas('jobs', function ($query) {
                        $query->where('status', 1) // Active jobs
                        ->whereHas('employer', function ($query) {
                        $query->where('status', 1); // Active employer
                        });
                        })->get() as $tags)
                        <option value="{{ $tags->id }}">{{ $tags->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Reset Filters Button -->
                <button type="button" wire:click="resetFields()"
                    class="focus:ring-primary-500 focus:border-primary-500 block rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-900 hover:bg-gray-400">
                    Reset Filters
                </button>
            </div>

            <!-- Job Listings Section -->
            <section class="px-4 py-6 sm:px-8 lg:px-16">
                @if ($jobs && $jobs->isNotEmpty())
                <div class="mt-6 space-y-6">
                    @foreach ($jobs as $job)
                    @if ($job->featured)
                    <x-job-card-wide-featured :$job />
                    @else
                    <x-job-card-wide :$job />
                    @endif
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $jobs->links() }}
                </div>
                
                @else
                <h4 class="text-center text-gray-500 dark:text-gray-400">Found no jobs!</h4>
                @endif
            </section>
        </div>
    </x-layout>
</div>