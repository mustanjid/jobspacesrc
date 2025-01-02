@props(['job'])

<div
    class="group flex flex-col gap-y-4 rounded-xl border border-transparent bg-neutral-100 p-4 transition-colors duration-300 hover:border-blue-800 sm:flex-row sm:gap-x-6">

    <div class="flex flex-shrink-0 justify-center sm:block">
        <x-employer-logo :employer="$job->employer" class="h-16 w-16 sm:h-20 sm:w-20" />
    </div>

    <div class="flex flex-1 flex-col text-center sm:text-left">
        <a class="self-center text-sm text-gray-700 sm:self-start">{{ $job->employer->name }}</a>
        <h3 class="mt-2 text-lg font-bold transition-colors duration-300 group-hover:text-blue-800 sm:text-xl">
            <a href="{{ url($job->url) }}" target="_blank">{{ $job->title }}</a>
        </h3>
        <p class="mt-2 text-sm text-gray-700 sm:mt-auto">{{ $job->schedule }} - {{ $job->salary }}</p>
    </div>

    <div class="mt-4 flex flex-wrap items-center justify-center gap-2 sm:mt-0 sm:justify-end">
        <div class="flex flex-wrap items-center gap-2">
            @foreach ($job->tags as $tag)
                <div class="flex items-center">
                    <x-tag :$tag class="inline-block" />
                </div>
            @endforeach
        </div>
    </div>

</div>
