@props([
    'title' => 'Your Tags',
    'tags' => ['#Development', '#DesignSystems', '#Minimalism', '#Typography', '#Future'],
])
<div class="space-y-4">
    <h3 class="font-ui-label text-ui-label uppercase tracking-widest text-secondary font-bold">{{ $title }}
    </h3>
    <div class="flex flex-wrap gap-2">
        @foreach ($tags as $tag)
            <a class="px-3 py-1 bg-surface-container border border-outline-variant rounded-full font-metadata text-metadata hover:bg-outline-variant transition-colors"
                href="#">{{ $tag }}</a>
        @endforeach
    </div>
</div>
