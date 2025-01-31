<x-layout>



    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Our Authors</h2>
                <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">Explore our diverse collection of authors and their remarkable books, crafted with the finest utility classes from Tailwind. Discover the creativity and uniqueness within each story.</p>
            </div>
            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">


                @foreach ($authors as $author)
                <x-author-card :author="$author">
                {{-- Update author --}}
                <a href="{{ route('authors.edit', $author) }}"
                class="bg-green-500 text-white px-2 py-1 text-xs rounded-md">Update</a>

                {{-- Delete author --}}
                <form action="{{ route('authors.destroy', $author) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 text-white px-2 py-1 text-xs rounded-md">Delete</button>
                </form>

                </x-author-card>
                @endforeach

            </div>
            {{ $authors->links() }}
        </div>
        </div>
    </section>
</x-layout>



