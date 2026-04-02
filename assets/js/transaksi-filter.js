document.addEventListener("DOMContentLoaded", function () {

    const searchInput = document.querySelector("input[name='search']");
    const rows = document.querySelectorAll(".transaksi-item");
    const emptyMessage = document.getElementById("empty-transaksi");

    function filterTransaksi() {

        const keyword = searchInput.value.toLowerCase();
        let visibleCount = 0;

        rows.forEach(row => {

            const id = row.dataset.id;
            const nama = row.dataset.nama;
            const judul = row.dataset.judul;
            const status = row.dataset.status;

            const match =
                id.includes(keyword) ||
                nama.includes(keyword) ||
                judul.includes(keyword) ||
                status.includes(keyword);

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

    searchInput.addEventListener("keyup", filterTransaksi);

});