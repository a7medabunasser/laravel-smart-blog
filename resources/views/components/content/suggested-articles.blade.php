@props([
    'articles' => [
        [
            'title' => 'The Resurgence of Serif Fonts in High-Contrast Digital Interfaces',
            'published_at' => 'May 10, 2024',
            'content' => 'How modern
                high-resolution displays are bringing back the elegance of the serif, and why readability is
                the new luxury.',
            'author' => 'Elena Vance',
            'category' => 'Typography',
            'read_at' => '5 min read',
        ],
        [
            'title' => 'Curating Your Digital Canvas: A Guide to Focused Workspaces',
            'published_at' => 'May 08, 2024',
            'content' => 'Reducing cognitive
                load through environmental design. Learn how to strip away the non-essential from your
                workflow.',
            'author' => 'Marcus Chen',
            'category' => 'Productivity',
            'read_at' => '12 min read',
        ],
    ],
])
<div class="grid grid-cols-1 gap-12">
    <!-- Articles -->
    @for ($i = 0; $i < count($articles); $i++)
        <article class="flex flex-col md:flex-row gap-8 group">
            <div
                class="w-full md:w-1/3 aspect-video md:aspect-square overflow-hidden rounded-lg border border-outline-variant">
                <img alt=""
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                    data-alt="A modern office workspace with a clean, white desk featuring a sleek laptop and a single architectural plant. The wall behind is a neutral grey with a single minimalist poster framed in black. The lighting is bright and even, creating a crisp and professional environment that feels organized and serene. The overall style is modern minimalist with a focus on functional clarity."
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAYOfwZva0F3aWqjVIFQtGgNkCRYq1JRNEMXBD0AkUlEEjMZc6s0G8_FIOJqlR7yUPsMAgaN5Mdk12msCp-vZTcDx14FpUnXYFZzVv1Fq6wMmIlqAAKNp2s-nOvKHpc67EHg38exnymuQfAi1za4cPulsSu4YQPqnlXKqR-6_4BuLfVgV-Z0U_Bn-6UOhyvzHxMcXiLf5MAHC1XglUgOp2FIPbALir4i9sBSPPX2gTLdVe1K42tVpGIA3mG6VHeWCvjOQoBYKgFVIAu" />
            </div>
            <div class="w-full md:w-2/3 space-y-3">
                <div class="flex items-center gap-2 font-metadata text-metadata text-secondary">
                    <span class="text-primary font-bold">{{ $articles[$i]['category'] }}</span>
                    <span>•</span>
                    <span>{{ $articles[$i]['published_at'] }}</span>
                </div>
                <h3
                    class="font-headline-md text-[24px] leading-snug text-on-surface group-hover:text-primary transition-colors">
                    {{ $articles[$i]['title'] }}</h3>
                <p class="text-on-surface-variant font-body-md text-body-md line-clamp-2">{{ $articles[$i]['content'] }}
                </p>
                <div class="flex items-center gap-3 pt-2">
                    <p class="font-ui-label text-ui-label text-on-surface font-medium">{{ $articles[$i]['author'] }}</p>
                    <span class="text-secondary text-metadata">•</span>
                    <span class="text-secondary font-metadata text-metadata">{{ $articles[$i]['read_at'] }}</span>
                </div>
            </div>
        </article>
    @endfor
</div>
