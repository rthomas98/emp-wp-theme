jQuery(document).ready(function($) {
    // Initialize Lucide icons
    if (window.lucide) {
        window.lucide.createIcons();
    }

    // Re-initialize icons after AJAX content loads
    $(document).on('ajaxComplete', function() {
        if (window.lucide) {
            window.lucide.createIcons();
        }
    });
});
