@props(['active'])

@php
$classes = ($active ?? false)
? 'inline-flex items-center px-1 pt-1 border-b-2 border-orange-400 text-orange-900 font-medium focus:outline-none focus:border-orange-700 transition duration-150 ease-in-out'
: 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-gray-500 hover:text-orange-900 hover:border-orange-400 focus:outline-none focus:text-orange-900 focus:border-orange-400 transition duration-150 ease-in-out';
@endphp


<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>