<script>
    $(document).ready(function() {
        if (!localStorage.getItem('cookiesAccepted')) {
            $('#cookie-banner').fadeIn().removeClass('hidden');
        }

        $('#accept-cookies').on('click', function() {
            localStorage.setItem('cookiesAccepted', 'true');
            $('#cookie-banner').fadeOut();
        });
    });
</script>
