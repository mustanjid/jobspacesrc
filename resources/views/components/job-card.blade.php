   @props(['job'])
   <div
       class="p-4 bg-amber-100 rounded-xl flex flex-col text-center border border-transparent hover:border-blue-800 group transition-colors duration-300">
       {{-- employer --}}
       <div class="self-start text-sm">{{ $job->employer->name }}</div>

       {{-- job details --}}
       <div class="py-8">
           <h3 class="group-hover:text-blue-800 text-xl font-bold transition-colors duration-300"><a href="{{ url($job->url) }}" target="_blank">{{ $job->title }}</a></h3>
           <p class="text-sm mt-4">{{ $job->schedule }} - {{ $job->salary }} </p>
       </div>

       {{-- job tags & logo --}}
       <div class="flex justify-between items-center mt-auto">
           <div class="space-x-1">
               @foreach ($job->tags as $tag)
                   <x-tag size="small" :$tag />
               @endforeach
           </div>
           {{-- company logo --}}
           <x-employer-logo :employer='$job->employer' :width='42' />
       </div>
   </div>
