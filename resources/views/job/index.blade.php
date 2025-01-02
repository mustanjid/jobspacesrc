<x-layout>

    <div class="space-y-2">
        {{-- <section class="pt-6 text-center">
            <h1 class="text-4xl font-bold">Let's find your next job</h1>

            <x-forms.form action="/search" class="mt-6">
                <x-forms.input :label="false" name="q" placeholder="Web Developer..." />
            </x-forms.form>

        </section> --}}
        <section class="bg-white dark:bg-gray-900">
            <div class="mx-auto max-w-screen-xl px-4 py-4 text-center lg:py-2">
                <h4
                    class="mb-4 text-lg font-bold leading-none tracking-tight text-gray-900 dark:text-white md:text-5xl lg:text-3xl">
                    Welcome to Job Space</h4>
                <p class="mb-8 text-lg font-normal text-gray-500 dark:text-gray-400 sm:px-16 lg:px-48 lg:text-xl">Where
                    Your Next Opportunity Awaits. Connect, apply, and elevate your career</p>
                <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                    <a href="/all-jobs"
                        class="inline-flex items-center justify-center rounded-lg bg-blue-700 px-5 py-3 text-center text-base font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                        View all jobs
                        <svg class="ms-2 h-3.5 w-3.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <section class="px-4 pt-8 sm:px-8 lg:px-16">
            @if ($featuredJobs && $featuredJobs->isNotEmpty())
                <x-section-heading>Featured Jobs</x-section-heading>
                {{-- 3 job cards --}}
                <div class="mt-6 grid gap-8 lg:grid-cols-3">
                    @foreach ($featuredJobs as $job)
                        <x-job-card :$job />
                    @endforeach
                </div>
            @else
                <h2 class="text-xl">No featured jobs! Please register and upload jobs</h2>
            @endif
        </section>

        @if (($featuredJobs && $featuredJobs->isNotEmpty()) || ($jobs && $jobs->isNotEmpty()))
            <section class="px-4 py-6 sm:px-8 lg:px-16">
                <x-section-heading>Tags</x-section-heading>
                <div class="mt-4 flex flex-wrap justify-center gap-2">
                    @foreach ($tags as $tag)
                        <x-tag :$tag />
                    @endforeach
                </div>
            </section>
        @endif

        <section class="px-4 py-6 sm:px-8 lg:px-16">
            @if ($jobs && $jobs->isNotEmpty())
                <x-section-heading>Recent Jobs</x-section-heading>
                <div class="mt-6 space-y-6">
                    @foreach ($jobs as $job)
                        <x-job-card-wide :$job />
                    @endforeach
                </div>
            @else
                <h4>No active jobs! Please register and upload jobs</h4>
            @endif
        </section>
    </div>

    </div>
</x-layout>
