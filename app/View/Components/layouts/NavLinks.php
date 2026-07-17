<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavLinks extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $route,
        public ?string $activeRoute = null,
    ) {}

    public function isActive(): bool
    {
        return request()->routeIs($this->activeRoute ?? $this->route);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.nav-links');
    }
}
