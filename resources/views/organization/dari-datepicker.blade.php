<link rel="stylesheet" href="{{ asset('datepicker/bootstrap-datepicker.css') }}">
<script src="{{ asset('datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('datepicker/bootstrap-datepicker.fa.min.js') }}"></script>
<script>
    $('.farsi-date-picker').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: "yy-mm-dd"
    });
</script>
