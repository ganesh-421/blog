<x-layout>
    <x-setting heading="Publish New Post">
        <form method="POST" action="/admin/posts" enctype="multipart/form-data">
            @csrf
            <x-form.input name="title" type="text" />
            <x-form.input name="slug" type="text" />
            <x-form.input name="thumbnail" type="file" />
            <x-form.textarea name="excerpt" />
            <x-form.textarea name="body" />
            <x-form.field>
                <x-form.label name="category" />
                <select name="category_id" id="">
                    @foreach (App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>
                            {{ ucwords($category->name) }}</option>
                    @endforeach
                </select>
                <x-form.error name="category_id" />
            </x-form.field>
            <x-form.button>Publish</x-form.button>
        </form>
    </x-setting>

</x-layout>
