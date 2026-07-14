const profilePictureInput = document.querySelector('#profile_picture');
const profilePicturePreview = document.querySelector('#profile-picture-preview');
const removeProfilePictureInput = document.querySelector('#remove_profile_picture');
const removeAvatarBtn = document.querySelector('#remove-avatar-btn');

if (profilePictureInput && profilePicturePreview && removeProfilePictureInput && removeAvatarBtn) {
    const defaultAvatar = profilePicturePreview.dataset.defaultAvatar;

    profilePictureInput.addEventListener('change', ({ target }) => {
        const file = target.files[0];

        if (!file) return;

        profilePicturePreview.src = URL.createObjectURL(file);
        removeProfilePictureInput.value = '0';
        removeAvatarBtn.classList.remove('hidden');
    });

    removeAvatarBtn.addEventListener('click', () => {
        profilePicturePreview.src = defaultAvatar;
        profilePictureInput.value = '';
        removeProfilePictureInput.value = '1';
        removeAvatarBtn.classList.add('hidden');
    });

    // Handle form reset
    const form = profilePictureInput.closest('form');
    if (form) {
        const initialSrc = profilePicturePreview.src;
        const initialRemoveVal = removeProfilePictureInput.value;
        const initialBtnHidden = removeAvatarBtn.classList.contains('hidden');

        form.addEventListener('reset', () => {
            profilePicturePreview.src = initialSrc;
            removeProfilePictureInput.value = initialRemoveVal;
            if (initialBtnHidden) {
                removeAvatarBtn.classList.add('hidden');
            } else {
                removeAvatarBtn.classList.remove('hidden');
            }
        });
    }
}

const fileInput = document.getElementById('cover_image');
const preview = document.getElementById('cover-image-preview');

if (fileInput && preview) {
    fileInput.addEventListener('change', function () {
        if (this.files[0]) {
            preview.src = URL.createObjectURL(this.files[0]);
            preview.classList.remove('hidden');
        }
    });
}