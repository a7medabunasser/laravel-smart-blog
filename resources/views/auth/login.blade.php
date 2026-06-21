<x-layouts.main-layout title="Login">
    <main class="min-h-[calc(100vh-128px)] flex items-center justify-center py-section-gap px-gutter">
        <div class="w-full max-w-[440px]">
            <!-- Login Card -->
            <div
                class="bg-surface-container-lowest border border-outline-variant p-8 md:p-10 rounded-lg shadow-[0_20px_30px_-10px_rgba(0,0,0,0.05)] transition-all">
                <div class="mb-8 text-center md:text-left">
                    <h1 class="font-headline-md text-headline-md text-on-surface mb-2">Welcome back</h1>
                    <p class="font-body-md text-secondary">Sign in to your editorial workspace.</p>
                </div>
                <form action="{{ route('login.store') }}" method="post" class="space-y-6">
                    @csrf
                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label class="font-ui-label text-ui-label text-on-surface-variant block" for="email">Email
                            Address</label>
                        <input
                            class="w-full h-12 px-4 bg-surface-bright border border-outline-variant rounded focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all font-ui-label text-on-surface placeholder:text-outline"
                            id="email" name="{{ config('fortify.username') }}"
                            value="{{ old(config('fortify.username')) }}" placeholder="name@domain.com" required=""
                            type="email" />
                    </div>
                    <!-- Password Field -->
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <label class="font-ui-label text-ui-label text-on-surface-variant"
                                for="password">Password</label>
                            <a class="font-ui-label text-ui-label text-primary hover:underline transition-all"
                                href="{{ route('password.request') }}">Forgot Password?</a>
                        </div>
                        <div class="relative">
                            <input
                                class="w-full h-12 px-4 bg-surface-bright border border-outline-variant rounded focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all font-ui-label text-on-surface placeholder:text-outline"
                                id="password" name="password" placeholder="••••••••" required="" type="password" />
                            <button type="button" aria-label="Toggle password visibility"
                                class="absolute right-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline password-toggle">visibility</button>
                        </div>
                    </div>
                    <!-- Remember Me -->
                    <div class="flex items-center gap-3">
                        <input
                            class="w-4 h-4 rounded border-outline-variant text-primary focus:ring-primary transition-all"
                            id="remember" name="remember" type="checkbox" />
                        <label class="font-ui-label text-ui-label text-on-secondary-fixed-variant select-none"
                            for="remember">Remember me</label>
                    </div>
                    <!-- Primary Action -->
                    <button
                        class="w-full h-12 bg-primary-container text-on-primary font-ui-button text-ui-button rounded hover:bg-primary active:scale-95 transition-all flex justify-center items-center gap-2"
                        type="submit">
                        Sign In
                    </button>
                </form>
                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-outline-variant"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span
                            class="bg-surface-container-lowest px-4 font-metadata text-metadata text-outline uppercase tracking-widest">or
                            continue with</span>
                    </div>
                </div>
                <!-- Social Logins -->
                <div class="grid grid-cols-2 gap-4">
                    <button
                        class="h-12 border border-on-surface flex items-center justify-center gap-3 font-ui-label text-ui-label text-on-surface hover:bg-surface-container transition-all rounded">
                        <span class="material-symbols-outlined text-[20px]" data-icon="cloud">cloud</span>
                        Google
                    </button>
                    <button
                        class="h-12 border border-on-surface flex items-center justify-center gap-3 font-ui-label text-ui-label text-on-surface hover:bg-surface-container transition-all rounded">
                        <span class="material-symbols-outlined text-[20px]" data-icon="terminal">terminal</span>
                        Github
                    </button>
                </div>
                <!-- Footer Link -->
                <div class="mt-10 text-center">
                    <p class="font-ui-label text-ui-label text-on-surface-variant">
                        New to Ink &amp; Paper?
                        <a class="text-primary font-bold hover:underline transition-all ml-1"
                            href="{{ route('register') }}">Create an
                            Account</a>
                    </p>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('assets/visibility.js') }}" defer></script>
</x-layouts.main-layout>
