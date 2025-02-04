<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class Book extends Model  implements HasMedia
{
    use InteractsWithMedia;
    

public function registerMediaCollections(): void
{
    $this->addMediaCollection('book_images')->singleFile();

    $this->addMediaCollection('book_files')->singleFile();
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


