<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate
                $request->validate([
                    'name' => ['required', 'max:255'],
                    'slug' => ['required'],
                    'image' => ['nullable', 'file', 'max:3000', 'mimes:webp,png,jpg']
                ]);
        
                // Store image if exists
                $path = null;
                if ($request->hasFile('image')) {
                    $path = Storage::disk('public')->put('authors_images', $request->image);
                }
        
                // Create a author
                $author = Auth::user()->authors()->create([
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'image' => $path
                ]);
        
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
               // Authorizing the action
               Gate::authorize('modify', $author);

               return view('authors.edit', ['author' => $author]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
         // Authorizing the action
         Gate::authorize('modify', $author);

         // Validate
         $request->validate([
             'name' => ['required', 'max:255'],
             'slug' => ['required'],
             'image' => ['nullable', 'file', 'max:3000', 'mimes:webp,png,jpg']
         ]);
 
         // Store image if exists
         $path = $author->image ?? null;
         if ($request->hasFile('image')) {
             if ($author->image) {
                 Storage::disk('public')->delete($author->image);
             }
             $path = Storage::disk('public')->put('authors_images', $request->image);
         }
 
         // Update the author
         $author->update([
             'name' => $request->name,
             'slug' => $request->slug,
             'image' => $path
         ]);
 
         // Redirect to home
         return redirect()->route('home')->with('success', 'Your author was updated.');
     }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
                // Authorizing the action
                Gate::authorize('modify', $author);

                // Delete author image if exists
                if ($author->image) {
                    Storage::disk('public')->delete($author->image);
                }
        
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
        return view('home', ['authors' => $authors]);
    }

    /**
     * Display the books of a specific author by slug.
     */
    public function authorBooks($slug)
    {
        $author = Author::where('slug', $slug)->firstOrFail();
        $authorBooks = $author->books()->latest()->paginate(6);

        return view('authors.books', [
            'books' => $authorBooks,
            'author' => $author
        ]);
    }


}
