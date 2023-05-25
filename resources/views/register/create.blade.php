<x-layout>
    <section class="px-6 py-6">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>
                <h1 class="text-center font-bold text-xl">Register</h1>
                <form action="/register" method="POST" class="mt-10">
                    @csrf
                    <x-form.input name="name" type="text"/>
                    <x-form.input name="username" type="text"/>
                    <x-form.input name="email" type="email" aria-autocomplete="username"/>
                    
                    <x-form.input name="password" type="password" aria-autocomplete="new-password"/>
                    <x-form.button>Submit</x-form.button>
                </form>
            </x-panel>
            
            {{-- @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)   
                    <li class="text-red-500 text-xs mt-1">{{$error}}</li>
                    @endforeach
                </ul>
            @endif  --}}
        </main>
    </section>
</x-layout>