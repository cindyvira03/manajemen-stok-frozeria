/* ===== SEARCH INPUT ===== */
const searchInput = document.getElementById('searchInput');

searchInput?.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        filterTable();
    }
});

/* ===== FILTER TABLE ===== */
function filterTable() {
const search = document.getElementById('searchInput')?.value ?? '';
const kategori = document.getElementById('filterKategori')?.value ?? '';

const url = new URL(window.location.href);

// SEARCH
if (search) {
    url.searchParams.set('search', search);
} else {
    url.searchParams.delete('search');
}

// KATEGORI
if (kategori) {
    url.searchParams.set('kategori_id', kategori);
} else {
    url.searchParams.delete('kategori_id');
}

// reset pagination
url.searchParams.delete('page');

window.location.href = url.toString();
}

/* ===== MODAL ===== */
function openDeleteModal(url, nama) {
    const text = document.getElementById('deleteText');
    const form = document.getElementById('deleteForm');

    text.innerHTML = `Data <b>${nama}</b> akan dihapus permanen dari sistem. Tindakan ini tidak dapat dibatalkan.`;
    form.action = url;

    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

/* ===== CLOSE ALERT ===== */
function closeAlert(btn) {
const alert = btn.parentElement;
alert.style.opacity = '0';
setTimeout(() => alert.remove(), 300);
}

// 🔥 auto hide 3 detik
setTimeout(() => {
document.querySelectorAll('.alert').forEach(alert => {
    alert.style.opacity = '0';
    setTimeout(() => alert.remove(), 300);
});
}, 3000);

/* ===== FORMAT RUPIAH ===== */
function formatRupiah(input) {
let value = input.value.replace(/\D/g, '');

if (!value) {
    input.value = '';
    return;
}

input.value = new Intl.NumberFormat('id-ID').format(value);
}

['hargaJual', 'hargaBeli'].forEach(id => {
const el = document.getElementById(id);
if (el) {
    el.addEventListener('input', function() {
        formatRupiah(this);
    });
}
});
