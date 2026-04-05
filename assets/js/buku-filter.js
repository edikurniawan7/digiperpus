document.addEventListener("DOMContentLoaded", function () {

    const searchInput = document.querySelector("input[name='search']");
    const kategoriSelect = document.querySelector("select[name='kategori']");
    const bukuItems = document.querySelectorAll(".buku-item");
    const emptyMessage = document.getElementById("empty-message");

    function filterBuku() {
        const keyword = searchInput.value.toLowerCase();
        const kategori = kategoriSelect.value;

        let visibleCount = 0;

        bukuItems.forEach(item => {
            const judul = item.dataset.judul;
            const pengarang = item.dataset.pengarang;
            const kategoriId = item.dataset.kategori;

            const matchKeyword =
                judul.includes(keyword) ||
                pengarang.includes(keyword);

            const matchKategori =
                kategori === "" || kategoriId === kategori;

            if (matchKeyword && matchKategori) {
                item.style.display = "flex";
                visibleCount++;
            } else {
                item.style.display = "none";
            }
        });

        // Tampilkan pesan jika tidak ada hasil
        if (visibleCount === 0) {
            emptyMessage.classList.remove("hidden");
        } else {
            emptyMessage.classList.add("hidden");
        }
    }

    searchInput.addEventListener("keyup", filterBuku);
    kategoriSelect.addEventListener("change", filterBuku);

});