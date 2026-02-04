@extends('layouts.app')

@section('content')
    <style>
        .modal-dialog {
            width: 100% !important;
        }
    </style>
    <div class="card-header border-bottom">
        <h4 class="card-title"> لیست تفنګ های شکاری</h4>
        @if (auth()->user()->role_id == 2)
            <button class="btn btn-primary show_modal"><span data-feather='plus'></span> ثبت تفنگ جدید</button>
        @endif
    </div>
    <div class="card m-1">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label>شرکت ها</label>
                    <select id="search_organization_id" class="form-control">
                        <option value="">شرکت را انتخاب نمایید</option>
                        @foreach ($organizations as $item)
                            <option value="{{ $item->id }}">{{ $item->name_dr }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label>شماره سریال</label>
                    <input type="text" id="search_serial_number" class="form-control" placeholder="شماره سریال">
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary mt-2 remove_search_btn" data-route="shekari-weapons">
                        <span data-feather='refresh-cw'></span> پاک کردن</button>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="datatables-ajax table">
                <thead class="table-dark">
                    <tr>
                        <th>شماره</th>
                        <th>اسم شرکت</th>
                        <th>تاریخ وارده</th>
                        <th>تاریخ مکتوب</th>
                        <th>نمبر مکتوب</th>
                        <th>تعداد</th>
                        <th>عواید</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>

    {{-- create modal --}}
    <div class="modal fade pop_up_modal" id="modals-slide-in" {{-- data-bs-backdrop="static" --}}>
        <div class="modal-dialog modal-lg">
            <form action="{{ route('shekari-weapon-store') }}" id="shekari_weapon_store_form" method="POST"
                class="add-new-record modal-content pt-0">
                @csrf
                <input type="hidden" class="form-control" name="shekari_weapon_id" id="shekari_weapon_id" />
                <div class="modal-header mb-1">
                    <h3 class="modal-title" id="shekariWeaponModalLabel"></h3>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="row">
                        <div class="mb-1 col-sm-12 col-md-4">
                            <label class="mb-1">شرکت ها</label>
                            <select name="organization_id" id="organization_id" pro-type="current"
                                class="form-control select2 province btn-form-block">
                                <option value="">شرکت را انتخاب نمایید</option>
                                @foreach ($organizations as $item)
                                    <option value="{{ $item->id }}">{{ $item->name_dr }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback organization_id_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-4">
                            <label class="mb-1">تاریخ وارده</label>
                            <input type="text" class="form-control farsi-date-picker" id="hijri_warada_date"
                                name="hijri_warada_date" autocomplete="off" />
                            <div class="invalid-feedback hijri_warada_date_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-4">
                            <label class="mb-1">تاریخ مکتوب</label>
                            <input type="text" class="form-control farsi-date-picker" id="maktoob_date"
                                name="maktoob_date" autocomplete="off" />
                            <div class="invalid-feedback maktoob_date_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-4">
                            <label class="mb-1">نمبر مکتوب</label>
                            <input type="number" class="form-control" id="maktoob_number" name="maktoob_number"
                                autocomplete="off" />
                            <div class="invalid-feedback maktoob_number_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-4">
                            <label class="mb-1">نمبر انوایس</label>
                            <input type="number" class="form-control" id="invoice_number" name="invoice_number"
                                autocomplete="off" />
                            <div class="invalid-feedback invoice_number_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-4">
                            <label class="mb-1">نمبر ایروبل</label>
                            <input type="number" class="form-control" id="airo_bill_number" name="airo_bill_number"
                                autocomplete="off" />
                            <div class="invalid-feedback airo_bill_number_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-4">
                            <label class="mb-1">راه وارداتی (بندر)</label>
                            <input type="text" class="form-control" id="warada_way" name="warada_way"
                                autocomplete="off" />
                            <div class="invalid-feedback warada_way_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-4">
                            <label class="mb-1">تعرفه</label>
                            <input type="text" class="form-control" id="tarofa" name="tarofa"
                                autocomplete="off" />
                            <div class="invalid-feedback tarofa_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-4">
                            <label class="mb-1">نوع</label>
                            <input type="text" class="form-control" id="type" name="type"
                                autocomplete="off" />
                            <div class="invalid-feedback type_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-4">
                            <label class="mb-1">تعداد</label>
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                autocomplete="off" />
                            <div class="invalid-feedback quantity_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-4">
                            <label class="mb-1">فیس</label>
                            <input type="number" class="form-control" id="fess" name="fess" value="1000" readonly autocomplete="off" />
                            <div class="invalid-feedback fess_error"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="col-sm-12 d-flex mb-2">
                                    <button type="button" id="addSerialBtn" class="btn btn-success btn-sm">
                                        <span class="fa fa-plus"></span> اضافه شماره سریال
                                    </button>
                                </div>
                                <!-- Container for serial number inputs -->
                                <div class="col-sm-12" id="serialNumbersContainer"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-1 col-sm-12">
                                <label class="mb-1 w-100">ضمایم</label>
                                <input type="file" class="form-control-file" name="attachment">
                                <div class="invalid-feedback attachment_error"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-1 col-sm-12 col-md-4">
                                <button type="submit"
                                    class="btn btn-primary btn-sm me-1 btn-form-block to_hide fw-bold"><span
                                        class="fa fa-save "></span></button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><span
                                        class="fa fa-times"></span></button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    {{-- end create modal --}}
@endsection
@section('scripts')
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
    @include('organization.blockui')
    @include('organization.dari-datepicker')
    <script>
        // ================================
        //   select2 scripts
        // ================================
        $('.select2').select2({
            dir: "rtl",
            dropdownParent: $("#modals-slide-in"),
        });

        // ================================
        //   show model
        // ================================
        $('.show_modal').click(function() {
            $('#shekariWeaponModalLabel').text('ثبت تفنگ شکاری');
            $('#shekari_weapon_store_form')[0].reset();
            $('#serialNumbersContainer').empty();
            $('input').prop('disabled', false);
            $('select').prop('disabled', false);
            $('#addSerialBtn').prop('disabled', false);
            $('.delete_serial_button').prop('disabled', false);
            $('.pop_up_modal').modal('show');
        });

        // ======================================================
        //  handle dynamic serial number inputs based on quantity
        // ======================================================
        const serialContainer = document.getElementById('serialNumbersContainer');
        const addBtn = document.getElementById('addSerialBtn');

        // Array to store serial numbers
        let serialNumbersArray = [];

        // Function to render array values (optional, for debugging)
        function updateSerialNumbersArray() {
            const inputs = serialContainer.querySelectorAll('input');
            serialNumbersArray = [];
            inputs.forEach(input => {
                if (input.value.trim() !== '') {
                    serialNumbersArray.push(input.value.trim());
                }
            });
        }
        // Add new serial input
        addBtn.addEventListener('click', function() {
            const div = document.createElement('div');
            div.classList.add('mb-1', 'd-flex', 'align-items-center');

            // Input
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'serial_numbers[]'; // <-- array format
            input.classList.add('form-control', 'me-2');
            input.placeholder = 'شماره سریال';

            // Delete button
            const delBtn = document.createElement('button');
            delBtn.type = 'button';
            delBtn.classList.add('btn', 'btn-danger', 'btn-sm');
            delBtn.innerText = 'حذف';

            delBtn.addEventListener('click', function() {
                div.remove();
            });

            // Append
            div.appendChild(input);
            div.appendChild(delBtn);
            serialContainer.appendChild(div);
        });


        // ======================================================
        //  submit (store) form ajax
        // ======================================================
        var submit_btn = false;
        $(document).on('submit', '#shekari_weapon_store_form', function(event) {
            event.preventDefault();
            if (!submit_btn) {
                data = new FormData($("#shekari_weapon_store_form")[0]);
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'post',
                    data: data,
                    dataType: 'html',
                    cache: false,
                    processData: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    beforeSend: function() {
                        submit_btn = true;
                    },
                    success: function(data) {
                        if (data == true) {
                            $('.load_btn[data-route="presidents"]').click();
                            $('.form-block').unblock();
                            submit_btn = false;
                            success_msg($('input[name=president_id]').val() == 0 ? "موفقانه ثبت شد" :
                                "موفقانه تغییر نمود");
                            $('.datatables-ajax').DataTable().ajax.reload();
                            $('.pop_up_modal').modal('hide');
                        } else {
                            $('.form-block').unblock();
                            var response = JSON.parse(data);
                            $.each(response, function(prefix, val) {
                                $('div.' + prefix + '_error').text(val[0]);
                                $("select[name=" + prefix + "]").parent().addClass(
                                    'is-invalid');
                                $("select[name=" + prefix + "]").addClass('is-invalid');
                                $("input[name=" + prefix + "]").addClass('is-invalid');
                            });
                        }
                        submit_btn = false;
                    },
                    error: function() {
                        $('.form-block').unblock();
                        error_msg("لطفا دوباره کوشش نمایید");
                        submit_btn = false;
                    }
                });
            }
        });

        // ======================================================
        //  ajax-datatable
        // ======================================================
        $(function() {

            let table = $('.datatables-ajax').DataTable({

                processing: true,
                serverSide: true,
                searching: false,
                lengthChange: false,
                bInfo: false,

                ajax: {
                    url: "{{ route('shekari-weapons') }}",
                    type: "GET",
                    data: function(d) {
                        d.search_organization_id = $('#search_organization_id').val();
                        d.search_serial_number = $('#search_serial_number').val();
                    }
                },
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
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'hijri_warada_date'
                    },
                    {
                        data: 'maktoob_date'
                    },
                    {
                        data: 'maktoob_number'
                    },
                    {
                        data: 'quantity'
                    },
                    {
                        data: 'revenue'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            /*
            |------------------------------------------
            | Reload when filters change
            |------------------------------------------
            */
            $('#search_organization_id').on('change', function() {
                table.draw();
            });
            $('#search_serial_number').on('keyup', function() {
                table.draw();
            });

        });


        // ======================================================
        //  edit button click
        // ======================================================

        $(document).on('click', '.edit_btn', function() {

            $('input').prop('disabled', false);
            $('select').prop('disabled', false);
            $('#addSerialBtn').prop('disabled', false);
            $('.delete_serial_button').prop('disabled', false);

            let btn = $(this);
            $('#shekariWeaponModalLabel').text('ویرایش تفنگ شکاری');
            // Basic fields
            $('#shekari_weapon_id').val(btn.data('id'));
            $('#organization_id').val(btn.data('organization')).trigger('change');
            $('#hijri_warada_date').val(btn.data('hijri'));
            $('#maktoob_date').val(btn.data('maktoobdate'));
            $('#maktoob_number').val(btn.data('maktoobnumber'));
            $('#invoice_number').val(btn.data('invoice'));
            $('#airo_bill_number').val(btn.data('airo'));
            $('#warada_way').val(btn.data('way'));
            $('#tarofa').val(btn.data('tarofa'));
            $('#type').val(btn.data('type'));
            $('#quantity').val(btn.data('quantity'));
            $('#fess').val(btn.data('fess'));

            // Attachment
            if (btn.data('attachment')) {
                let fileHtml =
                    `<a class="btn btn-sm btn-info" href="${btn.data('attachment')}" target="_blank">مشاهده فایل فعلی</a>`;
                $('input[name=attachment]').next('.current-attachment').remove(); // remove previous if any
                $('input[name=attachment]').after(`<div class="current-attachment mt-1">${fileHtml}</div>`);
            } else {
                $('input[name=attachment]').next('.current-attachment').remove();
            }

            // Serial numbers
            const serialContainer = $('#serialNumbersContainer');
            serialContainer.empty();
            let serials = btn.data('serials');
            if (typeof serials === "string") {
                serials = JSON.parse(serials); // parse JSON string
            }

            // Add existing serials with delete button
            if (serials.length > 0) {
                serials.forEach((s, index) => {
                    const div = $('<div class="mb-1 d-flex align-items-center"></div>');
                    const input = $(
                        `<input type="text" name="serial_numbers[]" class="form-control me-2" value="${s}" placeholder="شماره سریال ${index+1}">`
                    );
                    const delBtn = $('<button type="button" class="btn btn-danger btn-sm">حذف</button>');

                    delBtn.on('click', function() {
                        div.remove();
                    });

                    div.append(input).append(delBtn);
                    serialContainer.append(div);
                });
            }

            // Show modal
            $('.pop_up_modal').modal('show');
        });

        // ======================================================
        //  show button click
        // ======================================================

        $(document).on('click', '.show_btn', function() {
            let btn = $(this);

            $('#shekariWeaponModalLabel').text('نمایش تفنگ شکاری');

            // Basic fields
            $('#shekari_weapon_id').val(btn.data('id'));
            $('#organization_id').val(btn.data('organization')).trigger('change');
            $('#hijri_warada_date').val(btn.data('hijri'));
            $('#maktoob_date').val(btn.data('maktoobdate'));
            $('#maktoob_number').val(btn.data('maktoobnumber'));
            $('#invoice_number').val(btn.data('invoice'));
            $('#airo_bill_number').val(btn.data('airo'));
            $('#warada_way').val(btn.data('way'));
            $('#tarofa').val(btn.data('tarofa'));
            $('#type').val(btn.data('type'));
            $('#quantity').val(btn.data('quantity'));
            $('#fess').val(btn.data('fess'));

            // Attachment
            if (btn.data('attachment')) {
                let fileHtml =
                    `<a class="btn btn-sm btn-info" href="${btn.data('attachment')}" target="_blank">مشاهده فایل فعلی</a>`;
                $('input[name=attachment]').next('.current-attachment').remove(); // remove previous if any
                $('input[name=attachment]').after(`<div class="current-attachment mt-1">${fileHtml}</div>`);
            } else {
                $('input[name=attachment]').next('.current-attachment').remove();
            }

            // Serial numbers
            const serialContainer = $('#serialNumbersContainer');
            serialContainer.empty();
            let serials = btn.data('serials');
            if (typeof serials === "string") {
                serials = JSON.parse(serials); // parse JSON string
            }

            // Add existing serials with delete button
            if (serials.length > 0) {
                serials.forEach((s, index) => {
                    const div = $('<div class="mb-1 d-flex align-items-center"></div>');
                    const input = $(
                        `<input type="text" name="serial_numbers[]" class="form-control me-2" value="${s}" placeholder="شماره سریال ${index+1}">`
                    );
                    const delBtn = $(
                        '<button type="button" class="btn btn-danger btn-sm delete_serial_button">حذف</button>'
                    );

                    delBtn.on('click', function() {
                        div.remove();
                    });

                    div.append(input).append(delBtn);
                    serialContainer.append(div);
                });
            }

            $('input').prop('disabled', true);
            $('select').prop('disabled', true);
            $('#addSerialBtn').prop('disabled', true);
            $('.delete_serial_button').prop('disabled', true);
            // Show modal
            $('.pop_up_modal').modal('show');
        });

        // ======================================================
        //  delete button click
        // ======================================================

        $(document).on('click', '.delete_btn', function() {
            Swal.fire({
                title: "آیا از حذف این مورد اطمینان دارید؟",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "نخیر",
                confirmButtonText: "بلی",
            }).then((result) => {
                if (result.value == true) {
                    $.get("{{ route('shekari-weapon-delete') }}/" + $(this).attr('data-id'), function(
                        data) {
                        if (data) {
                            success_msg("موفقیت حذف گردید");
                            $('.datatables-ajax').DataTable().ajax.reload();
                        }
                    }).fail(function(error) {
                        error_msg("لطفا دوباره کوشش نمایید");
                    });
                }
            });
        });

        // ======================================================
        //  clear filters button click
        // ======================================================
        $(document).on('click', '.remove_search_btn', function() {

            $('input').prop('disabled', false);
            $('select').prop('disabled', false);
            let route = $(this).data('route');
            $('#' + 'search_organization_id').val('');
            $('#' + 'search_serial_number').val('');
            $('.datatables-ajax').DataTable().ajax.reload();
        });
    </script>
@endsection
