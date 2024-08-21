<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slides extends Model
{
    protected $fillable = ['order', 'name', 'image', 'status', 'image_alt', 'image_link'];
}
