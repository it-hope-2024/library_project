<x-layout>
    <div class="mx-auto max-w-screen-sm p-6 bg-white shadow-md rounded-lg my-10">

        <h2 class="font-bold mb-4">Update your book</h2>


        {{-- Session Messages --}}
        @if (session('success'))
            <x-flash-msg msg="{{ session('success') }}" />
        @elseif (session('delete'))
            <x-flash-msg msg="{{ session('delete') }}" bg="bg-red-500" />
        @endif
        <form action="{{ route('books.update', $book) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Author --}}
            <div class="mb-4">
                <label for="author_id" class="block mb-2 text-sm font-medium text-gray-900">Author</label>
                <select name="author_id" id="author_id"
                    class="input w-full p-2 border rounded-lg @error('author_id') border-red-500 @enderror">
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}" @if ($author->id == $book->author_id) selected @endif>
                            {{ $author->name }}</option>
                    @endforeach
                </select>
                @error('author_id')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            {{-- Book Title --}}
            <div class="mb-4">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Book Title</label>
                <input type="text" name="title" value="{{ $book->title }}"
                    class="input w-full p-2 border rounded-lg @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            {{-- Publication Date --}}
            <div class="mb-4">
                <label for="publication_date" class="block text-sm font-medium text-gray-700">Publication Date</label>
                <input type="date" name="publication_date" value="{{ $book->publication_date }}"
                    class="input mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('publication_date') border-red-500 @enderror">
                @error('publication_date')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Current Book Image if exists --}}
            @if ($book->getFirstMediaUrl('book_images'))
                <div class="h-auto rounded-md mb-4 w-1/6 overflow-hidden">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Current Book image</label>
                    <img class="object-cover object-center rounded-md"
                        src="{{ $book->getFirstMediaUrl('book_images') }}">
                </div>
            @endif

            {{-- Book Cover Image --}}
            <div class="mb-4">
                <label for="cover_image" class="block mb-2 text-sm font-medium text-gray-900">Cover Photo</label>
                <input type="file" name="cover_image" id="cover_image"
                    class="block w-full text-sm text-gray-900 border rounded-lg cursor-pointer bg-gray-50 focus:outline-none @error('cover_image') border-red-500 @enderror">
                @error('cover_image')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Current Book File if exists --}}
            @if ($book->getFirstMediaUrl('book_files'))
            <span class="text-black" >Current File :</span>
                <a href="{{ $book->getFirstMediaUrl('book_files') }}" target="_blank"
                    class="mt-4 inline-block px-4 py-2 rounded tracking-wider text-blue-500 hover:text-blue-400  text-[13px]">{{ $book->getFirstMediaUrl('book_files') }}</a>
            @else
                <p class="mt-4 text-gray-500 text-sm">No PDF available for this book.</p>
            @endif
    


    {{-- Book File --}}
    <div class="mb-4">
        <label for="book_file" class="block mb-2 text-sm font-medium text-gray-900">Book File</label>
        <input type="file" name="book_file" id="book_file"
            class="block w-full text-sm text-gray-900 border rounded-lg cursor-pointer bg-gray-50 focus:outline-none @error('book_file') border-red-500 @enderror">
        @error('book_file')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    {{-- Submit Button --}}
    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update</button>
    </form>
    </div>
</x-layout>
