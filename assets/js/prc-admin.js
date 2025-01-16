jQuery(document).ready(function ($) {
    $('#prc-toggle-switch').change(function () {
        var newStatus = $(this).prop('checked') ? 'true' : 'false';

        $.post(
            prcToggle.ajaxUrl,
            {
                action: 'prc_toggle_plugin_status',
                security: prcToggle.security,
                status: newStatus,
            },
            function (response) {
                if (response.success) {
                    location.reload(); // Optionally reload the page to reflect changes
                } else {
                    alert('Error: ' + response.data);
                }
            }
        );
    });
});
