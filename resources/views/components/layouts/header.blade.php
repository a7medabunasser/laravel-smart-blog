    <!-- TopNavBar -->
    @if (request()->is('*auth*'))
        <header class="bg-surface docked full-width top-0 border-b border-outline-variant">
            <div class="flex justify-between items-center w-full px-gutter max-w-container-max mx-auto h-16">
                <span class="font-display-lg-mobile text-display-lg-mobile font-bold text-on-surface">Ink &amp;
                    Paper</span>
                @if (!request()->Is('auth/login'))
                    <div class="hidden md:flex gap-6 items-center">
                        <a class="font-ui-label text-ui-label text-on-surface-variant hover:text-primary transition-colors duration-200"
                            href="{{ route('login') }}">
                            <span class="material-symbols-outlined" data-icon="arrow_back">arrow_back</span>
                            Back to sign in
                        </a>
                    </div>
                @endif
            </div>
        </header>
    @else
        <header class="fixed top-0 z-50 w-full bg-surface border-b border-outline-variant">
            <div class="flex justify-between items-center w-full px-gutter max-w-container-max mx-auto h-16">
                <div class="flex items-center gap-8">
                    <a class="font-display-lg-mobile text-display-lg-mobile font-bold text-on-surface"
                        href="#">Ink
                        &amp; Paper</a>
                    <nav class="hidden md:flex items-center gap-6">
                        <x-layouts.nav-links route="{{ route('dashboard.posts.index') }}"
                            activeRoute="dashboard.posts.index">
                            Dashboard
                        </x-layouts.nav-links>

                        <x-layouts.nav-links route="{{ route('home') }}" activeRoute="home">
                            Feed
                        </x-layouts.nav-links>

                        <x-layouts.nav-links route="#">
                            Authors
                        </x-layouts.nav-links>
                    </nav>
                </div>
                <div class="flex items-center gap-4">
                    <div
                        class="hidden lg:flex items-center bg-surface-container border border-outline-variant rounded-full px-4 py-1.5 gap-2">
                        <span class="material-symbols-outlined text-secondary" data-icon="search">search</span>
                        <input class="bg-transparent border-none focus:ring-0 text-ui-label font-ui-label w-48"
                            placeholder="Search..." type="text" />
                    </div>
                    <div class="flex items-center gap-2">
                        <button
                            class="p-2 text-on-surface-variant hover:bg-surface-container-high rounded-full transition-all">
                            <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
                        </button>
                        <button
                            class="p-2 text-on-surface-variant hover:bg-surface-container-high rounded-full transition-all">
                            <span class="material-symbols-outlined" data-icon="bookmark">bookmark</span>
                        </button>
                        <x-user.user-menu />
                    </div>
                </div>
            </div>
        </header>
    @endif
