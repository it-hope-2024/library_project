<x-layout>
    {{-- Heading --}}
    <h1 class="title">Welcome {{ auth()->user()->username }}, you have {{ $books->total() }} books</h1>

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

    {{-- Author books --}}
    <h2 class="font-bold mb-4">Latest books</h2>


    <div class="grid grid-cols-2 gap-6">
        @foreach ($books as $book)
            {{-- book card component --}}
            <x-book-card :book="$book">

                <div class="flex items-center justify-end gap-4 mt-6">
                    {{-- Update book --}}
                    <a href="{{ route('books.edit', $book) }}"
                        class="bg-green-500 text-white px-2 py-1 text-xs rounded-md">Update</a>

                    {{-- Delete book --}}
                    <form action="{{ route('books.destroy', $book) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-2 py-1 text-xs rounded-md">Delete</button>
                    </form>
                </div>
            </x-book-card>
        @endforeach
    </div>

    {{-- Pagination links --}}
    <div>
        {{ $books->links() }}
    </div>

</x-layout>
