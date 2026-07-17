<x-layouts.main-layout title="Profile Info">
    <main class="max-w-container-max mx-auto px-gutter py-section-gap pt-[6rem] ">
        <div class="flex flex-col md:flex-row gap-12">
            <!-- Sidebar Navigation -->
            <x-user.user-aside />
            <!-- Main Content Canvas -->
            <div class="flex-grow max-w-article-max">
                <div class="bg-white border border-outline-variant rounded-xl p-8 shadow-sm">
                    <header class="mb-10">
                        <h1 class="font-headline-md text-headline-md text-on-surface mb-2">Profile</h1>
                        <p class="font-body-md text-body-md text-secondary">Control how others see you on the Ink &amp;
                            Paper platform.</p>
                    </header>
                    <form class="space-y-10" action="{{ route('user-profile-information.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Avatar Section -->
                        <div class="flex items-center gap-6">
                            <!-- Avatar -->
                            <div class="relative group shrink-0">
                                <div
                                    class="w-24 h-24 rounded-full overflow-hidden border-2 border-outline-variant bg-surface-container-low">
                                    <img id="profile-picture-preview" class="w-full h-full object-cover"
                                        src="{{ auth()->user()->profile_picture
                                            ? asset('storage/' . auth()->user()->profile_picture)
                                            : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=7c3aed&color=fff' }}"
                                        alt="Profile Picture"
                                        data-default-avatar="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=7c3aed&color=fff">
                                </div>

                                <label for="profile_picture"
                                    class="absolute inset-0 flex items-center justify-center rounded-full bg-black/40 opacity-0 transition-opacity group-hover:opacity-100 cursor-pointer">
                                    <span class="material-symbols-outlined text-white">
                                        photo_camera
                                    </span>
                                </label>
                            </div>

                            <!-- Details -->
                            <div class="flex-1 space-y-2">
                                <div class="flex items-center justify-between">
                                    <h3 class="font-ui-label text-ui-label font-semibold">
                                        Profile Picture
                                    </h3>

                                    <button type="button" id="remove-avatar-btn"
                                        class="text-sm font-medium text-error hover:underline transition-colors {{ auth()->user()->profile_picture ? '' : 'hidden' }}">
                                        Remove
                                    </button>
                                </div>

                                <p class="text-metadata text-secondary">
                                    PNG or JPEG, max 1MB
                                </p>

                                <input id="profile_picture" name="profile_picture" type="file"
                                    accept="image/png,image/jpeg" class="hidden">
                                <input type="hidden" name="remove_profile_picture" id="remove_profile_picture"
                                    value="0">
                            </div>
                        </div>
                        <!-- Form Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-2">
                                <label class="font-ui-label text-ui-label text-on-surface-variant font-medium">Full
                                    Name</label>
                                <input
                                    class="w-full border border-outline-variant rounded-lg px-4 py-3 focus:border-primary focus:ring-1 focus:ring-primary transition-all outline-none font-body-md text-body-md bg-white"
                                    name="name" type="text" value="{{ old('name', auth()->user()->name) }}" />
                            </div>
                            <div class="flex flex-col gap-2">
                                <label
                                    class="font-ui-label text-ui-label text-on-surface-variant font-medium">Email</label>
                                <input
                                    class="w-full border border-outline-variant rounded-lg px-4 py-3 focus:border-primary focus:ring-1 focus:ring-primary transition-all outline-none font-body-md text-body-md bg-white"
                                    name="email" type="email" value="{{ old('email', auth()->user()->email) }}" />
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="font-ui-label text-ui-label text-on-surface-variant font-medium">Bio</label>
                            <textarea
                                class="w-full border border-outline-variant rounded-lg px-4 py-3 focus:border-primary focus:ring-1 focus:ring-primary transition-all outline-none font-body-md text-body-md bg-white resize-none"
                                name="bio" rows="4">{{ old('bio', auth()->user()->bio) }}</textarea>
                            <!-- Actions -->
                            <div class="pt-8 border-t border-outline-variant flex justify-end gap-4">
                                <button
                                    class="px-6 py-3 border border-on-background font-ui-button text-ui-button rounded-lg hover:bg-surface-container transition-all active:scale-95"
                                    type="reset">Cancel</button>
                                <button
                                    class="px-6 py-3 bg-primary-container text-on-primary font-ui-button text-ui-button rounded-lg hover:opacity-90 transition-all active:scale-95 shadow-lg shadow-primary/20"
                                    type="submit">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    @if ($errors->updateProfileInformation->any())
        <x-alerts.toastr icon="error" status="{{ $errors->updateProfileInformation->first() }}" />
    @endif
    @push('scripts')
        <script src="{{ asset('assets/profile.js') }}"></script>
    @endpush
</x-layouts.main-layout>
