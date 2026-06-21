<!-- Sidebar Navigation -->
<aside class="w-full md:w-64 flex-shrink-0">
    <h2 class="font-headline-md text-headline-md mb-8">Settings</h2>
    <nav class="flex flex-col gap-1">
        <a href="{{ route('dashboard.profile.info') }}"
            class="{{ request()->routeIs('dashboard.profile.info') ? 'flex items-center gap-3 px-4 py-3 rounded-lg text-primary dark:text-primary-fixed-dim font-bold bg-white border border-outline-variant shadow-sm font-ui-label text-ui-label' : 'flex items-center gap-3 px-4 py-3 rounded-lg text-on-surface-variant hover:bg-surface-container transition-all font-medium font-ui-label text-ui-label' }}">
            <span class="material-symbols-outlined" data-icon="person"
                style="font-variation-settings: 'FILL' 1;">person</span>
            Profile Info
        </a>

        <a href="{{ route('dashboard.profile.settings') }}"
            class="{{ request()->routeIs('dashboard.profile.settings') ? 'flex items-center gap-3 px-4 py-3 rounded-lg text-primary dark:text-primary-fixed-dim font-bold bg-white border border-outline-variant shadow-sm font-ui-label text-ui-label' : 'flex items-center gap-3 px-4 py-3 rounded-lg text-on-surface-variant hover:bg-surface-container transition-all font-medium font-ui-label text-ui-label' }}">
            <span class="material-symbols-outlined" data-icon="settings">settings</span>
            Account Settings
        </a>

        <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-surface-variant hover:bg-surface-container transition-all font-medium font-ui-label text-ui-label"
            href="#">
            <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
            Notifications
        </a>
    </nav>
</aside>
