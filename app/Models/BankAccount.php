<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = [
        'payment_method',
        'pix_key',
        'key_type',
        'name_or_social_reason',
        'cpf_cnpj',
        'bank_name',
        'logo'
    ];
}
