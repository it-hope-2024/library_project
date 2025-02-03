 @props(['book'])

<div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
    {{-- 'title',
    'publication_date',
    'cover_image',
    'book_file', --}}

    @if ($book->cover_image)
        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="book Image" class="w-64 h-64 rounded-lg sm:rounded-none sm:rounded-l-lg">
    @else
        
            <img class="w-64 h-64 rounded-lg sm:rounded-none sm:rounded-l-lg"
                src="{{ asset('assets/images/book.svg') }}" alt="">

    @endif
    <div class="p-5">
        <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
            Book name:-{{ $book->title }}
        </h3>
        <h5 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">Pub date:{{ $book->publication_date }}</h5>
        {{-- <span class="text-gray-500 dark:text-gray-400">Total Books {{ $book->total() }}</span> --}}
        {{-- <ul class="mt-3 mb-4 font-light text-gray-500 dark:text-gray-400" style="list-style-type: circle;">
            @foreach ($author->books as $book)
                        <li>{{ $book->title }} - {{ $book->publication_date }}</li>
                    @endforeach
        </ul> --}}

        {{-- <div class="mt-5">
            <a href="{{ route('authorBooks', ['slug' => $book->slug]) }}"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                View Details
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div> --}}

        @if ($book->book_file)
        <a href="{{ asset('storage/' . $book->book_file) }}" target="_blank" class="mt-4 inline-block px-4 py-2 rounded tracking-wider bg-blue-500 hover:bg-blue-600 text-white text-[13px]">Open PDF</a>
    @else
        <p class="mt-4 text-gray-500 text-sm">No PDF available for this book.</p>
    @endif
    </div> 


</div>









