<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AuthorController extends Controller implements HasMiddleware
{
    // Adding Auth middleware to all methods except 'index' and 'show'
    public static function middleware(): array
    {
        return [
            new Middleware(['auth'], except: ['index', 'show','home','authorBooks']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::latest()->paginate(6);

        return view('authors.index', ['authors' => $authors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate
                $request->validate([
                    'name' => ['required', 'max:255'],
                    // 'slug' => ['required'],
                    // 'image' => ['nullable', 'file', 'max:3000', 'mimes:webp,png,jpg']
                ]);
        
                    // Create an author
    $author = Author::create([
        'name' => $request->name,
        // 'slug' => $request->slug,
    ]);

                // Store image if exists
                if ($request->hasFile('image')) {
                    $author->addMediaFromRequest('image')->toMediaCollection('author_images');
                }
            

        
 
                // Redirect back to dashboard
                return back()->with('success', 'Your Author was created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return view('authors.show', ['author' => $author]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {


               return view('authors.edit', ['author' => $author]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {


         // Validate
         $request->validate([
             'name' => ['required', 'max:255'],
            //  'slug' => ['required'],
            //  'image' => ['nullable', 'file', 'max:3000', 'mimes:webp,png,jpg']
         ]);

                         // Store image if exists
                        if ($request->hasFile('image')) {
                            $author->addMediaFromRequest('image')->toMediaCollection('author_images');
                        }
 

 
         // Update the author
         $author->update([
             'name' => $request->name,
            //  'slug' => $request->slug,
            //  'image' => $path
         ]);
 
         // Redirect to home
         return redirect()->route('authors.home')->with('success', 'Your author was updated.');
     }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
                // Authorizing the action

        
                // Delete the author
                $author->delete();
        
                // Redirect back to dashboard
                return back()->with('delete', 'Your author was deleted!');
    }

    public function home()
    {
        $authors = Author::withCount('books')->paginate(6);
        // return view('authors.dashboard', ['authors' => $authors]);
        // $authors = Author::with(['books' => function ($query) {
        //     $query->select('id', 'author_id', 'title', 'publication_date');
        // }])->withCount('books')->paginate(6);
        return view('authors.home', ['authors' => $authors]);
    }

    /**
     * Display the books of a specific author by slug.
     */
    public function authorBooks($slug)
    {
        $author = Author::where('slug', $slug)->firstOrFail();
        $authorBookslist = $author->books()->latest()->paginate(6);

        return view('authors.books', [
            'books' => $authorBookslist,
            'author' => $author
        ]);
    }



    public function addNewBook($slug)
{
    $author = Author::where('slug', $slug)->firstOrFail();
    return view('authors.addbook', ['author' => $author]);
}


public function addauthorapi(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => ['required', 'max:255'],
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Create a new author
        $author = new Author();
        $author->name = $request->input('name');
        
        // Handle the image file using Media Library
        if ($request->hasFile('image')) {
            $author->addMediaFromRequest('image')->toMediaCollection('author_images');
        }

        $author->save();

        // Return a response
        return response()->json(['message' => 'Author added successfully'], 201);
    }


}



