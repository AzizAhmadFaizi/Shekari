<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script>
    $('.datatables-ajax').dataTable({
        "bInfo": false,
        "lengthChange": false,
        processing: true,
        language: {
            paginate: {
                previous: '&nbsp;',
                next: '&nbsp;'
            },
            "sSearch": "جستجو",
            "sEmptyTable": "جدول خالی است",
            "zeroRecords": "دیتا موجود نیست",
            "processing": "در حال پروسس",
        },
    });
    
    $('.select2').select2({
        dir: "rtl",
        dropdownParent: $("#modals-slide-in"),
    });

    $(document).on('keyup', 'input', function(event) {
        $(this).removeClass('is-invalid');
    });
    $(document).on('keyup', 'textarea', function(event) {
        $(this).removeClass('is-invalid');
    });

    $(document).on('change', 'input', function(event) {
        $(this).removeClass('is-invalid');
    });

    $(document).on('change', 'select', function(event) {
        $(this).removeClass('is-invalid');
        $(this).parent().removeClass('is-invalid');
    });
</script>