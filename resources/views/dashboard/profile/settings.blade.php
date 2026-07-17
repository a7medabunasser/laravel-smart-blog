<x-layouts.main-layout title="Account Settings">
    <main class="max-w-container-max mx-auto px-gutter py-section-gap pt-[6rem]">
        <div class="flex flex-col md:flex-row gap-12">
            <x-user.user-aside />
            <!-- Main Content Area -->
            <div class="flex-1 max-w-article-max flex flex-col gap-12">
                <header>
                    <h1 class="font-headline-md text-headline-md text-on-surface mb-2">Account Settings</h1>
                    <p class="text-on-surface-variant font-ui-label text-ui-label">Manage your personal account details
                        and subscription preferences.</p>
                </header>
                <!-- Section: Password -->
                <section class="p-8 bg-surface-container-lowest rounded-xl border border-outline-variant">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-ui-label text-ui-label font-bold text-on-surface mb-1">Password</h3>
                            <p class="text-on-surface-variant font-ui-label text-ui-label">
                                Security is paramount. Last changed {{ auth()->user()->updated_at->diffForHumans() }}.
                            </p>
                        </div>
                        <a class="px-4 py-2 border border-outline text-on-surface font-ui-button text-ui-button rounded-lg hover:bg-surface-container transition-all inline-flex items-center gap-2"
                            href="{{ route('dashboard.profile.update-password') }}">
                            Reset Flow <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                        </a>
                    </div>
                </section>
                <!-- Section: Account Deletion (Danger Zone) -->
                <section class="p-8 bg-surface-container-lowest rounded-xl border border-error/20 mt-8">
                    <h3 class="font-ui-label text-ui-label font-bold text-error mb-4">Danger Zone</h3>
                    <div
                        class="flex flex-col md:flex-row md:items-center justify-between gap-6 p-6 bg-error-container/10 border border-error/10 rounded-lg">
                        <div>
                            <h4 class="font-ui-label text-ui-label font-bold text-on-surface mb-1">Delete Account</h4>
                            <p class="text-on-surface-variant font-ui-label text-ui-label max-w-[400px]">Permanently
                                remove your account and all published content. This action is irreversible.</p>
                        </div>
                        <div>
                            <form id="delete-account-form"
                                action="{{ route('dashboard.profile.destroy', auth()->user()->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    onclick="openConfirmDialog('confirm-delete-account', () => document.getElementById('delete-account-form').submit())"
                                    class="bg-error text-on-error font-ui-button text-ui-button px-6 py-2.5 rounded-lg hover:bg-error/90 transition-all">
                                    Delete Forever
                                </button>
                            </form>
                        </div>
                    </div>
                </section>

                <x-dialog.confirm id="confirm-delete-account" title="Delete Account"
                    description="Are you sure you want to permanently delete your account? All of your posts and data will be removed forever. This action is irreversible."
                    confirmText="Delete Forever" />
            </div>
        </div>
    </main>
</x-layouts.main-layout>
