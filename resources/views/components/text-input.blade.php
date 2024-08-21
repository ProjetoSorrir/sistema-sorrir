@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-200 bg-gray-100 py-2 text-gray-700 rounded-md shadow-sm']) !!}>
