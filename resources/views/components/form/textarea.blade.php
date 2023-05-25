@props(['name'])
<x-form.field>
    <x-form.label :name="$name" /> 
    {{-- name="{{ $name }}" --}}
    <textarea 
    name={{$name}}
    class="w-full text-sm focus:outline-none border border-gray-200 rounded" 
    id="" 
    rows="5"
    cols="3">{{old($name, $slot)}}
    </textarea>
    <x-form.error :name="$name"/>
</x-form.field>