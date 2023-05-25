@props(['trigger'])
<div x-data="{display : false}" @click.away="display = false" class="relative">
    {{-- tgrigger --}}
    <div @click="display = !display" > {{--Drop-down item container--}}
        {{$trigger}}
    </div>
    {{-- links --}}
    <div x-show = "display" class="z-50 py-2 absolute bg-gray-100 mt-2 w-full rounded-xl overflow-auto max-h-52" style="display: none;">
        {{$slot}}
    </div> 
</div>