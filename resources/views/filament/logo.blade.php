@php
    $logo = str_contains(Route::currentRouteName(), 'auth')
        ? 'images/logo_branco.png' 
        : 'images/logo_branco_min.png';
@endphp

<img 
    src="{{ asset($logo) }}" 
    alt="Logo"
>
</img>