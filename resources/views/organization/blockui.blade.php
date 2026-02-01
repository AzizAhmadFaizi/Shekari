<script>
    var formSection = $('.form-block'),
        formBlockOverlay = $('.btn-form-block')

    if (formBlockOverlay.length && formSection.length) {
        formBlockOverlay.on('click', function() {
            formSection.block({
                message: '<div class="spinner-border text-primary" role="status"></div>',
                css: {
                    backgroundColor: 'transparent',
                    border: '0'
                },
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8
                }
            });
        });
    }
</script>
