<div
    class="p-4 bg-amber-100 rounded-xl flex flex-col gap-y-4 sm:flex-row sm:gap-x-6 border border-transparent hover:border-blue-800 group transition-colors duration-300">

    <!-- Employer Logo Section -->
    <div class="flex-shrink-0 flex justify-center sm:block">
        <x-employer-logo :employer="$job->employer" class="h-16 w-16 sm:h-20 sm:w-20" />
    </div>

    <!-- Job Details Section -->
    <div class="flex-1 flex flex-col text-center sm:text-left">
        <a class="self-center sm:self-start text-sm text-gray-700">{{ $job->employer->name }}</a>
        <h3 class="text-lg sm:text-xl mt-2 font-bold group-hover:text-blue-800 transition-colors duration-300">
            <a href="{{ url($job->url) }}" target="_blank">{{ $job->title }}</a>
        </h3>
        <p class="text-sm text-gray-700 mt-2 sm:mt-auto">{{ $job->schedule }} - {{ $job->salary }}</p>
    </div>

    <!-- Tags Section -->
<div class="flex justify-center sm:justify-end items-center flex-wrap gap-2 mt-4 sm:mt-0">
    <span
        class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
        Featured
    </span>

    <div class="flex flex-wrap gap-2 items-center">
        @foreach ($job->tags as $tag)
        <div class="flex items-center">
            <x-tag :$tag class="inline-block" />
        </div>
        @endforeach
    </div>
</div>

</div>