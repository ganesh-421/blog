@auth
    <x-panel>
        <form method="POST" action="/posts/{{ $post->slug }}/comments">
            @csrf
            <header class="flex items-center">
                <img src="https://i.pravatar.cc/100?u={{auth()->id()}}" alt="" width="60" height="60" class="rounded-full">
                <h2 class="ml-4">Want to participate?</h2>
            </header>
            <div class="mt-4">
                <textarea name="body" class="w-full text-sm focus:outline-none focus:ring" id="" rows="5" placeholder="Drop your comments here..."></textarea>
            </div>
            <x-form.error name="body"/>
            <div class="flex justify-end mt-6 border-t border-gray-300 pt-6">
                <x-form.button>Post</x-form.button>
            </div>
        </form>
    </x-panel>
    @else
    <p class="font-semibold">
        <a href="/register" class="hover:underline">Register/</a><a href="/login" class="hover:underline">log in </a>
        to comment..
    </p>
@endauth 