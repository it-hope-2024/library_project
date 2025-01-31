<x-layout>
    <h1 class="title">Latest Books</h1>

    {{-- List of Books --}}
    <div class="grid grid-cols-2 gap-6">
        @foreach ($books as $book)
            <x-book-card :book="$book" />
        @endforeach
    </div>

    {{-- Pagination links --}}
    <div>
        {{ $books->links() }}
    </div>
</x-layout>
