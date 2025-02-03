<x-layout>
    <div class="card mb-4 p-6 bg-white rounded-lg shadow-md">
        <h2 class="font-bold mb-4 text-xl text-gray-800">Create a new Author</h2>

        {{-- Session Messages --}}
        @if (session('success'))
            <x-flash-msg msg="{{ session('success') }}" />
        @elseif (session('delete'))
            <x-flash-msg msg="{{ session('delete') }}" bg="bg-red-500" />
        @endif

        {{-- Create Author Form --}}
        <form action="{{ route('authors.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- Author Name --}}
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Author Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="mt-1 block w-full px-3 py-2 border  rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Author Image --}}
            <div class="mb-4">
                <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                <input type="file" name="image" id="image" class="block w-full text-sm text-gray-900 border  rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error('image') border-red-500 @enderror">
                @error('image')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Create</button>
        </form>
    </div>
</x-layout>
