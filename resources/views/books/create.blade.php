<x-layout>
    <div class="card mb-4">
    <h2 class="font-bold mb-4">Create a new book</h2>

    {{-- Session Messages --}}
    @if (session('success'))
        <x-flash-msg msg="{{ session('success') }}" />
    @elseif (session('delete'))
        <x-flash-msg msg="{{ session('delete') }}" bg="bg-red-500" />
    @endif

    {{-- Create book Form --}}
    <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        {{-- Book Title --}}
        <div class="mb-4">
            <label for="title">Book Title</label>
            <input type="text" name="title" value="{{ old('title') }}"
                class="input @error('title') ring-red-500 @enderror">

            @error('title')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Book Body --}}
        <div class="mb-4">
            <label for="body">Book Content</label>

            <textarea name="body" rows="4" class="input @error('body') ring-red-500 @enderror">{{ old('body') }}</textarea>

            @error('body')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Book Image --}}
        <div class="mb-4">
            <label for="image">Cover photo</label>
            <input type="file" name="image" id="image">

            @error('image')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit Button --}}
        <button class="btn">Create</button>

    </form>
</div>

</x-layout>