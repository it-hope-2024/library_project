<x-layout>
    {{-- Heading --}}
    <h1 class="title">{{ $author->name }}'s Books &#9830; {{ $books->total() }}</h1>

    {{-- author's books --}}
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
