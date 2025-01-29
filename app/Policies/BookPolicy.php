<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Book;
use App\Models\Author;
use App\Models\User;

class BookPolicy
{    // Authorize the action if User owns the Post
    public function modify(Author $author, Book $book) : bool 
    {
        return $author->id === $book->author_id;
    }
}


