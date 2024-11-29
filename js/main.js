document.getElementById('btnToggle').addEventListener('click', function() {
    // Menambahkan class 'open' ke sidebar dan 'show' ke overlay
    document.querySelector('.sidebar-off-canvas').classList.add('open');
    document.getElementById('overlay').classList.add('show');
});

document.getElementById('btnClose').addEventListener('click', function() {
    // Menghapus class 'open' dari sidebar dan 'show' dari overlay
    document.querySelector('.sidebar-off-canvas').classList.remove('open');
    document.getElementById('overlay').classList.remove('show');
});

// Menambahkan aksi klik pada overlay untuk menutup sidebar
document.getElementById('overlay').addEventListener('click', function() {
    document.querySelector('.sidebar-off-canvas').classList.remove('open');
    document.getElementById('overlay').classList.remove('show');
});


// SCROLL PAGE
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault(); // Mencegah aksi default klik link
        const targetId = this.getAttribute('href').substring(1); // Ambil ID target
        const targetSection = document.getElementById(targetId); // Dapatkan elemen target
        if (targetSection) {
            const offset = 130; // Sesuaikan tinggi offset (tinggi navbar + padding tambahan)
            const targetPosition = targetSection.offsetTop - offset;
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth' // Animasi smooth scrolling
            });
        }
    });
});