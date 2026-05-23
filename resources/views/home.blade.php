<x-layouts.main-layout title="Home">
    <main class="pt-24 pb-section-gap max-w-container-max mx-auto px-gutter grid grid-cols-1 md:grid-cols-12 gap-8">
        <!-- Left Sidebar: Navigation & Tags -->
        <aside class="hidden md:block md:col-span-2 space-y-8">
            <!-- Navigation -->
            <x-asides.navigation />
            <!-- Tags -->
            <x-asides.tags />
        </aside>
        <!-- Center Feed -->
        <section class="col-span-1 md:col-span-7 space-y-12">
            <!-- Featured Article (Bento Style) -->
            <x-content.featured-article />
            <!-- Grid of Regular Articles -->
            <x-content.suggested-articles />

            <div class="pt-8 flex justify-center">
                <button
                    class="px-8 py-3 border border-primary text-primary font-ui-button text-ui-button rounded-lg hover:bg-primary-container/5 transition-all">
                    Load More Stories
                </button>
            </div>
        </section>
        <!-- Right Sidebar: Trending & Who to Follow -->
        <aside class="hidden lg:block lg:col-span-3 space-y-12">
            <!-- Trending Section -->
            <x-asides.trending-articles />
            <!-- Who to Follow -->
            <x-asides.recommended-authors />
            <!-- Newsletter Sign Up -->
            <x-asides.news-letter>
                {{--
                    I also added a helper slot for additional text below the form,
                    It will not be appear if I don't pass it to the component.
                --}}
                <x-slot:helpers>
                    <p class="font-metadata text-metadata text-on-primary-container">We care about your privacy.
                        Unsubscribe anytime.</p>
                </x-slot:helpers>
            </x-asides.news-letter>
        </aside>
    </main>
</x-layouts.main-layout>
