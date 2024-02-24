@props(['src', 'alt'])

<img src="{{ asset('storage/' . $src) }}" alt="{{ $alt ?? $src }}" width="32">
