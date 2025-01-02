 @props(['employer', 'width' => 90])

 <img src={{ Storage::url($employer->logo) }} width="{{ $width }}" class="rounded-xl" />