<?php

namespace App\View\Components\layout;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainLayout extends Component
{
    /**
     * Create a new component instance.
     */

    /* We can define the properties as class attributes and pass it to the constructor
     * then pass it to render method to use it in the view
     * we can also define the properties as promotion in the constructor
     * and it will automatically pass to the view without the need to pass it in the render method
     */
    public function __construct(public string $title, public string $mainClass)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.main-layout');
    }
}
