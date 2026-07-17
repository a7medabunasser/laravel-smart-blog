function previewCover(input) {
            const file = input.files[0];
            if (file) {
                const url = URL.createObjectURL(file);
                const box = document.getElementById('cover-preview-box');
                const placeholder = document.getElementById('cover-placeholder');

                box.style.backgroundImage = `url('${url}')`;

                placeholder.classList.add('hidden', 'group-hover:flex', 'absolute', 'inset-0', 'bg-black/40', 'text-white',
                    'w-full', 'h-full');

                const icon = placeholder.querySelector('.material-symbols-outlined');
                const text = placeholder.querySelector('.font-metadata');
                if (icon) {
                    icon.classList.remove('text-secondary');
                    icon.classList.add('text-white');
                }
                if (text) {
                    text.classList.remove('text-secondary');
                    text.classList.add('text-white');
                    text.textContent = 'Change cover photo';
                }
            }
        }

document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('tag-text-input');
    const preview = document.getElementById('tag-preview-container');

    if (!input || !preview) return;

    // Hidden input submitted with the form
    const hidden = document.createElement('input');
    hidden.type = 'hidden';
    hidden.name = 'tags';
    hidden.value = input.value;
    input.parentNode.appendChild(hidden);

    // Prevent submitting the visible input
    input.removeAttribute('name');
    input.value = '';

    // Existing tags
    let tags = hidden.value
        ? hidden.value.split(',').map(tag => tag.trim()).filter(Boolean)
        : [];

    function updateHidden() {
        hidden.value = tags.join(', ');
    }

    function createBadge(tag) {
        const badge = document.createElement('span');
        badge.className =
            'tag-badge bg-primary-fixed text-on-primary-fixed px-3 py-1 rounded-full font-metadata text-metadata flex items-center gap-1 transition-all duration-200 hover:bg-primary-fixed-dim';

        const text = document.createElement('span');
        text.textContent = tag;

        const remove = document.createElement('span');
        remove.className =
            'material-symbols-outlined text-[14px] cursor-pointer tag-close-btn';
        remove.textContent = 'close';

        badge.append(text, remove);
        preview.appendChild(badge);
    }

    // Clear server-rendered badges to avoid duplicates and ensure sync
    preview.innerHTML = '';

    // Render initial badges
    tags.forEach(tag => createBadge(tag));

    // Remove tag listener (delegated for all badges)
    preview.addEventListener('click', e => {
        if (!e.target.classList.contains('tag-close-btn')) return;

        const badge = e.target.closest('.tag-badge');
        if (!badge) return;

        const tag = badge.firstElementChild.textContent.trim();

        badge.remove();
        tags = tags.filter(t => t.toLowerCase() !== tag.toLowerCase());
        updateHidden();
    });

    function addTag(value) {
        const tag = value.trim();

        if (!tag) return;

        // Prevent duplicates
        if (tags.some(t => t.toLowerCase() === tag.toLowerCase())) {
            input.value = '';
            return;
        }

        tags.push(tag);
        createBadge(tag);
        updateHidden();

        input.value = '';
    }

    input.addEventListener('keydown', e => {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            addTag(input.value);
        }

        if (e.key === 'Backspace' && !input.value && tags.length) {
            const badges = preview.querySelectorAll('.tag-badge');
            badges[badges.length - 1]?.remove();

            tags.pop();
            updateHidden();
        }
    });
});