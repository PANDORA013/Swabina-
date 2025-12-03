@props([
    'src' => '',
    'alt' => '',
    'title' => null,
    'loading' => 'lazy',
    'class' => '',
    'style' => '',
    'width' => null,
    'height' => null,
])

@php
    // Extract path and filename without extension
    $pathInfo = pathinfo($src);
    $webpSrc = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';
@endphp

<picture>
    <source srcset="{{ asset($webpSrc) }}" type="image/webp">
    <img src="{{ asset($src) }}" 
         alt="{{ $alt }}"
         @if($title) title="{{ $title }}" @endif
         @if($loading) loading="{{ $loading }}" @endif
         @if($class) class="{{ $class }}" @endif
         @if($style) style="{{ $style }}" @endif
         @if($width) width="{{ $width }}" @endif
         @if($height) height="{{ $height }}" @endif>
</picture>
