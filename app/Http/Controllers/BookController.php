<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BookController extends Controller  implements HasMiddleware
{
        // Adding Auth middleware to all methods except 'index' and 'show'
        public static function middleware(): array
        {
            return [
                new Middleware(['auth'], except: ['index', 'show']),
            ];
        }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::latest()->paginate(6);

        return view('books.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        return view('books.create',['authors' => $authors]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
                // Validate
                $request->validate([
                    'title' => ['required', 'max:255'],
                    'publication_date' => ['required'],
                    // 'cover_image' => ['nullable', 'file', 'max:3000', 'mimes:webp,png,jpg'],
                    // 'book_file' => ['nullable', 'file', 'max:10000', 'mimes:pdf'] // added validation for book_file
                ]);
        


    // Retrieve the author by ID
    $author = Author::findOrFail($request->author_id);

    // Create a book associated with the author
    $book = $author->books()->create([
        'title' => $request->title,
        'publication_date' => $request->publication_date,
    ]);


        if ($request->hasFile('cover_image')) {
            $book->addMediaFromRequest('cover_image')->toMediaCollection('book_images');
        }
    
        if ($request->hasFile('book_file')) {
            $book->addMediaFromRequest('book_file')->toMediaCollection('book_files');
        }
        
                // Redirect back to home
                return back()->with('success', 'Your book was created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {

   // Retrieve all authors
   $authors = Author::all();
                       return view('books.edit', ['book' => $book, 'authors' => $authors]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
 

           // Validate
           $request->validate([
               'title' => ['required', 'max:255'],
               'publication_date' => ['required'],
            //    'cover_image' => ['nullable', 'file', 'max:3000', 'mimes:webp,png,jpg'],
            //    'book_file' => ['nullable', 'file', 'max:10000', 'mimes:pdf'] // added validation for book_file
           ]);
   
           // Store cover_image if exists
           if ($request->hasFile('cover_image')) {
            $book->addMediaFromRequest('cover_image')->toMediaCollection('book_images');
        }
    
        if ($request->hasFile('book_file')) {
            $book->addMediaFromRequest('book_file')->toMediaCollection('book_files');
        }
   
           // Update the book
           $book->update([
               'title' => $request->title,
               'publication_date' => $request->publication_date,

           ]);
   
           // Redirect to home
           return redirect()->route('authors.home')->with('success', 'Your book was updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {

                        // Delete the book
                        $book->delete();
                
                        // Redirect back to home
                        return back()->with('delete', 'Your book was deleted!');
    }
}
