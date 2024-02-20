<?php

namespace App\TwigFilters;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class CustomTwigFilter extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('defaultImage', [$this, 'defaultImage']),
        ];
    }

    public function defaultImage(?string $path): string
    {
        if (empty(trim($path))) {
            return 'fig1.JPG';
        } else {
            return $path;
        }
    }
}
