<?php

namespace App\View\Components\asides;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RecommendedAuthors extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $title = 'Recommended Authors', public $authors = [])
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.asides.recommended-authors');
    }
}
