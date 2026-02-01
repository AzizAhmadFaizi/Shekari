<style>
    .modal-dialog {
        width: 50% !important;
    }
</style>
<div class="card-header">
    <h4 class="card-title">لست کارمندان</h4>
    @if (auth()->user()->role_id == 2)
        <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                ثبت | انفکاک کارمند
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <button class="dropdown-item show_modal w-100" href="#">ثبت کارمند</button>
                <button class="dropdown-item w-100" data-bs-toggle="modal" data-bs-target="#exampleModal"> انفکاک کارمندان</button>
            </div>
        </div>
    @endif

</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="datatables-ajax table">
            <thead class="table-dark">
                <tr>
                    <th>شماره</th>
                    <th>شهرت</th>
                    <th>افغانی/خارجی</th>
                    <th>وظیفه</th>
                    <th>حالت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @php $new_btn = 0; @endphp
                @foreach ($employees as $item)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $item->name . ' - ' . $item->last_name }}</td>
                        <td>{{ $item->nationality == 0 ? 'افغانی' : 'خارجی' }}</td>
                        <td>{{ $item->position }}</td>
                        <td>
                            @switch($item->is_approved)
                                @case(0)
                                    {!! "<span class='btn btn-outline-warning btn-sm waves-effect round fa fa-info'> در حال انتظار </span>" !!}
                                @break

                                @case(1)
                                    <span class='btn btn-outline-success btn-sm waves-effect round fa fa-check'> تایید شده </span>
                                @break

                                @case(2)
                                    <span class='btn btn-outline-danger btn-sm waves-effect round fa fa-times'> رد شده </span>
                                @break

                                @default
                            @endswitch
                        </td>
                        <th class="text-center">
                            <button type="button" class="btn btn-outline-primary btn-sm employee_view_btn round" data-id="{{ $item->id }}" data_name="{{ $item->name }}" data_last_name="{{ $item->last_name }}" data_father_name="{{ $item->father_name }}" data_national_id="{{ $item->national_id }}" data_position="{{ $item->position }}" data_status_reason="{{ $item->status_reason }}" data_attachment_files="{{ URL::asset('storage/employee_attachments/' . $item->attachments) }}" data_nationality="{{ $item->nationality }}" data_employee_attachment_id="{{ $item->employee_attachment_id }}"><span class="fa fa-eye"></span></button>
                            @if ($item->is_approved != 1 && $item->employee_status_id == null)
                                <button type="button" class="btn btn-outline-dark btn-sm round employee_edit_btn" data-id="{{ $item->id }}" data_name="{{ $item->name }}" data_last_name="{{ $item->last_name }}" data_father_name="{{ $item->father_name }}" data_national_id="{{ $item->national_id }}" data_position="{{ $item->position }}" data_status_reason="{{ $item->status_reason }}" data_attachment_files="{{ URL::asset('storage/employee_attachments/' . $item->attachments) }}" data_nationality="{{ $item->nationality }}" data_employee_attachment_id="{{ $item->employee_attachment_id }}"><span class="fa fa-edit"></span></button>
                            @endif
                            @if (auth()->user()->role_id == 4)
                                <a href='#' class='me-1 employee_approve_btn' style='cursor: pointer;' data-id="{{ $item->id }}"><span class='btn btn-outline-success btn-sm waves-effect round fa fa-check'></span></a>
                                <a href='#' class='me-1 employee_reject_btn' style='cursor: pointer;' data-id="{{ $item->id }}"><span class='btn btn-outline-primary btn-sm waves-effect round fa fa-times'></span></a>
                            @endif
                        </th>
                    </tr>
                @endforeach
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
</div>

<div class="modal fade modals-slide-in" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">انفکاک کارمندان</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('employee-deactive') }}" id="employee_cancel_form" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-1">
                        <input type="hidden" value="{{ $organization_id }}" name="org_id">
                        <label class="mb-1">انتخاب کارمندان</label>
                        <select name="employees[]" id="employees" class="form-control select3" multiple required>
                            <option value="" disabled> کارمندان را انتخاب نمایید</option>
                            @foreach ($active_employees as $item)
                                <option value="{{ $item->id }}">{{ $item->name . ' - ' . $item->last_name . ' - ' . $item->national_id . ' - ' . $item->position }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback nationality_error"></div>
                    </div>
                    <div class="mb-1">
                        <label class="mb-1">دلیل انفکاک کارمندان</label>
                        <textarea name="is_active_reason" class="form-control" required placeholder="دلیل انفکاک کارمندان را بنوسید"></textarea>
                        <div class="invalid-feedback is_active_reason_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12">
                        <label class="w-100">ضمایم</label>
                        <input type="file" class="form-control-file" accept="application/pdf" name="status_attachments">
                        <div class="invalid-feedback status_attachments_error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal"><span class="fa fa-times"></span></button>
                    <button type="submit" class="btn btn-outline-primary btn-sm"><span class="fa fa-save"></span></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal modal-slide-in fade pop_up_modal" id="modals-slide-in">
    <div class="modal-dialog sidebar-xxl form-block">
        <form class="add-new-record modal-content pt-0 form-block" id="employee_store_form" method="POST" action="{{ route('employee-store') }}">
            @csrf
            <input type="hidden" name="organization_id" value="{{ $organization_id }}" />
            <input type="hidden" name="employee_id" />
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="employeeModalLabel"></h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="row">
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">اسم</label>
                        <input type="text" class="form-control" name="name" />
                        <div class="invalid-feedback name_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">تخلص</label>
                        <input type="text" class="form-control" name="last_name" />
                        <div class="invalid-feedback last_name_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">اسم پدر</label>
                        <input type="text" class="form-control" name="father_name" />
                        <div class="invalid-feedback father_name_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">نمبرتذکره/پاسپورت</label>
                        <input type="text" class="form-control" name="national_id" />
                        <div class="invalid-feedback national_id_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">وظیفه</label>
                        <input type="text" class="form-control" name="position" />
                        <div class="invalid-feedback position_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">ملیت کارمند</label>
                        <select name="nationality" id="nationality" class="form-control select2">
                            <option value=""> ملیت کارمند را انتخاب نمایید</option>
                            <option value="0">افغانی</option>
                            <option value="1">خارجی</option>
                        </select>
                        <div class="invalid-feedback nationality_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">جدول کارمند</label>
                        <select name="employee_attachment_id" id="employee_attachment_id" class="form-control select2">
                            <option value=""> جدول کارمند را انتخاب نمایید</option>
                            @foreach ($employee_attachments as $item)
                                <option value="{{ $item->id }}">جدول - {{ $item->employee_number }} - نفری</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback employee_attachment_id_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label for="" class="mb-1 to_hide">ضمایم</label>
                        <p class="attachments"></p>
                        <input type="file" class="form-control-file to_hide" name="attachments" accept="application/pdf">
                        <div class="invalid-feedback attachments_error"></div>
                    </div>
                </div>
                <div class="mb-1">
                    <p class="show_cancel_reason"></p>
                </div>
                <button type="submit" class="btn btn-outline-primary btn-sm me-1 btn-form-block to_hide"><span class="fa fa-save"></span></button>
                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"><span class="fa fa-times"></span></button>
            </div>

        </form>
    </div>
</div>

@include('organization.general_scripts')
@include('organization.dari-datepicker')
@include('organization.blockui')
<script>
    $(document).on('click', '.employee_approve_btn', function() {
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
                $.get("{{ route('employee-approve') }}/" + $(this).attr('data-id'), function(data) {
                    if (data) {
                        success_msg("تایید گردید");
                        $('.load_btn[data-route="employees"]').click();
                    }
                }).fail(function(error) {
                    error_msg("لطفا دوباره کوشش نمایید");
                });
            }
        });
    });

    $(document).on('click', '.employee_reject_btn', function() {
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
                $.get("{{ route('employee-reject') }}/" + $(this).attr('data-id'), function(data) {
                    if (data) {
                        success_msg("رد گردید");
                        $('.load_btn[data-route="employees"]').click();
                    }
                }).fail(function(error) {
                    error_msg("لطفا دوباره کوشش نمایید");
                });
            }
        });
    });

    $('.select3').select2({
        dir: "rtl",
        dropdownParent: $("#exampleModal"),
    });
    $(document).on('click', '.employee_edit_btn', function(e) {
        $('#employeeModalLabel').html('تغییر مشخصات کارمند');
        $('input').prop('disabled', false);
        $('select').prop('disabled', false);
        $('.to_hide').removeClass('d-none');
        $('input[name=employee_id]').val($(this).attr('data-id'));
        $('input[name=name]').val($(this).attr('data_name'));
        $('input[name=last_name]').val($(this).attr('data_last_name'));
        $('input[name=father_name]').val($(this).attr('data_father_name'));
        $('input[name=national_id]').val($(this).attr('data_national_id'));
        $('input[name=position]').val($(this).attr('data_position'));
        $('select[name=nationality]').select2('val', $(this).attr('data_nationality'));
        $('select[name=employee_attachment_id]').select2('val', $(this).attr('data_employee_attachment_id'));
        $('.attachments').empty();
        $('<a>', {
            text: 'دیدن ضمایم',
            title: 'دیدن ضمایم',
            href: $(this).attr('data_attachment_files'),
            target: '_blank'
        }).appendTo('.attachments');
        $('.pop_up_modal').modal('show');
    });

    $(document).on('click', '.employee_view_btn', function(e) {
        $('#employeeModalLabel').html('نمایش مشخصات کارمند');
        $('input[name=name]').val($(this).attr('data_name'));
        $('input[name=last_name]').val($(this).attr('data_last_name'));
        $('input[name=father_name]').val($(this).attr('data_father_name'));
        $('input[name=national_id]').val($(this).attr('data_national_id'));
        $('input[name=position]').val($(this).attr('data_position'));
        $('select[name=nationality]').select2('val', $(this).attr('data_nationality'));
        $('select[name=employee_attachment_id]').select2('val', $(this).attr('data_employee_attachment_id'));
        $('.attachments').empty();
        $('<a>', {
            text: 'دیدن ضمایم',
            title: 'دیدن ضمایم',
            href: $(this).attr('data_attachment_files'),
            target: '_blank'
        }).appendTo('.attachments');

        $('input').prop('disabled', true);
        $('select').prop('disabled', true);
        $('.to_hide').addClass('d-none');
        $('p.show_cancel_reason').html($(this).attr('data_status_reason'));
        $('.pop_up_modal').modal('show');

    });

    var submit_btn = false;
    $(document).on('submit', '#employee_store_form', function(event) {
        event.preventDefault();
        if (!submit_btn) {
            data = new FormData($("#employee_store_form")[0]);
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
                        $('.form-block').unblock();
                        submit_btn = false;
                        success_msg($('input[name=employee_id]').val() == 0 ? "موفقانه ثبت شد" : "موفقانه تغییر نمود");
                        $('.load_btn[data-route="employees"]').click();
                        $('.pop_up_modal').modal('hide');
                    } else {
                        $('.form-block').unblock();
                        var response = JSON.parse(data);
                        $.each(response, function(prefix, val) {
                            $('div.' + prefix + '_error').text(val[0]);
                            $("select[name=" + prefix + "]").parent().addClass('is-invalid');
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

    var submit_btn_1 = false;
    $(document).on('submit', '#employee_cancel_form', function(event) {
        event.preventDefault();
        if (!submit_btn_1) {
            data = new FormData($("#employee_cancel_form")[0]);
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
                    submit_btn_1 = true;
                },
                success: function(data) {
                    if (data == true) {
                        $('.load_btn[data-route="employees"]').click();
                        $('.form-block').unblock();
                        submit_btn_1 = false;
                        success_msg("موفقانه منفک شد");
                        $('div.modal-backdrop.fade.show').remove();
                        $('body').removeClass('modal-open');
                    } else {
                        $('.form-block').unblock();
                        var response = JSON.parse(data);
                        $.each(response, function(prefix, val) {
                            $('div.' + prefix + '_error').text(val[0]);
                            $("textarea[name=" + prefix + "]").addClass('is-invalid');
                            $("input[name=" + prefix + "]").addClass('is-invalid');
                        });
                    }
                    submit_btn_1 = false;
                },
                error: function() {
                    $('.form-block').unblock();
                    error_msg("لطفا دوباره کوشش نمایید");
                    submit_btn_1 = false;
                }
            });
        }

    });

    $('.show_modal').click(function() {
        let organization_id = $('input[name=organization_id]').val();
        $('input').prop('disabled', false);
        $('select').prop('disabled', false);
        $('.to_hide').removeClass('d-none');
        $("input[name!=_token]").val('');
        $('input[name=employee_id]').val('0');
        $('input[name=organization_id]').val(organization_id);
        $('#employeeModalLabel').html('ثبت کارمند');
        $('.pop_up_modal').modal('show');
    });

    $('.show_modal_1').click(function() {
        let organization_id = $('input[name=organization_id]').val();
        $('.pop_up_modal_1').modal('show');
    });
</script>
