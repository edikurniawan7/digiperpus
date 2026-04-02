document.addEventListener("DOMContentLoaded", function () {

    const searchInput = document.querySelector("input[name='search']");
    const rows = document.querySelectorAll(".anggota-item");
    const emptyMessage = document.getElementById("empty-anggota");

    function filterAnggota() {

        const keyword = searchInput.value.toLowerCase();
        let visibleCount = 0;

        rows.forEach(row => {

            const id = row.dataset.id;
            const nama = row.dataset.nama;
            const username = row.dataset.username;

            const match =
                id.includes(keyword) ||
                nama.includes(keyword) ||
                username.includes(keyword);

            if (match) {
                row.style.display = "";
                visibleCount++;
            } else {
                row.style.display = "none";
            }

        });

        if (visibleCount === 0) {
            emptyMessage.classList.remove("hidden");
        } else {
            emptyMessage.classList.add("hidden");
        }

    }

    searchInput.addEventListener("keyup", filterAnggota);

});