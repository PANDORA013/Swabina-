<?php

namespace App\View\Components;

use Illuminate\View\Component;

class OptimizedImage extends Component
{
    public $filename;
    public $path;
    public $alt;
    public $class;
    public $responsive;

    public function __construct($filename, $path = 'uploads', $alt = 'Image', $class = '', $responsive = true)
    {
        $this->filename = $filename;
        $this->path = $path;
        $this->alt = $alt;
        $this->class = $class;
        $this->responsive = $responsive;
    }

    public function render()
    {
        $jpegUrl = asset('storage/' . $this->path . '/' . $this->filename . '.jpg');
        $webpUrl = asset('storage/' . $this->path . '/' . $this->filename . '.webp');
        $alt = htmlspecialchars($this->alt);
        $class = htmlspecialchars($this->class);

        if ($this->responsive) {
            return <<<HTML
<picture>
    <source type="image/webp" srcset="$webpUrl 1x, $webpUrl 2x">
    <source type="image/jpeg" srcset="$jpegUrl 1x, $jpegUrl 2x">
    <img src="$jpegUrl" alt="$alt" loading="lazy" decoding="async" class="$class" style="max-width: 100%; height: auto;">
</picture>
HTML;
        } else {
            return <<<HTML
<picture>
    <source type="image/webp" srcset="$webpUrl">
    <source type="image/jpeg" srcset="$jpegUrl">
    <img src="$jpegUrl" alt="$alt" loading="lazy" decoding="async" class="$class">
</picture>
HTML;
        }
    }
}
