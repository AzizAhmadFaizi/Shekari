@extends('layouts.app')

@section('content')
    <style>
        /* .hide_inputs{
            display: none;
        } */
    </style>
    <div class="card-header border-bottom">
        <h4 class="card-title">لست دوکان ها</h4>
        @if (auth()->user()->role_id == 2)
            <button class="btn btn-primary show_modal"><span data-feather='plus'></span> دوکان جدید</button>
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
                        {{-- <th>لوگو</th> --}}
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

    <div class="modal modal-slide-in fade pop_up_modal" id="modals-slide-in">
        <div class="modal-dialog sidebar-xxl form-block">
            <form class="add-new-record modal-content pt-0" id="store_form" method="POST"
                action="{{ route('organization-store') }}">
                @csrf
                <input type="hidden" class="form-control" name="organization_id" />
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="organizationModal"></h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="row">
                        <input type="hidden" name="type" value="2">
                        {{-- <div class="mb-1">
                            <label class="mb-1">نوعیت جواز</label>
                            <select name="type" id="organization_type" class="form-control select2">
                                <option value="">نوعیت جواز را انتخاب نمایید</option>
                                <option value="1">جواز به شرکت</option>
                                <option value="2">جواز به دوکان</option>
                            </select>
                            <div class="invalid-feedback type_error"></div>
                        </div> --}}
                        <div class="mb-1 hide_inputs">
                            <label class="mb-1">اسم</label>
                            <input type="text" class="form-control" name="name_dr" />
                            <div class="invalid-feedback name_dr_error"></div>
                        </div>
                        {{-- <div class="mb-1 hide_inputs">
                            <label class="mb-1">آدرس دفتر مرکزی</label>
                            <input type="text" class="form-control" name="main_office_address"/>
                            <div class="invalid-feedback main_office_address_error"></div>
                        </div>
                        <div class="mb-1 hide_inputs">
                            <label class="mb-1">آدرس دفتر ولایتی</label>
                            <input type="text" class="form-control" name="sub_main_office_address"/>
                            <div class="invalid-feedback sub_main_office_address_error"></div>
                        </div>

                        <div class="mb-1 hide_inputs">
                            <label for="" class="mb-2">لوگو</label>
                            <div class="d-flex">
                                <a href="#" class="me-25">
                                    <img src="{{ asset('user_default.jpg') }}" id="product-img" class="upload-product rounded me-50" alt="product image" height="100" width="100" />
                                </a>
                                <!-- upload and reset button -->
                                <div class="d-flex align-items-end mt-75 ms-1">
                                    <div>
                                        <label for="product-upload" class="btn btn-sm btn-primary mb-75 me-75">انتخاب</label>
                                        <input type="file" id="product-upload" name="image" hidden accept="image/*"/>
                                        <button type="button" id="product-reset" class="btn btn-sm btn-outline-secondary mb-75">حذف</button>
                                        <p class="mb-0">لوگو به فارمت های jpg,jpeg,png باشد</p>
                                    </div>
                                </div>
                                <!--/ upload and reset button -->
                            </div>
                        </div> --}}
                    </div>

                    <button type="submit" class="btn btn-outline-primary btn-sm me-1 btn-form-block"><span
                            data-feather="save"></span></button>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"><span
                            data-feather="x"></span></button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    @include('organization.blockui')
    <script>
        if ($('.upload-product')) {
            var resetImage = $('.upload-product').attr('src');
            $('#product-upload').on('change', function(e) {

                var fileInput = document.getElementById('product-upload');

                var file = fileInput.files[0];
                var totalKB = (file.size / 1024).toFixed(1);

                var filePath = fileInput.value;
                var allowedExtensions = /(\.png|\.jpg|\.jpeg)$/i;
                if (!allowedExtensions.exec(filePath)) {
                    error_msg('Please Select Image with png,jpg,jpeg format');
                    $('#product-upload').val('');
                    $('.upload-product').attr('src', resetImage);
                    return false;
                } else if (totalKB > 5000) {
                    error_msg("Please Select Image less than 5 mb");
                } else {
                    var reader = new FileReader(),
                        files = e.target.files;
                    reader.onload = function() {
                        if ($('.upload-product')) {
                            $('.upload-product').attr('src', reader.result);
                        }
                    };
                    reader.readAsDataURL(files[0]);
                }
            });
            $('#product-reset').on('click', function() {
                $('.upload-product').attr('src', resetImage);
            });

        }

        $(document).on('keyup', 'input', function(event) {
            $(this).removeClass('is-invalid');
        });

        $(document).on('change', 'input', function(event) {
            $(this).removeClass('is-invalid');
        });

        const resetForm = () => {
            $('input').prop('disabled', false);
            $("input[name!=_token]").val('');
            $('input[name=organization_id]').val(0);
            $('input[name=type]').val(2);
            $('.upload_product').attr('src', "{{ asset('user_default.jpg') }}");
            $("#organizationModal").html("دوکان جدید");
        }

        $(document).on('click', '.edit_btn', function() {
            $("#organizationModal").html("تغییر دوکان");
            $('input[name=organization_id]').val($(this).attr('data-id'));
            $('select[name=type]').val($(this).attr('data-type')).change();
            $('input[name=name_dr]').val($(this).attr('data-name-dr'));
            $('input[name=main_office_address]').val($(this).attr('data-main_office_address'));
            $('input[name=sub_main_office_address]').val($(this).attr('data-sub_main_office_address'));
            $('.upload_product').attr('src', $(this).attr('data-img'));
            $('.pop_up_modal').modal('show');
        });

        $(document).on('click', '.deactive_btn', function() {
            Swal.fire({
                title: "غیر فعال شود؟",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "نخیر",
                confirmButtonText: "بلی",
            }).then((result) => {
                if (result.value == true) {
                    $.get("{{ route('organization-deactive') }}/" + $(this).attr('data-id'), function(
                    data) {
                        if (data) {
                            success_msg("غیر فعال گردید");
                            $('.datatables-ajax').DataTable().ajax.reload();
                        }
                    }).fail(function(error) {
                        error_msg("لطفا دوباره کوشش نمایید");
                    });
                }
            });
        });

        $(document).on('click', '.approve_btn', function() {
            Swal.fire({
                title: "تایید شود؟",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "نخیر",
                confirmButtonText: "بلی",
            }).then((result) => {
                if (result.value == true) {
                    $.get("{{ route('organization-approve') }}/" + $(this).attr('data-id'), function(data) {
                        if (data) {
                            success_msg("تایید گردید");
                            $('.datatables-ajax').DataTable().ajax.reload();
                        }
                    }).fail(function(error) {
                        error_msg("لطفا دوباره کوشش نمایید");
                    });
                }
            });
        });

        $(document).on('click', '.reject_btn', function() {
            Swal.fire({
                title: "رد شود ؟",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "نخیر",
                confirmButtonText: "بلی",
            }).then((result) => {
                if (result.value == true) {
                    $.get("{{ route('organization-reject') }}/" + $(this).attr('data-id'), function(data) {
                        if (data) {
                            success_msg("رد گردید");
                            $('.datatables-ajax').DataTable().ajax.reload();
                        }
                    }).fail(function(error) {
                        error_msg("لطفا دوباره کوشش نمایید");
                    });
                }
            });
        });
        // $(document).on('change', '#organization_type', function(event) {
        //     var value = $(this).val();
        //     if (value == '') {
        //         $('.hide_inputs').hide();
        //     }else{
        //         $('.hide_inputs').show();
        //     }
        // });

        var submit_btn = false;
        $(document).on('submit', '#store_form', function(event) {
            event.preventDefault();
            if (!submit_btn) {
                data = new FormData($("#store_form")[0]);
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
                        var res = JSON.parse(data);
                        if (res.response == true) {
                            $('.form-block').unblock();
                            submit_btn = false;
                            $('.datatables-ajax').DataTable().ajax.reload();
                            if ($('input[name=organization_id]').val() == 0) {
                                window.open("{{ route('organization-general-form') }}/" + res
                                    .organization_id, "_self");
                            } else {
                                success_msg("مشخصات تغییر نمود");
                            }
                            $('.pop_up_modal').modal('hide');
                            resetForm();
                        } else {
                            $('.form-block').unblock();
                            var response = JSON.parse(data);
                            $.each(response, function(prefix, val) {
                                $("input[name=" + prefix + "]").addClass('is-invalid');
                                $('div.' + prefix + '_error').text(val[0]);
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

        $('.show_modal').click(function() {
            resetForm();
            $('.pop_up_modal').modal('show');
        });

        $('.datatables-ajax').dataTable({
            "bInfo": false,
            "lengthChange": false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('shops') }}",

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
                    "data": 'name_details'
                },
                // {
                //     "data": 'name_en'
                // },
                {
                    "data": 'created_by_details'
                },
                // {
                //     "data": 'logo_details'
                // },
                {
                    "data": 'status_details'
                },
                {
                    "data": 'action'
                }
            ]
        });
    </script>
@endsection
