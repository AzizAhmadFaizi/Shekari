<style>
    .modal-dialog {
        width: 50% !important;
    }
</style>

<div class="card-header">
    <h4 class="card-title">لست عراده جات</h4>
    @if (auth()->user()->role_id == 2)
        <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                ثبت | لغو عراده جات
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <button class="dropdown-item show_modal w-100">عراده جدید</button>
                <button class="dropdown-item w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">لغو عراده جات</button>
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
                    <th>مودل</th>
                    <th>ملکیت واسطه</th>
                    <th>نمبر پلیت</th>
                    <th>نمبر شاسی</th>
                    <th>حالت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @php $new_btn = 0; @endphp
                @foreach ($vehicles as $item)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $item->vehicle_type }}</td>
                        <td>{{ $item->vehicle_owner_id == 0 ? 'شخصی' : 'کرایی' }}</td>
                        <td>{{ $item->plate_no }}</td>
                        <td>{{ $item->shasi_no }}</td>
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
                            <button type="button" class="btn btn-outline-primary btn-sm vehicle_view_btn round" data-id="{{ $item->id }}" data_vehicle_type="{{ $item->vehicle_type }}" data_vehicle_owner_id="{{ $item->vehicle_owner_id }}" data_plate_no="{{ $item->plate_no }}" data_color_id="{{ $item->color_id }}" data_engine_no="{{ $item->engine_no }}" data_shasi_no="{{ $item->shasi_no }}" data_issue_date="{{ $item->issue_date }}" data_expire_date="{{ $item->expire_date }}" data_cancel_reason="{{ $item->is_active_reason }}"><span class="fa fa-eye"></span></button>

                            @if ($item->is_approved != 1 && auth()->user()->role_id == 2)
                                <button type="button" class="btn btn-outline-dark btn-sm round vehicle_edit_btn" data-id="{{ $item->id }}" data_vehicle_type="{{ $item->vehicle_type }}" data_vehicle_owner_id="{{ $item->vehicle_owner_id }}" data_plate_no="{{ $item->plate_no }}" data_color_id="{{ $item->color_id }}" data_engine_no="{{ $item->engine_no }}" data_shasi_no="{{ $item->shasi_no }}" data_issue_date="{{ $item->issue_date }}" data_expire_date="{{ $item->expire_date }}" vehicle_attachment_id="{{ $item->vehicle_attachment_id }}"><span class="fa fa-edit"></span></button>
                            @endif
                            @if (auth()->user()->role_id == 4 && $item->vehicle_status_id == null)
                                <a href='#' class='me-1 vehicle_approve_btn' style='cursor: pointer;' data-id="{{ $item->id }}"><span class='btn btn-outline-success btn-sm waves-effect round fa fa-check'></span></a>
                                <a href='#' class='me-1 vehicle_reject_btn' style='cursor: pointer;' data-id="{{ $item->id }}"><span class='btn btn-outline-primary btn-sm waves-effect round fa fa-times'></span></a>
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
        <form class="add-new-record modal-content pt-0 form-block" id="vehicle_store_form" method="POST" action="{{ route('vehicle-store') }}">
            @csrf
            <input type="hidden" name="organization_id" value="{{ $organization_id }}" />
            <input type="hidden" name="vehicle_id" />
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="vehicleModalLabel"></h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="row">
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">نوعیت عراده</label>
                        <input type="text" class="form-control" name="vehicle_type" />
                        <div class="invalid-feedback vehicle_type_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">ملکیت واسطه</label>
                        <select name="vehicle_owner_id" class="form-control select2">
                            <option value="">ملکیت واسطه را انتخاب نمایید</option>
                            <option value="0">شخصی</option>
                            <option value="1">کرایی</option>
                        </select>
                        <div class="invalid-feedback vehicle_owner_id_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">نمبر پلیت واسطه</label>
                        <input type="text" class="form-control" name="plate_no" />
                        <div class="invalid-feedback plate_no_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">رنگ واسطه</label>
                        <select name="color_id" class="form-control select2">
                            <option value="">رنگ واسطه را انتخاب نمایید</option>
                            @foreach ($colors as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback color_id_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">نمبر انجن</label>
                        <input type="text" class="form-control" name="engine_no" />
                        <div class="invalid-feedback engine_no_error"></div>
                    </div>

                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">نمبر شاسی</label>
                        <input type="text" class="form-control" name="shasi_no" />
                        <div class="invalid-feedback shasi_no_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">تاریخ صدور جواز سیر</label>
                        <input type="text" class="form-control farsi-date-picker" name="issue_date" />
                        <div class="invalid-feedback issue_date_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">تاریخ اعتبار جواز سیر</label>
                        <input type="text" class="form-control farsi-date-picker" name="expire_date" />
                        <div class="invalid-feedback expire_date_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12">
                        <label class="mb-1">جدول وسایط</label>
                        <select name="vehicle_attachment_id" id="vehicle_attachment_id" class="form-control select2">
                            <option value=""> جدول وسایط را انتخاب نمایید</option>
                            @foreach ($vehicle_attachments as $item)
                                <option value="{{ $item->id }}">جدول - {{ $item->vehicle_number }} - وسایط</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback vehicle_attachment_id_error"></div>
                    </div>
                    <p class="show_cancel_reason"></p>
                </div>

                <button type="submit" class="btn btn-outline-primary btn-sm me-1 btn-form-block to_hide"><span class="fa fa-save"></span></button>
                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"><span class="fa fa-times"></span></button>
            </div>

        </form>
    </div>
</div>

<div class="modal fade modals-slide-in" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">لغو عراده </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('vehicle-deactive') }}" id="vehicle_cancel_form" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-1">
                        <input type="hidden" value="{{ $organization_id }}" name="org_id">
                        <label class="mb-1">انتخاب کارمندان</label>
                        <select name="vehicles[]" id="vehicles" class="form-control select3" multiple required>
                            <option value="" disabled> عراده را انتخاب نمایید</option>
                            @foreach ($active_vehicles as $item)
                                <option value="{{ $item->id }}">{{ $item->vehicle_type . ' - ' . $item->plate_no . ' - ' . $item->color_details->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback nationality_error"></div>
                    </div>
                    <div class="mb-1">
                        <label class="mb-1">دلیل لغو عراده </label>
                        <textarea name="is_active_reason" class="form-control" required placeholder="دلیل لغو عراده  را بنوسید"></textarea>
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

@include('organization.dari-datepicker')
@include('organization.general_scripts')
@include('organization.blockui')
<script>
    $('.select3').select2({
        dir: "rtl",
        dropdownParent: $("#exampleModal"),
    });

    $(document).on('click', '.vehicle_approve_btn', function() {
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
                $.get("{{ route('vehicle-approve') }}/" + $(this).attr('data-id'), function(data) {
                    if (data) {
                        success_msg("تایید گردید");
                        $('.load_btn[data-route="vehicles"]').click();
                    }
                }).fail(function(error) {
                    error_msg("لطفا دوباره کوشش نمایید");
                });
            }
        });
    });

    $(document).on('click', '.vehicle_reject_btn', function() {
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
                $.get("{{ route('vehicle-reject') }}/" + $(this).attr('data-id'), function(data) {
                    if (data) {
                        success_msg("رد گردید");
                        $('.load_btn[data-route="vehicles"]').click();
                    }
                }).fail(function(error) {
                    error_msg("لطفا دوباره کوشش نمایید");
                });
            }
        });
    });

    $(document).on('click', '.vehicle_edit_btn', function(e) {
        $('#vehicleModalLabel').html('تغییر مشخصات عراده');
        $('input').prop('disabled', false);
        $('select').prop('disabled', false);
        $('.to_hide').removeClass('d-none');
        $('input[name=vehicle_id]').val($(this).attr('data-id'));
        $('input[name=vehicle_type]').val($(this).attr('data_vehicle_type'));
        $('select[name=vehicle_owner_id]').val($(this).attr('data_vehicle_owner_id')).trigger('change');
        $('select[name=vehicle_attachment_id]').val($(this).attr('data_vehicle_attachment_id')).trigger('change');
        $('input[name=plate_no]').val($(this).attr('data_plate_no'));
        $('select[name=color_id]').val($(this).attr('data_color_id')).trigger('change');
        $('input[name=engine_no]').val($(this).attr('data_engine_no'));
        $('input[name=shasi_no]').val($(this).attr('data_shasi_no'));
        $('input[name=issue_date]').val($(this).attr('data_issue_date'));
        $('input[name=expire_date]').val($(this).attr('data_expire_date'));
        $('.pop_up_modal').modal('show');
    });

    $(document).on('click', '.vehicle_view_btn', function(e) {
        $('#vehicleModalLabel').html('نمایش مشخصات عراده');
        $('input[name=vehicle_id]').val($(this).attr('data-id'));
        $('input[name=vehicle_type]').val($(this).attr('data_vehicle_type'));
        $('select[name=vehicle_owner_id]').val($(this).attr('data_vehicle_owner_id')).trigger('change');
        $('input[name=plate_no]').val($(this).attr('data_plate_no'));
        $('select[name=color_id]').val($(this).attr('data_color_id')).trigger('change');
        $('input[name=engine_no]').val($(this).attr('data_engine_no'));
        $('input[name=shasi_no]').val($(this).attr('data_shasi_no'));
        $('input[name=issue_date]').val($(this).attr('data_issue_date'));
        $('input[name=expire_date]').val($(this).attr('data_expire_date'));

        $('input').prop('disabled', true);
        $('select').prop('disabled', true);
        $('.to_hide').addClass('d-none');
        $('p.show_cancel_reason').html($(this).attr('data_cancel_reason'));
        $('.pop_up_modal').modal('show');

    });

    var submit_btn = false;
    $(document).on('submit', '#vehicle_store_form', function(event) {
        event.preventDefault();
        if (!submit_btn) {
            data = new FormData($("#vehicle_store_form")[0]);
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
                        $('.load_btn[data-route="vehicles"]').click();
                        $('.form-block').unblock();
                        submit_btn = false;
                        success_msg($('input[name=vehicle_id]').val() == 0 ? "موفقانه ثبت شد" : "موفقانه تغییر نمود");
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
    $(document).on('submit', '#vehicle_cancel_form', function(event) {
        event.preventDefault();
        if (!submit_btn_1) {
            data = new FormData($("#vehicle_cancel_form")[0]);
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
                        $('.load_btn[data-route="vehicles"]').click();
                        $('.form-block').unblock();
                        submit_btn_1 = false;
                        success_msg("موفقانه لغو شد");
                        $('div.modal-backdrop.fade.show').remove();
                        $('body').removeClass('modal-open');
                    } else {
                        $('.form-block').unblock();
                        var response = JSON.parse(data);
                        $.each(response, function(prefix, val) {
                            $('div.' + prefix + '_error').text(val[0]);
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

    $('.show_modal').click(function() {
        let organization_id = $('input[name=organization_id]').val();
        $('input').prop('disabled', false);
        $('select').prop('disabled', false);
        $('.to_hide').removeClass('d-none');
        $("input[name!=_token]").val('');
        $('input[name=vehicle_id]').val('0');
        $('input[name=organization_id]').val(organization_id);
        $('#vehicleModalLabel').html('عراده جدید');
        $('.pop_up_modal').modal('show');
    });
</script>
