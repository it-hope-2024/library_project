<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class Book extends Model
{
    use InteractsWithMedia;
    

public function registerMediaCollections(): void
{
    $this->addMediaCollection('cover_image');

    $this->addMediaCollection('book_file');
}
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'publication_date',
        // 'cover_image',
        // 'book_file',
        'author_id',
    ];

    public function author() :BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
