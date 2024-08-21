<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{    
    protected $fillable = ['key', 'value'];

    /**
     * Método para obter o valor de uma configuração.
     *
     * @param string $key
     * @return string|null
     */
    public static function get($key)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : null;
    }

    /**
     * Método para definir o valor de uma configuração.
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    public static function set($key, $value)
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
