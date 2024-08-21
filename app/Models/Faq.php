<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'answer', 'active'];

    public function scopeSearch($query, $search)
    {
        return $query->where('question', 'like', "%$search%")
            ->orWhere('answer', 'like', "%$search%");
    }
}
