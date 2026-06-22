<x-layouts.main-layout title="Reset password">
    <main class="flex-grow flex items-center justify-center pt-24 pb-section-gap px-gutter">
        <div class="w-full max-w-[440px]">
            <!-- Link Verification Success Banner -->
            <div class="mb-8 flex items-center gap-4 p-4 rounded-lg bg-surface-container border border-outline-variant">
                <span class="material-symbols-outlined text-primary" data-icon="verified"
                    style="font-variation-settings: 'FILL' 1;">verified</span>
                <div>
                    <p class="font-ui-label text-ui-label text-on-surface font-bold">Link Verified</p>
                    <p class="font-metadata text-metadata text-secondary">Your reset token is valid. You may now choose
                        a new password.</p>
                </div>
            </div>
            <!-- Form Container -->
            <div class="paper-card border border-outline-variant p-8 md:p-10 rounded-xl">
                <div class="mb-10 text-center">
                    <h1 class="font-headline-md text-headline-md mb-2">Reset Password</h1>
                    <p class="font-body-md text-body-md text-secondary">Ensure your account is secure by using a
                        complex, unique password.</p>
                </div>
                <form action="{{ route('password.update') }}" class="space-y-8" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <input type="hidden" name="{{ config('fortify.email') }}" value="{{ $request->input('email') }}">
                    <!-- New Password -->
                    <div class="space-y-2">
                        <label class="block font-ui-label text-ui-label text-on-surface-variant" for="new_password">New
                            Password</label>
                        <div class="relative">
                            <input
                                class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary-container focus:border-primary outline-none transition-all font-ui-label text-ui-label"
                                id="new_password" name="password" placeholder="••••••••" required=""
                                type="password" />
                            <button type="button" aria-label="Toggle password visibility"
                                class="absolute right-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline password-toggle">visibility</button>
                        </div>
                    </div>
                    <!-- Confirm New Password -->
                    <div class="space-y-2">
                        <label class="block font-ui-label text-ui-label text-on-surface-variant"
                            for="confirm_password">Confirm New Password</label>
                        <div class="relative">
                            <input
                                class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary-container focus:border-primary outline-none transition-all font-ui-label text-ui-label"
                                id="confirm_password" name="password_confirmation" placeholder="••••••••" required=""
                                type="password" />
                            <button type="button" aria-label="Toggle password visibility"
                                class="absolute right-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline password-toggle">visibility</button>
                        </div>
                    </div>
                    <!-- Primary Action -->
                    <button
                        class="w-full bg-primary-container text-on-primary font-ui-button text-ui-button py-4 rounded-lg hover:shadow-lg transition-all active:scale-95 active:opacity-90"
                        type="submit">
                        Update Password
                    </button>
                </form>
            </div>
        </div>
    </main>
    <script src="{{ asset('assets/visibility.js') }}" defer></script>
</x-layouts.main-layout>
