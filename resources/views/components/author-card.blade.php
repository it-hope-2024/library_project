@props(['author'])

<div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">

    @if ($author->image)
        <img src="{{ asset('storage/' . $author->image) }}" alt="Author Image" class="w-64 h-64 rounded-lg sm:rounded-none sm:rounded-l-lg" >
    @else
        <a href="{{ route('authors.authorBooks', ['slug' => $author->slug]) }}">
            <img class="w-64 h-64 rounded-lg sm:rounded-none sm:rounded-l-lg"
                src="{{ asset('assets/images/person.svg') }}" alt="">
        </a>
    @endif
    <div class="p-5">
        <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
            {{ $author->name }}
        </h3>
        <span class="text-gray-500 dark:text-gray-400">Total Books {{ $author->books_count }}</span>
        <ul class="mt-3 mb-4 font-light text-gray-500 dark:text-gray-400" style="list-style-type: circle;">
            {{-- @foreach ($author->books as $book)
                        <li>{{ $book->title }} - {{ $book->publication_date }}</li>
                    @endforeach --}}
        </ul>

        <div class="mt-5">
            <a href="{{ route('authors.authorBooks', ['slug' => $author->slug]) }}"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                View Details
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>
        {{-- Placeholder for extra elements --}}
        <div class="mt-5">
            {{ $slot }}
        </div>

    </div>


</div>
