<x-layout>
    <div class="mx-auto max-w-screen-sm p-6 bg-white shadow-md rounded-lg my-10">
        <div class="flex items-center mb-4 space-x-4">
            <!-- Go Back Button -->
            <a href="{{ route('authors.home') }}" class="inline-flex items-center justify-center w-10 h-10 text-gray-600 bg-gray-200 rounded-full hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="font-bold mb-4 text-xl text-gray-800">Update Author</h2>
        </div>
        

      
        @if (session('success'))
            <x-flash-msg msg="{{ session('success') }}" />
        @elseif (session('delete'))
            <x-flash-msg msg="{{ session('delete') }}" bg="bg-red-500" />
        @endif

       
        <form action="{{ route('authors.update', $author) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Author Name</label>
                <input type="text" name="name" value="{{$author->name }}" class="mt-1 block w-full px-3 py-2 border  rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

                       {{-- Current Author photo if exists --}}
                       @if ($author->getFirstMediaUrl('author_images'))
                       <div class="h-auto rounded-md mb-4 w-1/6 overflow-hidden">
                           <label>Current Author photo</label>
                           <img class="object-cover object-center rounded-md" src="{{ $author->getFirstMediaUrl('author_images') }}" >
                       </div>
                   @endif

       
                   <div class="mb-4">
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Author Image</label>
                    <input type="file" name="image" id="image" class="block w-full text-sm text-gray-900 border  rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error('image') border-red-500 @enderror">
                    @error('image')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

           
            <button class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Update</button>
        </form>
    </div>

</x-layout>

