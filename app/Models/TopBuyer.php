<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopBuyer extends Model
{
    use HasFactory;

    protected $table = 'top_buyers'; 

    protected $fillable = ['raffle_id', 'user_id', 'total_numbers'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }
}
