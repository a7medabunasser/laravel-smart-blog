<a href="{{ $route }}"
    class="font-ui-label text-ui-label transition-colors duration-200 {{ $isActive() ? 'text-primary font-bold border-b-2 border-primary pb-1' : 'text-on-surface-variant font-medium hover:text-primary' }}">
    {{ $slot }}
</a>
