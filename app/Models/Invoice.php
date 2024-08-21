<?php

namespace App\Models;

use App\Jobs\ConfirmPaymentJob;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'user_id',
        'raffle_id',
        'payment_method',
        'payed_at',
        'external_id',
        'amount',
        'invoice_path',
        'payment_voucher_path',
        'refer_id',
        'payed_refer',
        'mercado_livre_id',
        'refer_amount',
        'refer_percentage',
        'refer_payment_status',
        'accept_terms',
        'number_qty',
        'premier_numbers',
        'job_started_at'
    ];

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function numbers()
    {
        return $this->hasMany(Number::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->whereHas('raffle', function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
        });
    }

    public function referredUser()
    {
        return $this->belongsTo(User::class, 'refer_id');
    }

    public function getNumberQty()
    {
        if (is_null($this->number_qty)) {
            return $this->numbers()->count();
        }
        return $this->number_qty;
    }

    public function dispatchPaymentJob()
    {
        if (is_null($this->job_started_at)) {
            $this->job_started_at = now();
            $this->saveOrFail();
            ConfirmPaymentJob::dispatch($this->id);
        }

    }

}
