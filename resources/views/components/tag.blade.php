@props(['tag', 'size' => 'base'])

@php
$class = 'bg-black/10 text-gray-800 rounded-xl font-bold hover:bg-black/25 transition-colors duration-300 inline-flex
items-center';
if ($size === 'base') {
$class .= ' px-4 py-1 text-sm';
}

if ($size === 'small') {
$class .= ' px-3 py-1 text-xs';
}
@endphp

<a href="/tags/{{ strtolower($tag->name) }}" class="{{ $class }}">
    {{ $tag->name }}
</a>