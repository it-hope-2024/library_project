<x-layout>
    {{-- Heading --}}
    <h1 class="title">Welcome {{ auth()->user()->username }}, you have {{ $books->total() }} books</h1>



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
