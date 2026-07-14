<x-layouts.main-layout title="Posts">

    <main class="flex-grow pt-24 w-full max-w-container-max mx-auto px-gutter py-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <h1 class="font-display-lg text-display-lg text-on-background mb-2">Content Management</h1>
                <p class="text-on-surface-variant max-w-lg font-ui-label text-ui-label">
                    Manage your intellectual output, track performance, and schedule your upcoming editorial pieces.
                </p>
            </div>
            <a href="{{ route('dashboard.posts.create') }}"
                class="bg-primary-container text-on-primary px-6 py-3 rounded-lg font-ui-button text-ui-button flex items-center gap-2 hover:opacity-90 active:scale-95 transition-all shadow-sm">
                <span class="material-symbols-outlined text-[20px]" data-icon="edit_square">edit_square</span>
                Create Post
            </a>
        </div>

        <!-- Dashboard Layout Grid -->
        <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-outline-variant gap-4">
            <div class="flex gap-8 overflow-x-auto no-scrollbar">
                @foreach ($status_options as $option)
                    <a href="{{ route('dashboard.posts.index', ['status' => $option['value']]) }}"
                        class="{{ $status->value === $option['value']
        ? 'border-b-2 ' . $option['color']
        : 'text-on-surface-variant hover:text-primary transition-colors' }} pb-4 text-ui-label font-bold whitespace-nowrap">
                        {{ $option['name'] }}
                        ({{ $option['count'] }})
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Bulk Actions Bar (Sticky-ish) -->
        <div
            class="bg-surface-container-low px-4 py-3 rounded-lg flex items-center justify-between border border-outline-variant mt-6">
            <div class="flex items-center gap-4">
                <input class="w-4 h-4 rounded border-outline text-primary focus:ring-primary" type="checkbox" />
                <span class="text-metadata font-ui-label font-medium text-on-surface-variant">2 posts selected</span>
            </div>
            <div class="flex items-center gap-3">
                <button
                    class="text-metadata font-ui-label font-semibold text-secondary hover:text-on-surface transition-all">Unpublish</button>
                <span class="w-px h-4 bg-outline-variant"></span>
                <button
                    class="text-metadata font-ui-label font-semibold text-error hover:text-on-error-container transition-all">Delete</button>
            </div>
        </div>

        <!-- Post Table/List -->
        <div class="space-y-4 mt-6">
            @foreach ($posts as $post)
                <div
                    class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant hover:border-primary transition-all group">
                    <div class="flex items-start gap-4">
                        <input class="mt-2 w-4 h-4 rounded border-outline text-primary focus:ring-primary"
                            type="checkbox" />
                        <div class="flex-grow grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                            <div class="md:col-span-6">
                                <span class="text-metadata font-metadata text-primary mb-1 block">Editorial • 8 min
                                    read</span>
                                <h3
                                    class="font-headline-md text-[20px] leading-snug group-hover:text-primary transition-colors">
                                    {{ $post->title }}
                                </h3>
                                <p class="text-metadata font-metadata text-on-surface-variant mt-1">
                                    Published on {{ $post->created_at->format('M j, Y H:i') }}
                                </p>
                            </div>
                            <div class="md:col-span-2 flex flex-col">
                                <span class="text-metadata font-metadata text-outline">Engagement</span>
                                <div class="flex items-center gap-4 mt-1">
                                    <div class="flex items-center gap-1 text-ui-label font-medium">
                                        <span class="material-symbols-outlined text-[18px]"
                                            data-icon="visibility">visibility</span>
                                        {{ Illuminate\Support\Number::abbreviate($post->views) }}
                                    </div>
                                    <div class="flex items-center gap-1 text-ui-label font-medium">
                                        <span class="material-symbols-outlined text-[18px]"
                                            data-icon="chat_bubble">chat_bubble</span>
                                        84
                                    </div>
                                </div>
                            </div>
                            <div class="md:col-span-2">
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[12px] font-bold border {{ $post->status->getBadgeColor() }}">
                                <span class="h-1.5 w-1.5 rounded-full {{ $post->status->getDotColor() }}"></span>
                                {{ $post->status->getLabel() }}
                            </span>
                            </div>
                            <div
                                class="md:col-span-2 flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('dashboard.posts.edit', $post->id) }}"
                                    class="p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary rounded-lg transition-all"
                                    title="Edit">
                                    <span class="material-symbols-outlined" data-icon="edit">edit</span>
                                </a>
                                <button
                                    class="p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary rounded-lg transition-all"
                                    title="Analytics">
                                    <span class="material-symbols-outlined" data-icon="bar_chart">bar_chart</span>
                                </button>
                                <button
                                    onclick="openConfirmDialog('confirm-delete-post', () => document.getElementById('deletepost{{ $post->id }}').submit())"
                                    class="p-2 text-on-surface-variant hover:bg-surface-container rounded-lg transition-all"
                                    title="Delete">
                                    <span class="material-symbols-outlined" data-icon="delete">delete</span>
                                </button>
                                <form style="display: none;" id="deletepost{{ $post->id }}"
                                    action="{{ route('dashboard.posts.destroy', $post->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-between pt-8">
            <span class="text-metadata font-metadata text-on-surface-variant">Showing 1 to 10 of 42 posts</span>
            <div class="flex gap-2">
                <button
                    class="p-2 border border-outline-variant rounded-lg hover:bg-surface-container-low disabled:opacity-30"
                    disabled="">
                    <span class="material-symbols-outlined" data-icon="chevron_left">chevron_left</span>
                </button>
                <button
                    class="h-10 w-10 border border-primary bg-primary text-on-primary rounded-lg font-ui-label">1</button>
                <button
                    class="h-10 w-10 border border-outline-variant hover:bg-surface-container-low rounded-lg font-ui-label">2</button>
                <button
                    class="h-10 w-10 border border-outline-variant hover:bg-surface-container-low rounded-lg font-ui-label">3</button>
                <button class="p-2 border border-outline-variant rounded-lg hover:bg-surface-container-low">
                    <span class="material-symbols-outlined" data-icon="chevron_right">chevron_right</span>
                </button>
            </div>
        </div>
    </main>

    <x-dialog.confirm id="confirm-delete-post" title="Delete Post?"
        description="Are you sure you want to delete this post? This action cannot be undone." />

</x-layouts.main-layout>
