@props([
    'id',
    'title' => 'Are you sure?',
    'description' => 'This action cannot be undone.',
    'confirmText' => 'Delete',
    'cancelText' => 'Cancel',
    'type' => 'danger',
])

<div id="{{ $id }}"
    class="fixed inset-0 z-50 hidden items-center justify-center p-4 overflow-x-hidden overflow-y-auto" role="dialog"
    aria-modal="true">
    <!-- Backdrop with blur -->
    <div class="fixed inset-0 bg-black/60 transition-opacity backdrop-blur-[2px]"
        onclick="closeConfirmDialog('{{ $id }}', true)"></div>

    <!-- Modal Container -->
    <div class="relative bg-white dark:bg-zinc-900 border border-outline-variant/30 rounded-2xl max-w-md w-full p-6 shadow-2xl transition-all transform scale-95 opacity-0 duration-300 ease-out z-10"
        id="{{ $id }}-content">
        <div class="flex items-start gap-4">
            <!-- Icon -->
            <div
                class="p-3 rounded-full {{ $type === 'danger' ? 'bg-red-50 dark:bg-red-950/30 text-red-600 dark:text-red-400' : 'bg-violet-50 dark:bg-violet-950/30 text-violet-600 dark:text-violet-400' }} shrink-0 flex items-center justify-center">
                <span class="material-symbols-outlined text-2xl">
                    {{ $type === 'danger' ? 'warning' : 'info' }}
                </span>
            </div>

            <!-- Text Content -->
            <div class="flex-1">
                <h3 class="font-headline-md text-xl font-bold text-on-surface mb-2">
                    {{ $title }}
                </h3>
                <p class="text-secondary font-metadata text-metadata leading-relaxed">
                    {{ $description }}
                </p>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-6 flex justify-end gap-3">
            <button type="button"
                class="px-4 py-2.5 border border-outline text-on-surface font-ui-button text-ui-button rounded-lg hover:bg-surface-container transition-all"
                onclick="closeConfirmDialog('{{ $id }}', true)">
                {{ $cancelText }}
            </button>
            <button type="button" id="{{ $id }}-confirm-btn"
                class="px-5 py-2.5 font-ui-button text-ui-button rounded-lg text-white transition-all {{ $type === 'danger' ? 'bg-error hover:bg-error/90 shadow-md shadow-error/20' : 'bg-primary hover:bg-primary/90 shadow-md shadow-primary/20' }}">
                {{ $confirmText }}
            </button>
        </div>
    </div>
</div>

@once
    @push('scripts')
        <script>
            function openConfirmDialog(dialogId, onConfirm) {
                const dialog = document.getElementById(dialogId);
                const content = document.getElementById(dialogId + '-content');
                const confirmBtn = document.getElementById(dialogId + '-confirm-btn');

                if (!dialog || !content) return;

                // Show dialog
                dialog.classList.remove('hidden');
                dialog.classList.add('flex');

                // Trigger reflow
                void dialog.offsetWidth;

                // Transition in
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');

                // Wire confirm action
                confirmBtn.onclick = function() {
                    onConfirm();
                    closeConfirmDialog(dialogId, false);
                };
            }

            function closeConfirmDialog(dialogId, wasCancelled = false) {
                const dialog = document.getElementById(dialogId);
                const content = document.getElementById(dialogId + '-content');

                if (!dialog || !content) return;

                // Transition out
                content.classList.remove('scale-100', 'opacity-100');
                content.classList.add('scale-95', 'opacity-0');

                // Hide wrapper after transition completes
                setTimeout(() => {
                    dialog.classList.remove('flex');
                    dialog.classList.add('hidden');
                }, 300);

                // Show cancellation Toast if applicable
                if (wasCancelled && typeof toastr !== 'undefined') {
                    toastr.info('Action cancelled.');
                }
            }
        </script>
    @endpush
@endonce
