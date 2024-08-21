<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSpecs extends Model
{
    use HasFactory;

    protected $fillable = ['site_id', 'is_active', 'status', 'taskFinished'];
}
