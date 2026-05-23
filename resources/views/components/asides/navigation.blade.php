@props([
    'title' => 'Discover',
    'items' => [
        [
            'name' => 'Explore',
            'icon' => 'explore',
            'link' => '#',
            'selected' => false,
        ],
        [
            'name' => 'Popular',
            'icon' => 'trending_up',
            'link' => '#',
            'selected' => true,
        ],
        [
            'name' => 'Recent',
            'icon' => 'history',
            'link' => '#',
            'selected' => false,
        ],
    ],
])

<div class="space-y-4">
    <h3 class="font-ui-label text-ui-label uppercase tracking-widest text-secondary font-bold">{{ $title }}</h3>
    <ul class="space-y-2">
        @for ($i = 0; $i < count($items); $i++)
            <li><a class="flex items-center gap-3 {{ $items[$i]['selected'] ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary transition-colors' }} font-ui-label text-ui-label py-1"
                    href="{{ $items[$i]['link'] }}"><span class="material-symbols-outlined" data-weight="fill"
                        style="font-variation-settings: 'FILL' 1;">{{ $items[$i]['icon'] }}</span>{{ $items[$i]['name'] }}</a>
            </li>
        @endfor
    </ul>
</div>
