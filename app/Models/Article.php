<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'context', 'instruction'];

    protected $with = ['category'];

    public function getRouteKeyName() : string
    {
        return 'slug';
    }
    //
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

}


