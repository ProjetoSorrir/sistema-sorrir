<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    protected $fillable = [
        'raffle_id',
        'invoice_id',
        'number',
        'reserved_at',
        'user_id'
    ];

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getByRaffleId($raffleId)
    {
        return self::where('raffle_id', $raffleId)
            ->whereNotNull('invoice_id')
            ->count();
    }
}
