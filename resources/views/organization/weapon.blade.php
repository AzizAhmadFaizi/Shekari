<div class="card-header">
    <h4 class="card-title">لست سلاح</h4>
    @if (auth()->user()->role_id == 2)
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sendToPrint"><span class="fa fa-print"></span> ارسال به چاپ </button>
        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#weapon_delivery"><span class="fa fa-times"></span> تسلیمی سلاح </button>
        <button class="btn btn-primary show_modal"><span class='fa fa-plus'></span> ثبت سلاح </button>
    @endif
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="datatables-ajax table">
            <thead class="table-dark">
                <tr>
                    <th>شماره</th>
                    <th>سلاح</th>
                    <th>نمبر سلاح</th>
                    <th>قطر سلاح</th>
                    <th>نوعیت</th>
                    <th>تعداد جبه</th>
                    <th>حالت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($weapons as $item)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $item->weapon_type_details->name_en }}</td>
                        <td>{{ $item->weapon_no }}</td>
                        <td>{{ $item->weapon_diameter }}</td>
                        <td>{{ $item->is_used == 1 ? 'جدید' : 'مستعمل' }}</td>
                        <td>{{ $item->magazine_quantity }}</td>
                        <td>
                            @switch($item->status)
                                @case(1)
                                    {!! "<span class='btn btn-outline-secondary btn-sm waves-effect round fa fa-info'>در دیپو</span>" !!}
                                @break

                                @case(2)
                                    <span class='btn btn-outline-secondary btn-sm waves-effect round fa fa-check'> ارسال به چاپ </span>
                                @break

                                @case(3)
                                    <span class='btn btn-outline-secondary btn-sm waves-effect round fa fa-times'> چاپ شده </span>
                                @break

                                @default
                            @endswitch
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
                        <th class="text-center">
                            @if ($item->is_approved != 1 && auth()->user()->role_id == 2)
                                <button type="button" class="btn btn-outline-dark btn-sm round weapon_edit_btn" data-id="{{ $item->id }}" data_weapon_type_id="{{ $item->weapon_type_id }}" data_weapon_no="{{ $item->weapon_no }}" data_weapon_diameter="{{ $item->weapon_diameter }}" data_is_used="{{ $item->is_used }}" data_magazine_quantity="{{ $item->magazine_quantity }}" weapon_attachment_id="{{ $item->weapon_attachment_id }}"><span class="fa fa-edit"></span></button>
                            @endif
                            @if (auth()->user()->role_id == 4 && $item->weapon_status_id == null)
                                <a href='#' class='me-1 weapon_approve_btn' style='cursor: pointer;' data-id="{{ $item->id }}"><span class='btn btn-outline-success btn-sm waves-effect round fa fa-check'></span></a>
                                <a href='#' class='me-1 weapon_reject_btn' style='cursor: pointer;' data-id="{{ $item->id }}"><span class='btn btn-outline-primary btn-sm waves-effect round fa fa-times'></span></a>
                            @endif
                        </th>
                    </tr>
                @endforeach
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
</div>

<div class="modal modal-slide-in fade pop_up_modal" id="modals-slide-in">
    <div class="modal-dialog sidebar-xxl form-block">
        <form class="add-new-record modal-content pt-0 form-block" id="weapon_store_form" method="POST" action="{{ route('weapon-store') }}">
            @csrf
            <input type="hidden" name="organization_id" value="{{ $organization_id }}" />
            <input type="hidden" name="weapon_id" />
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="employeeModalLabel"></h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="row">
                    <div class="mb-1 col-sm-12">
                        <label class="mb-1">سلاح</label>
                        <select name="weapon_type_id" id="weapon_type_id" class="form-control select2">
                            <option value="" disabled selected> سلاح را انتخاب نمایید</option>
                            @foreach ($weapon_types as $item)
                                <option value="{{ $item->id }}">{{ $item->name_dr }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback weapon_type_id_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12">
                        <label class="mb-1">نمبر سلاح</label>
                        <input type="text" class="form-control" name="weapon_no" />
                        <div class="invalid-feedback weapon_no_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12">
                        <label class="mb-1">قطر سلاح</label>
                        <input type="text" class="form-control" name="weapon_diameter" />
                        <div class="invalid-feedback weapon_diameter_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12">
                        <label class="mb-1">تعداد جبه</label>
                        <input type="text" class="form-control" name="magazine_quantity" />
                        <div class="invalid-feedback magazine_quantity_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12">
                        <label class="mb-1">نوعیت سلاح</label>
                        <select name="is_used" id="is_used" class="form-control select2">
                            <option value="" disabled selected> نوعیت سلاح را انتخاب نمایید</option>
                            <option value="1">جدید</option>
                            <option value="2">مستعمل</option>
                        </select>
                        <div class="invalid-feedback is_used_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12">
                        <label class="mb-1">جدول سلاح</label>
                        <select name="weapon_attachment_id" id="weapon_attachment_id" class="form-control select2">
                            <option value=""> جدول سلاح را انتخاب نمایید</option>
                            @foreach ($weapon_attachments as $item)
                                <option value="{{ $item->id }}">جدول - {{ $item->weapon_number }} - اسلحه</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback weapon_attachment_id_error"></div>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary btn-sm me-1 btn-form-block to_hide"><span class="fa fa-save"></span></button>
                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"><span class="fa fa-times"></span></button>
            </div>

        </form>
    </div>
</div>

<div class="modal fade modals-slide-in" id="weapon_delivery" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تسلیمی سلاح</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('weapon-deactive') }}" id="weapon_delivery_form" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-1">
                        <input type="hidden" value="{{ $organization_id }}" name="org_id">
                        <label class="mb-1">انتخاب سلاح</label>
                        <select name="new_weapons[]" id="new_weapons" class="form-control select5" multiple required>
                            <option value="" disabled> سلاح را انتخاب نمایید</option>
                            @foreach ($active_weapons as $item)
                                @php $used=$item->is_used==1?'جدید':'مستعمل'.' - ' @endphp
                                <option value="{{ $item->id }}">{{ ' نمبر سلاح ' . $item->weapon_no . ' قطر سلاح ' . $item->weapon_diameter . ' نوعیت ' . $used . ' تعداد جبه ' . $item->magazine_quantity }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="mb-1">نوت</label>
                        <textarea name="is_active_reason" class="form-control" required placeholder="نوت را بنوسید"></textarea>
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

<div class="modal fade modals-slide-in" id="sendToPrint" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ارسال به چاپ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('weapon-send-print') }}" id="send_to_print" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-1">
                        <label class="mb-1">انتخاب سلاح</label>
                        <label class="float-end">انتخاب تمام سلاح <input type="checkbox" id="checkAllWeapons"></label>
                        <select name="weapons[]" id="weapons" class="form-control select4" multiple required>
                            @foreach ($active_weapons as $item)
                                @php $used=$item->is_used==1?'جدید':'مستعمل'.' - ' @endphp
                                <option value="{{ $item->id }}">{{ ' نمبر سلاح ' . $item->weapon_no . ' قطر سلاح ' . $item->weapon_diameter . ' نوعیت ' . $used . ' تعداد جبه ' . $item->magazine_quantity }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-sm-12 col-md-6">
                            <label class="mb-1">نام پروژه دری</label>
                            <input type="text" class="form-control" name="project_name_dr">
                            <div class="invalid-feedback project_name_dr_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-6">
                            <label class="mb-1">حدود کارت دری</label>
                            <input type="text" class="form-control" name="card_limit_dr">
                            <div class="invalid-feedback card_limit_dr_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-6">
                            <label class="mb-1">نام پروژه انگلیسی</label>
                            <input type="text" class="form-control" name="project_name_en">
                            <div class="invalid-feedback project_name_en_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-6">
                            <label class="mb-1">حدود کارت انگلیسی</label>
                            <input type="text" class="form-control" name="card_limit_en">
                            <div class="invalid-feedback card_limit_en_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-6">
                            <label class="mb-1">تاریخ صدور</label>
                            <input type="text" class="form-control farsi-date-picker" name="issue_date">
                            <div class="invalid-feedback issue_date_error"></div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-6">
                            <label class="mb-1">تاریخ انقضاء</label>
                            <input type="text" class="form-control farsi-date-picker" name="valid_date">
                            <div class="invalid-feedback valid_date_error"></div>
                        </div>
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

@include('organization.general_scripts')
@include('organization.dari-datepicker')
@include('organization.blockui')
<script>
    $('#checkAllWeapons').click(function() {
        if ($("#checkAllWeapons").is(':checked')) {
            $("#weapons > option").prop("selected", "selected");
            $("#weapons").trigger("change");
        } else {
            $("#weapons > option").prop("selected", "");
            $("#weapons").trigger("change");
        }
    });

    $(document).on('click', '.weapon_approve_btn', function() {
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
                $.get("{{ route('weapon-approve') }}/" + $(this).attr('data-id'), function(data) {
                    if (data) {
                        success_msg("تایید گردید");
                        $('.load_btn[data-route="weapons"]').click();
                    }
                }).fail(function(error) {
                    error_msg("لطفا دوباره کوشش نمایید");
                });
            }
        });
    });

    $(document).on('click', '.weapon_reject_btn', function() {
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
                $.get("{{ route('weapon-reject') }}/" + $(this).attr('data-id'), function(data) {
                    if (data) {
                        success_msg("رد گردید");
                        $('.load_btn[data-route="weapons"]').click();
                    }
                }).fail(function(error) {
                    error_msg("لطفا دوباره کوشش نمایید");
                });
            }
        });
    });

    $('.select4').select2({
        dir: "rtl",
        dropdownParent: $("#sendToPrint"),
    });
    $('.select5').select2({
        dir: "rtl",
        dropdownParent: $("#weapon_delivery"),
    });

    $(document).on('click', '.weapon_edit_btn', function(e) {
        $('#employeeModalLabel').html('تغییر مشخصات سلاح');
        $('input').prop('disabled', false);
        $('select').prop('disabled', false);
        $('.to_hide').removeClass('d-none');
        $('input[name=weapon_id]').val($(this).attr('data-id'));
        $('select[name=weapon_type_id]').select2('val', $(this).attr('data_weapon_type_id'));
        $('input[name=weapon_no]').val($(this).attr('data_weapon_no'));
        $('input[name=weapon_diameter]').val($(this).attr('data_weapon_diameter'));
        $('input[name=magazine_quantity]').val($(this).attr('data_magazine_quantity'));
        $('select[name=is_used]').select2('val', $(this).attr('data_is_used'));
        $('select[name=weapon_attachment_id]').select2('val', $(this).attr('weapon_attachment_id'));
        $('.pop_up_modal').modal('show');
    });

    var submit_btn = false;
    $(document).on('submit', '#weapon_store_form', function(event) {
        event.preventDefault();
        if (!submit_btn) {
            data = new FormData($("#weapon_store_form")[0]);
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
                        success_msg($('input[name=weapon_id]').val() == 0 ? "موفقانه ثبت شد" : "موفقانه تغییر نمود");
                        $('.load_btn[data-route="weapons"]').click();
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
    $(document).on('submit', '#weapon_delivery_form', function(event) {
        event.preventDefault();
        if (!submit_btn_1) {
            data = new FormData($("#weapon_delivery_form")[0]);
            $.ajax({
                url: $(this).attr('action'),
                type: 'post',
                data: data,
                dataType: 'html',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    submit_btn_1 = true;
                },
                success: function(data) {
                    if (data == true) {
                        $('.load_btn[data-route="weapons"]').click();
                        $('.form-block').unblock();
                        submit_btn_1 = false;
                        success_msg("اسلحه موفقانه تسلیم شد");
                        $('div.modal-backdrop.fade.show').remove();
                        $('body').removeClass('modal-open');
                    } else {
                        $('.form-block').unblock();
                        var response = JSON.parse(data);
                        $.each(response, function(prefix, val) {
                            $('div.' + prefix + '_error').text(val[0]);
                            $("input[name=" + prefix + "]").addClass('is-invalid');
                            $("textarea[name=" + prefix + "]").addClass('is-invalid');
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

    var submit_btn_3 = false;
    $(document).on('submit', '#send_to_print', function(event) {
        event.preventDefault();
        if (!submit_btn_3) {
            data = new FormData($("#send_to_print")[0]);
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
                    submit_btn_3 = true;
                },
                success: function(data) {
                    if (data == true) {
                        $('.load_btn[data-route="weapons"]').click();
                        $('.form-block').unblock();
                        submit_btn_3 = false;
                        success_msg("موفقانه ارسال گردید");
                        $('div.modal-backdrop.fade.show').remove();
                        $('body').removeClass('modal-open');
                    } else {
                        $('.form-block').unblock();
                        var response = JSON.parse(data);
                        $.each(response, function(prefix, val) {
                            $('div.' + prefix + '_error').text(val[0]);
                            $("input[name=" + prefix + "]").addClass('is-invalid');
                        });
                    }
                    submit_btn_3 = false;
                },
                error: function() {
                    $('.form-block').unblock();
                    error_msg("لطفا دوباره کوشش نمایید");
                    submit_btn_3 = false;
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
        $('input[name=weapon_id]').val('0');
        $('input[name=organization_id]').val(organization_id);
        $('#employeeModalLabel').html('ثبت سلاح');
        $('.pop_up_modal').modal('show');
    });

    $('.show_modal_1').click(function() {
        let organization_id = $('input[name=organization_id]').val();
        $('.pop_up_modal_1').modal('show');
    });
</script>
