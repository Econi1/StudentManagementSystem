document.addEventListener('DOMContentLoaded', function() {
    // Highlight the active link in the sidebar
    const sidebarLinks = document.querySelectorAll('.sidebar a');
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function() {
            sidebarLinks.forEach(link => link.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Confirm deletion with custom modal
    const deleteLinks = document.querySelectorAll('.actions a.delete');
    deleteLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const confirmation = confirm('Are you sure you want to delete this student?');
            if (confirmation) {
                window.location.href = this.href;
            }
        });
    });
});