// Sidebar Toggle
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const mainContent = document.querySelector('.main-content');

    // Toggle sidebar on button click
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
            sidebar.classList.toggle('collapsed');
        });
    }

    // Close sidebar when clicking on a link
    const sidebarLinks = document.querySelectorAll('.sidebar-menu-link');
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('show');
                sidebar.classList.add('collapsed');
            }
        });
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (window.innerWidth <= 768) {
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickOnToggle = sidebarToggle.contains(event.target);

            if (!isClickInsideSidebar && !isClickOnToggle && sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
                sidebar.classList.add('collapsed');
            }
        }
    });

    // Set active menu item based on current page
    const currentHalaman = getUrlParameter('halaman');
    if (currentHalaman) {
        document.querySelectorAll('.sidebar-menu-link').forEach(link => {
            const href = link.getAttribute('href');
            if (href.includes(currentHalaman)) {
                link.classList.add('active');
            }
        });
    } else {
        // If no halaman parameter, mark home as active
        document.querySelectorAll('.sidebar-menu-link').forEach(link => {
            if (link.getAttribute('href') === '?' || link.getAttribute('href').includes('?')) {
                link.classList.add('active');
            }
        });
    }
});

// Get URL parameter
function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    const regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    const results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
}
