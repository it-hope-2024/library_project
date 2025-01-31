<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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
        //
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
                    'cover_image' => ['nullable', 'file', 'max:3000', 'mimes:webp,png,jpg'],
                    'book_file' => ['nullable', 'file', 'max:10000', 'mimes:pdf'] // added validation for book_file
                ]);
        
                // Store cover_image if exists
                $path = null;
                if ($request->hasFile('cover_image')) {
                    $path = Storage::disk('public')->put('books_images', $request->cover_image);
                }
        
                        // Store book_file if exists
        $filePath = null;
        if ($request->hasFile('book_file')) {
            $filePath = Storage::disk('public')->put('books_files', $request->book_file);
        }

                // Create a book
                $book = Auth::user()->books()->create([
                    'title' => $request->title,
                    'publication_date' => $request->publication_date,
                    'cover_image' => $path,
                    'book_file' => $filePath // save file path to the database
                ]);
        
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
                       // Authorizing the action
                       Gate::authorize('modify', $book);

                       return view('books.edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
           // Authorizing the action
           Gate::authorize('modify', $book);

           // Validate
           $request->validate([
               'title' => ['required', 'max:255'],
               'publication_date' => ['required'],
               'cover_image' => ['nullable', 'file', 'max:3000', 'mimes:webp,png,jpg'],
               'book_file' => ['nullable', 'file', 'max:10000', 'mimes:pdf'] // added validation for book_file
           ]);
   
           // Store cover_image if exists
           $path = $book->cover_image ?? null;
           if ($request->hasFile('cover_image')) {
               if ($book->cover_image) {
                   Storage::disk('public')->delete($book->cover_image);
               }
               $path = Storage::disk('public')->put('books_images', $request->cover_image);
           }

            // Store book_file if exists
        $filePath = $book->file_path ?? null;
        if ($request->hasFile('book_file')) {
            if ($book->book_file) {
                Storage::disk('public')->delete($book->book_file);
            }
            $filePath = Storage::disk('public')->put('books_files', $request->book_file);
        }
   
           // Update the book
           $book->update([
               'title' => $request->title,
               'publication_date' => $request->publication_date,
               'cover_image' => $path,
               'book_file' => $filePath // update file path in the database
           ]);
   
           // Redirect to home
           return redirect()->route('home')->with('success', 'Your book was updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
                        // Authorizing the action
                        Gate::authorize('modify', $book);

                        // Delete book image if exists
                        if ($book->cover_image) {
                            Storage::disk('public')->delete($book->cover_image);
                        }
                        // Delete book file if exists
        if ($book->book_file) {
            Storage::disk('public')->delete($book->book_file);
        }
                        // Delete the book
                        $book->delete();
                
                        // Redirect back to home
                        return back()->with('delete', 'Your book was deleted!');
    }
}
