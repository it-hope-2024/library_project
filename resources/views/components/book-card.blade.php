 @props(['book'])

 <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
     @if ($book->getFirstMediaUrl('book_images'))
         <img src="{{ $book->getFirstMediaUrl('book_images') }}" alt="book Image"
             class="w-64 h-64 rounded-lg sm:rounded-none sm:rounded-l-lg">
     @else
         <img class="w-64 h-64 rounded-lg sm:rounded-none sm:rounded-l-lg" src="{{ asset('assets/images/book.svg') }}"
             alt="">
     @endif
     <div class="p-5">
         <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
             Book name:{{ $book->title }}
         </h3>
         <h5 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">Pub
             date:{{ $book->publication_date }}</h5>

         @if ($book->getFirstMediaUrl('book_files'))
             <a href="{{ $book->getFirstMediaUrl('book_files') }}" target="_blank"
                 class="mt-4 inline-block px-4 py-2 rounded tracking-wider bg-blue-500 hover:bg-blue-600 text-white text-[13px]">Open
                 PDF</a>
         @else
             <p class="mt-4 text-gray-500 text-sm">No PDF available for this book.</p>
         @endif
     </div>
     <div class="mt-5">
        {{ $slot }}
    </div>

 </div>
