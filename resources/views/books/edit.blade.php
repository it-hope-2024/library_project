<x-layout>
    <a href="{{ route('dashboard') }}" class="block mb-2 text-xs text-blue-500">&larr; Go back to your dashboard</a>

    {{-- Update form card --}}
    <div class="card">
        <h2 class="font-bold mb-4">Update your book</h2>

        <form action="{{ route('books.update', $book) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Book Title --}}
            <div class="mb-4">
                <label for="title">Book Title</label>
                <input type="text" name="title" value="{{ $book->title }}"
                    class="input @error('title') ring-red-500 @enderror">

                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Book Body --}}
            <div class="mb-4">
                <label for="body">Book Content</label>
                <textarea name="body" rows="4" class="input @error('body') ring-red-500 @enderror">{{ $book->body }}</textarea>

                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Current cover photo if exists --}}
            @if ($book->image)
                <div class="h-auto rounded-md mb-4 w-1/6 overflow-hidden">
                    <label>Current cover photo</label>
                    <img class="object-cover object-center rounded-md" src="{{ asset('storage/' . $book->image) }}" alt="">
                </div>
            @endif

            {{-- Book Image --}}
            <div class="mb-4">
                <label for="image">Cover photo</label>
                <input type="file" name="image" id="image">

                @error('image')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button class="btn">Update</button>
        </form>
    </div>
</x-layout>
