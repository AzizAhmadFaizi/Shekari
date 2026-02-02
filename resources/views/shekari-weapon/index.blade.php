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
        <div class="table-responsive">

            <table class="datatables-ajax table">
                <thead class="table-dark">
                    <tr>
                        <th>شماره</th>
                        <th>اسم دری</th>
                        {{-- <th>اسم انگلیسی</th> --}}
                        <th>ثبت</th>
                        <th>لوگو</th>
                        <th>حالت</th>
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
    <div class="modal modal-slide-in fade pop_up_modal" id="modals-slide-in">
        <div class="modal-dialog sidebar-xl">
            <form action="{{ route('shekari-weapon-store') }}" id="shekari_weapon_store_form" method="POST"
                class="add-new-record modal-content pt-0">
                @csrf
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="presidentModalLabel">ثبت تفنگ شکاری</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="row">
                        <div class="mb-1 col-sm-12 col-md-3">
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
                        <div class="mb-1 col-sm-12 col-md-3">
                            <label class="mb-1">تاریخ وارده</label>
                            <input type="text" class="form-control farsi-date-picker" id="hijri_warada_date"
                                name="hijri_warada_date" autocomplete="off" />
                            <div class="invalid-feedback hijri_warada_date_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-3">
                            <label class="mb-1">تاریخ مکتوب</label>
                            <input type="text" class="form-control farsi-date-picker" id="maktoob_date"
                                name="maktoob_date" autocomplete="off" />
                            <div class="invalid-feedback maktoob_date_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-3">
                            <label class="mb-1">نمبر مکتوب</label>
                            <input type="number" class="form-control" id="maktoob_number" name="maktoob_number"
                                autocomplete="off" />
                            <div class="invalid-feedback maktoob_number_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-3">
                            <label class="mb-1">نمبر انوایس</label>
                            <input type="number" class="form-control" id="invoice_number" name="invoice_number"
                                autocomplete="off" />
                            <div class="invalid-feedback invoice_number_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-3">
                            <label class="mb-1">نمبر ایروبل</label>
                            <input type="number" class="form-control" id="airo_bill_number" name="airo_bill_number"
                                autocomplete="off" />
                            <div class="invalid-feedback airo_bill_number_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-3">
                            <label class="mb-1">راه وارداتی (بندر)</label>
                            <input type="text" class="form-control" id="warada_way" name="warada_way"
                                autocomplete="off" />
                            <div class="invalid-feedback warada_way_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-3">
                            <label class="mb-1">تعرفه</label>
                            <input type="text" class="form-control" id="tarofa" name="tarofa" autocomplete="off" />
                            <div class="invalid-feedback tarofa_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-3">
                            <label class="mb-1">نوع</label>
                            <input type="text" class="form-control" id="type" name="type" autocomplete="off" />
                            <div class="invalid-feedback type_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-3">
                            <label class="mb-1">تعداد</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" autocomplete="off" />
                            <div class="invalid-feedback quantity_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-3">
                            <label class="mb-1">فیس</label>
                            <input type="number" class="form-control" id="fess" name="fess"
                                autocomplete="off" />
                            <div class="invalid-feedback fess_error"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
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
    @include('organization.general_scripts')
    @include('organization.dari-datepicker')
    @include('organization.blockui')
    <script>
        // ================================
        //   show model
        // ================================
        $('.show_modal').click(function() {
            $('.pop_up_modal').modal('show');
            $('#shekari_weapon_store_form')[0].reset();
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
            input.placeholder = 'Enter Serial Number';

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
    </script>
@endsection
