<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class CopyrightExtension extends AbstractExtension
{
    // public function getFilters(): array
    // {
    //     return [
    //         // If your filter generates SAFE HTML, you should add a third
    //         // parameter: ['is_safe' => ['html']]
    //         // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
    //         new TwigFilter('filter_name', [$this, 'doSomething']),
    //     ];
    // }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('copyright', [$this, 'get_copyright'], ['is_safe' => ['html']]),
        ];
    }

    public function get_copyright(): string
    {
        return "&copy; 2021 - SuperCatalog 2000";
    }
}
