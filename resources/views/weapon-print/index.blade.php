@extends('layouts.app')

@section('content')
    <div class="card-header border-bottom">
        <h4 class="card-title">لست کمپنی ها</h4>
    </div>
    <div class="card m-1">
        <div class="table-responsive">

            <table class="datatables-ajax table">
                <thead class="table-dark">
                    <tr>
                        <th>شماره</th>
                        <th>کمپنی</th>
                        <th>لوگو</th>
                        <th>مجموع سلاح</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).on('click', '.printed_btn', function() {
            Swal.fire({
                title: "چاپ شده ؟",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "نخیر",
                confirmButtonText: "بلی",
            }).then((result) => {
                if (result.value == true) {
                    $.get("{{ route('weapon-printed') }}/" + $(this).attr('data-id'), function(data) {
                        if (data) {
                            success_msg("موفقانه چاپ شد");
                            $('.datatables-ajax').DataTable().ajax.reload();
                        }
                    }).fail(function(error) {
                        error_msg("لطفا دوباره کوشش نمایید");
                    });
                }
            });
        });
        $('.datatables-ajax').dataTable({
            "bInfo": false,
            "lengthChange": false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('show-weapon-to-print') }}",
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
            columns: [{
                    "data": 'DT_RowIndex'
                },
                {
                    "data": 'company_details'
                },
                {
                    "data": 'logo_details'
                },
                {
                    "data": 'total_weapons_to_print'
                },
                {
                    "data": 'action'
                }
            ]
        });
    </script>
@endsection
