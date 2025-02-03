<x-layout>
    <div class="card mb-4 p-6 bg-white rounded-lg shadow-md">
        <h2 class="font-bold mb-4 text-xl text-gray-800">Create a new book</h2>

        {{-- Session Messages --}}
        @if (session('success'))
            <x-flash-msg msg="{{ session('success') }}" />
        @elseif (session('delete'))
            <x-flash-msg msg="{{ session('delete') }}" bg="bg-red-500" />
        @endif

        {{-- Create book Form --}}
        <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- Author id --}}
            <input type="hidden" name="author_id" value="{{ $author->id }}">

            {{-- Book Title --}}
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Book Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="input mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Publication Date --}}
            <div class="mb-4">
                <label for="publication_date" class="block text-sm font-medium text-gray-700">Publication Date</label>
                <input type="date" name="publication_date" value="{{ old('publication_date') }}" class="input mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('publication_date') border-red-500 @enderror">
                @error('publication_date')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Book Cover Image --}}
            <div class="mb-4">
                <label for="cover_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cover Photo</label>
                <input type="file" name="cover_image" id="cover_image" class="block w-full text-sm text-gray-900 border rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error('cover_image') border-red-500 @enderror">
                @error('cover_image')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Book File --}}
            <div class="mb-4">
                <label for="book_file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book File</label>
                <input type="file" name="book_file" id="book_file" class="block w-full text-sm text-gray-900 border rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error('book_file') border-red-500 @enderror">
                @error('book_file')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>


            {{-- Submit Button --}}
            <button class="btn w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Create Book</button>

        </form>
    </div>
</x-layout>
