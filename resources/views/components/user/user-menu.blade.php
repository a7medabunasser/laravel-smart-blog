@auth('web')
    <div class="flex items-center gap-3">
        <a href="#"
            class="ml-2 bg-primary-container text-on-primary px-6 py-2 rounded-lg font-ui-button text-ui-button hover:opacity-90 active:scale-95 transition-all">
            Create Post
        </a>

        <div class="relative">
            <button id="user-menu-button" type="button" aria-haspopup="true" aria-expanded="false" aria-controls="user-menu"
                class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-outline-variant bg-purple-700 text-white shadow-sm transition duration-200 hover:bg-purple-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                <span class="sr-only">Open user menu</span>

                <img alt="Avatar" class="w-full h-full object-cover rounded-full tracking-wide"
                    src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=7c3aed&color=fff' }}" />

            </button>

            <div id="user-menu"
                class="hidden absolute right-0 z-50 mt-2 w-56 overflow-hidden rounded-3xl border border-slate-200 bg-white text-slate-900 shadow-2xl">
                <div class="px-4 py-4 border-b border-slate-200 bg-slate-50">
                    <p class="text-sm font-semibold">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-500">Manage your account</p>
                </div>

                <a href="{{ route('dashboard.profile.info') }}"
                    class="block px-4 py-3 text-sm text-slate-700 transition hover:bg-slate-100 hover:text-slate-900">
                    Profile Info
                </a>


                <button type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="w-full text-left px-4 py-3 text-sm font-semibold text-rose-600 transition hover:bg-slate-100">
                    Logout
                </button>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <script>
        const button = document.getElementById('user-menu-button');
        const menu = document.getElementById('user-menu');

        button.addEventListener('click', () => {
            const isOpen = button.getAttribute('aria-expanded') === 'true';
            button.setAttribute('aria-expanded', String(!isOpen));
            menu.classList.toggle('hidden');
        });

        document.addEventListener('click', function(event) {
            const target = event.target;
            if (!button.contains(target) && !menu.contains(target)) {
                button.setAttribute('aria-expanded', 'false');
                menu.classList.add('hidden');
            }
        });
    </script>
@else
    <a href="{{ route('login') }}"
        class="ml-2 rounded-full bg-primary-container px-6 py-2 text-sm font-semibold text-on-primary shadow-sm transition duration-200 hover:opacity-90 active:scale-95">
        Login
    </a>
@endauth
