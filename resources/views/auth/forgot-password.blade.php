<x-layouts.main-layout title="Forgot Password">
    <main class="min-h-screen flex items-center justify-center pt-16 px-margin-mobile">
        <div class="w-full max-w-[440px] flex flex-col gap-8">
            <!-- Branding/Icon Section -->
            <div class="flex flex-col items-center text-center gap-4">
                <div
                    class="w-16 h-16 rounded-full bg-surface-container-lowest flex items-center justify-center border border-outline-variant shadow-sm">
                    <span class="material-symbols-outlined text-primary text-[32px]"
                        data-icon="lock_reset">lock_reset</span>
                </div>
                <div class="space-y-2">
                    <h1 class="font-headline-md text-headline-md text-on-surface">Reset your password</h1>
                    <p class="font-body-md text-on-surface-variant max-w-[360px] mx-auto">
                        Enter the email address associated with your account and we'll send you a link to reset your
                        password.
                    </p>
                </div>
            </div>
            <!-- Form Section -->
            <div class="bg-surface-container-lowest p-8 border border-outline-variant rounded-xl">
                <form action="{{ route('password.request') }}" method="post" class="flex flex-col gap-6">
                    @csrf
                    <div class="flex flex-col gap-2">
                        <label class="font-ui-label text-ui-label text-on-surface-variant" for="email">Email
                            Address</label>
                        <input
                            class="w-full h-12 px-4 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary-container focus:border-primary outline-none transition-all font-ui-label text-on-surface placeholder:text-secondary-fixed-dim"
                            id="email" name="{{ config('fortify.email') }}" placeholder="name@company.com"
                            required="" type="email" />
                    </div>
                    <button
                        class="w-full h-12 bg-primary-container hover:bg-primary text-on-primary font-ui-button text-ui-button rounded-lg transition-all active:scale-[0.98] active:opacity-90 shadow-sm"
                        type="submit">
                        Send Reset Link
                    </button>
                </form>
            </div>
            <!-- Footer Link -->
            <div class="text-center">
                <a class="font-ui-label text-ui-label text-secondary hover:text-on-surface underline transition-all"
                    href="{{ route('login') }}">
                    I remember my password
                </a>
            </div>
        </div>
    </main>
    <script src="{{ asset('assets/visibility.js') }}" defer></script>
</x-layouts.main-layout>
