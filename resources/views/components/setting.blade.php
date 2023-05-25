@props(['heading'])
<section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 border-b pb-2">        
        {{ $heading }} 
    </h1>
    <div class="flex">
        <aside class="w-48 flex-shrink-0">
            <h4 class="font-semibold mb-4">Links</h4>
            
            <x-dropdown-item href="/admin/posts">Dashboard</x-dropdown-item>
            <x-dropdown-item href="/admin/posts/create" :active="request()->is('admin/posts/create')"> New Post </x-dropdown-item>
            <x-dropdown-item href="/admin/posts" :active="request()->is('admin/posts')"> Manage Posts </x-dropdown-item>
        </aside>
        <main class="flex-1">
            <x-panel class="">
                {{ $slot }}        
            </x-panel>
        </main>
    </div>        
</section> 