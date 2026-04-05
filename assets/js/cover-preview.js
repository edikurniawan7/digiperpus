document.addEventListener('DOMContentLoaded', function () {
    const inputCover = document.getElementById('cover');
    const previewBox = document.getElementById('cover-preview');
    const previewText = document.getElementById('cover-text');

    if (!inputCover || !previewBox) return;

    inputCover.addEventListener('change', function () {
        const file = this.files[0];

        if (!file) return;

        if (!file.type.startsWith('image/')) {
            alert('File harus berupa gambar');
            this.value = '';
            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {
            previewBox.innerHTML = `
                <img src="${e.target.result}"
                     class="w-full h-full object-cover"
                     alt="Preview Cover">
            `;
        };

        reader.readAsDataURL(file);
    });
});
