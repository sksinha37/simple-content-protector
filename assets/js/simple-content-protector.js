jQuery(document).ready(function($) {

    // If the plugin is disabled, skip the rest of the code
    if (prc_vars.plugin_enabled !== 'true') {
        return;
    }

    // Show a custom popup message
    function showPopup(message) {
        var popup = document.createElement('div');
        popup.classList.add('prc-popup');
        popup.innerText = message;
        document.body.appendChild(popup);

        setTimeout(function() {
            document.body.removeChild(popup);
        }, 3000);
    }

    // Prevent right-click, copy, and developer tools (F12, Ctrl+U, etc.)
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
        showPopup('Right-click is disabled on this site.');
    });

    document.addEventListener('copy', function(e) {
        e.preventDefault();
        showPopup('Copying content is not allowed.');
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'C' || e.key === 'J')) || (e.ctrlKey && e.key === 'U') || (e.ctrlKey && e.key === 'u')) {
            e.preventDefault();
            showPopup('Developer tools are disabled on this site.');
        }

        // Disable "Select All" (Ctrl + A) functionality
        if (e.ctrlKey && e.key === 'a') {
            e.preventDefault();
            showPopup('Selecting all content is disabled on this site.');
        }
    });

    // Disable image dragging functionality
    $('img').on('dragstart', function(e) {
        e.preventDefault();
        showPopup('Image dragging is disabled on this site.');
    });

    // Disable text selection using CSS
    $('body').css('user-select', 'none');
});
