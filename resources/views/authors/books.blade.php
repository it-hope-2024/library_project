<x-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                    {{ $author->name }}'s Books : {{ $books->total() }}</h2>
            </div>

            {{-- Add New Book Button (visible to authenticated users only) --}}
            @auth
                <div class="text-center mb-8">
                    <a href="{{ route('authors.addNewBook', ['slug' => $author->slug]) }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Add New Book</a>
                </div>
            @endauth
            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
                

                {{-- author's books --}}
                @foreach ($books as $book)
                    <x-book-card :book="$book" >
                        @auth


                            {{-- Update Book --}}
                            <div class="mt-2">
                                <a href="{{ route('books.edit', $book) }}"
                                    class="bg-green-500 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white  rounded-lg">Update</a>
                            </div>
                            {{-- Delete Book --}}
                            <div class="mt-2">
                                <form action="{{ route('books.destroy', $book) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="bg-red-500 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white  rounded-lg">Delete</button>
                                </form>
                            </div>
                        @endauth
                    </x-book-card>
                @endforeach
            </div>

            {{ $books->links() }}
        </div>
        </div>
    </section>
</x-layout>
