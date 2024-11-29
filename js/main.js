// Fungsi untuk menutup sidebar
function closeSidebar() {
    document.querySelector('.sidebar-off-canvas').classList.remove('open');
    document.getElementById('overlay').classList.remove('show');
}

// Event listener untuk tombol toggle sidebar
document.getElementById('btnToggle').addEventListener('click', function() {
    document.querySelector('.sidebar-off-canvas').classList.add('open');
    document.getElementById('overlay').classList.add('show');
});

// Event listener untuk tombol close sidebar
document.getElementById('btnClose').addEventListener('click', closeSidebar);

// Event listener untuk overlay
document.getElementById('overlay').addEventListener('click', closeSidebar);

// Event listener untuk semua elemen <li> di sidebar
document.querySelectorAll('.sidebar-content .nav-item').forEach(function(item) {
    item.addEventListener('click', closeSidebar);
});



// SCROLL PAGE
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault(); 
        const targetId = this.getAttribute('href').substring(1); 
        const targetSection = document.getElementById(targetId); 
        if (targetSection) {
            const offset = 130; 
            const targetPosition = targetSection.offsetTop - offset;
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth' 
            });
        }
    });
});