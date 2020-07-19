<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';
    protected $fillable = [
        'name',
        'isbn',
        'genre',
        'abstract',
        'published_on',
        'author_email',
        'pages'
    ];
}
