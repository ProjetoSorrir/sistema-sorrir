<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'tipoChaveRevendedor',
        'chaveRevendedor',
        'balance',
        'tenant_id',
        'admin',
        'cpf',
        'birth_date',
        'ddi',
        'cep',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where('admin', false)
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%");
            });
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'refer_id');
    }


    public function paidInvoices()
    {
        return $this->hasMany(Invoice::class, 'refer_id')->whereNotNull('payed_at');
    }

    public function paidComission()
    {
        return $this->hasMany(Invoice::class, 'refer_id')
        ->whereNotNull('payed_at')
        ->where('refer_payment_status', '=', 'Paid');
    }
    public function isAdmin()
    {
        if ($this->admin) {
            return true;
        }

        return false;
    }
}
