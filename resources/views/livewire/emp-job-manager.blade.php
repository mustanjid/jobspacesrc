<div>
    <x-layout>
       
        <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg mb-8">
            @if (session('success'))
            <div id="successMessage" class="flex items-center bg-blue-500 px-4 py-3 text-sm font-bold text-white" role="alert">
                <svg class="mr-2 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path
                        d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                </svg>
                <p>{{ session('success') }}</p>
            </div>
            @endif

            @if (session('failure'))
                <div id="alert-2"
                    class="mb-4 flex items-center rounded-lg bg-red-50 p-4 text-red-800 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <svg class="h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('failure') }}
                    </div>


                </div>
            @endif

            <h6 class="px-2 py-2 text-lg font-bold dark:text-white">Jobs of {{ Auth::user()->employer->name }}</h6>
            <div class="d flex items-center justify-between p-4">
                <div class="flex w-2/3 justify-between">
                    <div class="relative w-full">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg aria-hidden="true" class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" wire:model.live.debounce.300ms="search"
                            class="focus:ring-primary-500 focus:border-primary-500 block w-1/2 rounded-lg border border-gray-300 bg-gray-50 p-2 pl-10 text-sm text-gray-900"
                            placeholder="Search by title, salary, location" required="">
                    </div>
                    <button type="button" wire:click="resetFields()"
                        class="focus:ring-primary-500 focus:border-primary-500 block w-1/5 rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-900 hover:bg-gray-400">Reset
                        Filters</button>
                </div>

                <div class="flex space-x-3">
                    <div class="flex items-center space-x-3">
                        <label class="w-40 text-sm font-medium text-gray-900">Status Type :</label>
                        <select wire:model.live.debounce.300ms="isActive"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                            <option value="">All</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                        <tr>
                            @include('livewire.includes.table-sortable-th', [
                                'displayName' => 'Title',
                                'name' => 'title',
                            ])
                            @include('livewire.includes.table-sortable-th', [
                                'displayName' => 'Salary',
                                'name' => 'salary',
                            ])
                            @include('livewire.includes.table-sortable-th', [
                                'displayName' => 'Location',
                                'name' => 'location',
                            ])
                            <th scope="col" class="px-4 py-3">Tags</th>
                            <th scope="col" class="px-4 py-3">URL</th>
                            <th scope="col" class="px-4 py-3">Schedule</th>
                            <th scope="col" class="px-4 py-3">Featured</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                            <th scope="col" class="px-4 py-3">Actions</th>
                            <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empjobs as $empjob)
                            <tr wire:key={{ $empjob->id }} class="border-b dark:border-gray-700">
                                <th scope="row"
                                    class="text-wrap px-2 py-2 font-medium text-gray-900 dark:text-white">
                                    {{ $empjob->title }}</th>
                                <td class="px-2 py-2"> {{ $empjob->salary }}</td>
                                <td class="px-2 py-2"> {{ $empjob->location }}</td>
                                <td class="px-4 py-3">
                                    @foreach ($empjob->tags as $tag)
                                        <span
                                            class="rounded bg-blue-100 px-2 py-1 text-xs text-blue-700">{{ $tag->name }}</span>
                                    @endforeach
                                </td>
                                <td class="px-2 py-1"> {{ $empjob->url }}</td>
                                <td class="px-2 py-2"> {{ $empjob->schedule }}</td>
                                @if ($empjob->featured)
                                    <td class="px-4 py-3 text-green-500">Featured</td>
                                @else
                                    <td class="px-2 py-2 text-red-500">Unfeatured</td>
                                @endif
                                @if ($empjob->status)
                                    <td class="px-2 py-2 text-green-500">Active</td>
                                @else
                                    <td class="px-2 py-2 text-red-500">Inactive</td>
                                @endif
                                <td class="px-2 py-2">
                                    <button wire:click="edit({{ $empjob->id }})"
                                        class="rounded text-sm font-semibold text-teal-500 hover:text-teal-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="h-5 w-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>
                                    <button wire:click="openDeleteModal({{ $empjob->id }})"
                                        class="mr-1 rounded text-sm font-semibold text-red-500 hover:text-teal-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="h-5 w-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

            <div class="flex justify-between px-3 py-4">
                <div class="flex">
                    <div class="mb-3 flex items-center space-x-4">
                        <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                        <select wire:model.live='perPage'
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
                {{ $empjobs->links() }}
            </div>
        </div>
        
        @if($isOpen)
         <div
            class="min-w-screen animated fadeIn faster fixed inset-0 left-0 top-0 z-50 flex h-screen items-center justify-center bg-cover bg-center bg-no-repeat outline-none focus:outline-none">
            <div class="absolute inset-0 z-0 bg-black opacity-80"></div>
            <div class="relative mx-auto my-auto w-full max-w-3xl rounded-xl bg-white p-4 shadow-lg">
                <!--content-->
                <p class="text-lg font-semibold">Edit Job Form</p>
                <div>
                    <!--body-->
                    <div class="flex-auto justify-center p-4 text-center">
                        <form method="POST" action="" wire:submit.prevent="update">
                            @csrf
                            <div class="mb-4 grid gap-4 md:grid-cols-2">
                                <div>
                                    <label for="title"
                                        class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                    <input type="text" wire:model="jobEditTitle" id="title"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="Web Developer" />
                                    @error('jobEditTitle') <span class="mt-1 text-xs font-medium text-red-600">{{ $message
                                        }}</span> @enderror
                                </div>
        
                                <div>
                                    <label for="salary"
                                        class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">Salary</label>
                                    <input type="text" id="salary" wire:model="jobEditSalary"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="40,000 - 50,000 Tk" required />
                                    @error('jobEditSalary') <span class="mt-1 text-xs font-medium text-red-600">{{ $message
                                        }}</span> @enderror
                                </div>
        
                                <div>
                                    <label for="location"
                                        class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">Location</label>
                                    <input type="text" id="location" wire:model="jobEditLocation"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="Dhaka, Bangladesh" required />
                                    @error('jobEditLocation') <span class="mt-1 text-xs font-medium text-red-600">{{ $message
                                        }}</span> @enderror
                                </div>
        
                                <div>
                                    <label for="url"
                                        class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">Url</label>
                                    <input type="text" id="url" wire:model="jobEditUrl"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="http://padberg.com/" required />
                                    @error('jobEditUrl') <span class="mt-1 text-xs font-medium text-red-600">{{ $message
                                        }}</span> @enderror
                                </div>
        
                                <div>
                                    <label for="schedule"
                                        class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">Select
                                        Schedule</label>
                                    <select id="schedule" wire:model="jobEditSchedule"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                                        <option {!! $jobEditSchedule=='Full Time' ? 'selected' : '' !!} value="Full Time">Full
                                            Time</option>
                                        <option {!! $jobEditSchedule=='Part Time' ? 'selected' : '' !!} value="Part Time">Part
                                            Time</option>
                                    </select>
                                    @error('jobEditSchedule') <span class="mt-1 text-xs font-medium text-red-600">{{ $message
                                        }}</span> @enderror
                                </div>
                            </div>
        
                            <div class="mb-3">
                                <label class="block text-xs font-medium text-gray-700">Add a tag and press enter button or click
                                    on add tag button (up to 6 tags)</label>

                                <!-- Selected Tags -->
                                <div class="mt-1 flex flex-wrap gap-2">
                                    <p class="text-xs font-bold text-blue-500">Selected Tags: </p>
                                    @foreach ($selectedTags as $tag)
                                    <span
                                        class="flex items-center gap-1 rounded-full bg-blue-200 px-2 py-1 text-xs text-blue-800">
                                        {{ $tag['name'] }}
                                        <button type="button" wire:click="removeTag({{ $tag['id'] }})"
                                            class="text-red-500">&times;</button>
                                    </span>
                                    @endforeach
                                </div>
        
                                <!-- Tag Input -->
                                <div class="mt-1 space-y-1">
                                    <input type="text" id="tags" wire:model="tagInput" wire:keydown.enter.prevent="addTag()"
                                        class="block w-full rounded-sm border border-gray-300 bg-gray-50 p-1 text-xs text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="Management, Marketing" />
                                    <button type="button" wire:click="addTag"
                                        class="rounded-lg bg-blue-700 px-2 py-1 text-xs font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">Add
                                        Tag</button>
                                    @error('tagInput') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                    @error('tag_limit') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                    @error('duplicate_tag') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <!-- Suggested Tags -->
                                <div class="mt-2 flex flex-wrap gap-2">
                                    <p class="text-sm font-bold">Suggested Tags: </p>
                                    @foreach ($suggestedTags as $tag)
                                    <button type="button" wire:click="selectSuggestedTag({{ $tag['id'] }})"
                                        class="rounded-full bg-gray-200 px-2 py-1 text-xs text-gray-800">
                                        {{ $tag['name'] }}
                                    </button>
                                    @endforeach
                                </div>
                            </div>
        
                            <button type="submit"
                                class="w-full rounded-lg bg-blue-700 px-4 py-2 text-center text-xs font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 sm:w-auto">Update</button>
                        </form>
                    </div>
                    <!--footer-->
                    <div class="mt-1 flex justify-between p-2">
                        <p class="text-xs">Job - {{ $jobEditTitle }}</p>
                        <button wire:click="closeModal()"
                            class="mb-1 rounded-full border border-yellow-400 bg-yellow-400 px-4 py-1.5 text-xs font-medium tracking-wider text-white shadow-sm hover:bg-yellow-500 hover:shadow-lg md:mb-0">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
            
        @if($isDeleteModalOpen)
            <div
                class="min-w-screen animated fadeIn faster fixed inset-0 left-0 top-0 z-50 flex h-screen items-center justify-center bg-cover bg-center bg-no-repeat outline-none focus:outline-none">
                <div class="absolute inset-0 z-0 bg-black opacity-80"></div>
                <div class="relative max-h-full w-full max-w-md p-4">
                    <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                        <button type="button" wire:click="closeDeleteModal"
                            class="absolute end-2.5 top-3 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="popup-modal">
                            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 text-center md:p-5">
                            <svg class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want
                                to
                                delete this job?</h3>
                            <button wire:click="delete" type="button"
                                class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:focus:ring-red-800">
                                Yes, I'm sure
                            </button>
                            <button wire:click="closeDeleteModal" type="button"
                                class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">No,
                                cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </x-layout>
</div>
