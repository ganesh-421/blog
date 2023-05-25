@props(['active'=>false])
@php
    $classes = 'block text-left px-3 text-sm leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white rounded-xl mt-1 w-40';
    if($active) {
        $classes.=' bg-green-500 text-white';
    }
    // @dd($active)
@endphp
{{-- @dd(['class'=>$classes, 'status'=>$active]) --}}
<a {{ $attributes(['class'=> $classes])}}>
    {{$slot}}
</a>