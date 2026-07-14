<x-layouts.main-layout title="Update Password">
    <main class="flex-grow flex items-center justify-center py-section-gap px-gutter py-section-gap pt-[6rem]">
        <!-- Password Reset Focused Container -->
        <div class="w-full max-w-[520px] animate-fade-in">
            <div
                class="bg-surface-container-lowest border border-outline-variant rounded-xl p-8 md:p-12 shadow-[0_20px_40px_rgba(0,0,0,0.04)]">
                <!-- Form Header -->
                <div class="text-center mb-10">
                    <h1 class="font-headline-md text-headline-md text-on-surface mb-3">Update Your Password</h1>
                    <p class="font-body-md text-on-surface-variant max-w-[360px] mx-auto text-center opacity-80">
                        Secure your intellectual space with a strong, unique password to keep your drafts and data
                        protected.
                    </p>
                </div>
                <!-- Reset Form -->
                <form class="space-y-6" method="post" action="{{ route('user-password.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="space-y-2">
                        <label class="block font-ui-label text-ui-label text-on-surface-variant"
                            for="current_password">Current
                            Password</label>
                        <div class="relative">
                            <input
                                class="w-full px-4 py-3 bg-surface border rounded-lg focus:ring-2 focus:ring-primary-container focus:border-primary outline-none transition-all font-ui-label text-ui-label @error('current_password') border-error @else border-outline-variant @enderror"
                                id="current_password" name="current_password" placeholder="••••••••" required=""
                                type="password" />
                            <button type="button" aria-label="Toggle password visibility"
                                class="absolute right-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline password-toggle">visibility</button>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block font-ui-label text-ui-label text-on-surface-variant" for="new_password">New
                            Password</label>
                        <div class="relative">
                            <input
                                class="w-full px-4 py-3 bg-surface border rounded-lg focus:ring-2 focus:ring-primary-container focus:border-primary outline-none transition-all font-ui-label text-ui-label @error('password') border-error @else border-outline-variant @enderror"
                                id="new_password" name="password" placeholder="••••••••" required=""
                                type="password" />
                            <button type="button" aria-label="Toggle password visibility"
                                class="absolute right-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline password-toggle">visibility</button>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block font-ui-label text-ui-label text-on-surface-variant"
                            for="new_password_confirmation">Confirm New Password</label>
                        <div class="relative">
                            <input
                                class="w-full px-4 py-3 bg-surface border rounded-lg focus:ring-2 focus:ring-primary-container focus:border-primary outline-none transition-all font-ui-label text-ui-label @error('password_confirmation') border-error @else border-outline-variant @enderror"
                                id="new_password_confirmation" name="password_confirmation" placeholder="••••••••"
                                type="password" />
                            <button type="button" aria-label="Toggle password visibility"
                                class="absolute right-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline password-toggle">visibility</button>
                        </div>
                    </div>
                    <!-- Actions -->
                    <div class="pt-4 space-y-4">
                        <button
                            class="w-full bg-primary-container text-on-primary font-ui-button text-ui-button py-4 rounded-lg hover:shadow-lg transition-all active:scale-95 active:opacity-90"
                            type="submit">
                            Update Password
                        </button>
                        <div class="text-center">
                            <a class="font-ui-label text-ui-label text-secondary hover:text-primary transition-colors inline-flex items-center gap-1 group"
                                href="{{ route('dashboard.profile.settings') }}">
                                <span
                                    class="material-symbols-outlined text-[18px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
                                Back to Settings
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Security Footer Note -->
            <div class="mt-8 text-center flex items-center justify-center gap-2 text-metadata text-outline">
                <span class="material-symbols-outlined text-[18px]">lock</span>
                End-to-end encrypted session
            </div>
        </div>
    </main>
    <!-- Error Messages -->
    @if ($errors->updatePassword->any())
        <x-alerts.toastr icon="error" status="{{ $errors->updatePassword->first() }}" />
    @endif
    <script src="{{ asset('assets/visibility.js') }}" defer></script>
</x-layouts.main-layout>
