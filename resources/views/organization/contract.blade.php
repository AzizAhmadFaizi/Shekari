<style>
    .modal-dialog {
        width: 50% !important;
    }
</style>

<div class="card-header">
    <h4 class="card-title">لست قرارداد ها</h4>
    @if (auth()->user()->role_id == 2)
        <button class="btn btn-primary show_modal"><span data-feather='plus'></span>قراداد جدید</button>
    @endif
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="datatables-ajax table">
            <thead class="table-dark">
                <tr>
                    <th>شماره</th>
                    <th>مرجع</th>
                    <th>موقعیت</th>
                    <th>تاریخ شروع</th>
                    <th>تاریخ ختم</th>
                    <th>حالت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contracts as $item)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $item->contract_reference }}</td>
                        <td>{{ $item->contract_location }}</td>
                        <td>{{ to_jalai($item->start_date) }}</td>
                        <td>{{ to_jalai($item->end_date) }}</td>
                        <td>
                            @php $label = 0 @endphp
                            @switch($item->status)
                                @case(1)
                                    @php  $label = 'در جریان';  @endphp
                                @break

                                @default
                                    @php $label = 'لغو/تکمیل شده' @endphp
                            @endswitch
                            <span class="badge bg-success ps-1 pe-1">{{ $label }}</span>
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
                            <button type="button" class="btn btn-outline-primary btn-sm contaract_view_btn round" data-id="{{ $item->id }}" data_contract_reference="{{ $item->contract_reference }}" data_contract_location="{{ $item->contract_location }}" data_start_date="{{ to_jalai($item->start_date) }}" data_end_date="{{ to_jalai($item->end_date) }}" data_afghan_employee_number="{{ $item->afghan_employee_number }}" data_foreign_employee_number="{{ $item->foreign_employee_number }}" data_weapon_quantity="{{ $item->weapon_quantity }}" data_vehicle_quantity="{{ $item->vehicle_quantity }}" data_radio_quantity="{{ $item->radio_quantity }}" data_cancel_reason="{{ $item->is_active_reason }}" data_attachments="{{ URL::asset('storage/contract_attachments/' . $item->attachments) }}" data_cost="{{ $item->cost }}" data_comment="{{ $item->comment }}"><span class="fa fa-eye"></span></button>
                            @if ($item->is_approved != 1 && auth()->user()->role_id == 2)
                                <button type="button" class="btn btn-outline-dark btn-sm round contract_edit_btn" data-id="{{ $item->id }}" data_contract_reference="{{ $item->contract_reference }}" data_contract_location="{{ $item->contract_location }}" data_start_date="{{ to_jalai($item->start_date) }}" data_end_date="{{ to_jalai($item->end_date) }}" data_afghan_employee_number="{{ $item->afghan_employee_number }}" data_foreign_employee_number="{{ $item->foreign_employee_number }}" data_weapon_quantity="{{ $item->weapon_quantity }}" data_vehicle_quantity="{{ $item->vehicle_quantity }}" data_radio_quantity="{{ $item->radio_quantity }}" data_attachments="{{ URL::asset('storage/contract_attachments/' . $item->attachments) }}" data_cost="{{ $item->cost }}"><span class="fa fa-edit" data_comment="{{ $item->comment }}"></span></button>
                            @endif
                            @if ($item->status == 1)
                                <button type="button" class="btn btn-outline-danger btn-sm round contract_cancel_btn" data-id="{{ $item->id }}"><span class="fa fa-trash"></span></button>
                            @endif
                            @if (auth()->user()->role_id == 4)
                                <a href='#' class='me-1 contract_approve_btn' style='cursor: pointer;' data-id="{{ $item->id }}"><span class='btn btn-outline-success btn-sm waves-effect round fa fa-check'></span></a>
                                <a href='#' class='me-1 contract_reject_btn' style='cursor: pointer;' data-id="{{ $item->id }}"><span class='btn btn-outline-primary btn-sm waves-effect round fa fa-times'></span></a>
                            @endif
                        </th>
                    </tr>
                @endforeach
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
</div>
<div class="modal fade" id="cancelModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog form-block">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">دلیل لغو/تکمیل قرارداد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('contract-deactive') }}" id="contract_cancel_form" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-1 form-group">
                        <input type="hidden" name="id">
                        <label class="mb-1">دلیل لغو/تکمیل قرارداد</label>
                        <textarea class="form-control" name="status_reason" cols="30" rows="10" placeholder="دلیل لغو/تکمیل قرارداد را بنوسید"></textarea>
                        <div class="invalid-feedback status_reason_error"></div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-outline-primary btn-sm btn-form-block"><span class="fa fa-save"></span></button>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"><span class="fa fa-times"></span></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal modal-slide-in fade pop_up_modal" id="modals-slide-in">
    <div class="modal-dialog sidebar-xxl form-block">
        <form class="add-new-record modal-content pt-0 form-block" id="contract_store_form" method="POST" action="{{ route('contract-store') }}">
            @csrf
            <input type="hidden" name="organization_id" value="{{ $organization_id }}" />
            <input type="hidden" name="contract_id" />
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="contractModalLabel"></h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="row">
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">مرجع قرارداد</label>
                        <input type="text" class="form-control" name="contract_reference" />
                        <div class="invalid-feedback contract_reference_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">موقعیت قرارداد</label>
                        <input type="text" class="form-control" name="contract_location" />
                        <div class="invalid-feedback contract_location_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">تاریخ شروع قرارداد</label>
                        <input type="text" class="form-control farsi-date-picker" name="start_date" />
                        <div class="invalid-feedback start_date_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">تاریخ ختم قرارداد</label>
                        <input type="text" class="form-control farsi-date-picker" name="end_date" />
                        <div class="invalid-feedback end_date_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">تعداد پرسونل افغانی</label>
                        <input type="text" class="form-control" name="afghan_employee_number" />
                        <div class="invalid-feedback afghan_employee_number_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">تعداد پرسونل خارجی</label>
                        <input type="text" class="form-control" name="foreign_employee_number" />
                        <div class="invalid-feedback foreign_employee_number_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">تعداد سلاح</label>
                        <input type="text" class="form-control" name="weapon_quantity" />
                        <div class="invalid-feedback weapon_quantity_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">تعداد وسایط</label>
                        <input type="text" class="form-control" name="vehicle_quantity" />
                        <div class="invalid-feedback vehicle_quantity_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">تعداد مخابره</label>
                        <input type="text" class="form-control" name="radio_quantity" />
                        <div class="invalid-feedback radio_quantity_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">ارزش پولی</label>
                        <input type="text" class="form-control" name="cost" />
                        <div class="invalid-feedback cost_error"></div>
                    </div>
                    <div class="mb-1">
                        <label class="mb-1">سایر تجهیزات</label>
                        <textarea name="comment" class="form-control"></textarea>
                    </div>
                    <div class="mb-1">
                        <label class="mb-1">کاپی قرارداد و ضمایم</label>
                        <input type="file" class="form-control-file to_hide" accept="application/pdf" name="attachments">
                        <div class="invalid-feedback attachments_error"></div>
                    </div>
                    <p class="attachments"></p>
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
    $(document).on('click', '.contract_approve_btn', function() {
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
                $.get("{{ route('contract-approve') }}/" + $(this).attr('data-id'), function(data) {
                    if (data) {
                        success_msg("تایید گردید");
                        $('.load_btn[data-route="contracts"]').click();
                    }
                }).fail(function(error) {
                    error_msg("لطفا دوباره کوشش نمایید");
                });
            }
        });
    });

    $(document).on('click', '.contract_reject_btn', function() {
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
                $.get("{{ route('contract-reject') }}/" + $(this).attr('data-id'), function(data) {
                    if (data) {
                        success_msg("رد گردید");
                        $('.load_btn[data-route="contracts"]').click();
                    }
                }).fail(function(error) {
                    error_msg("لطفا دوباره کوشش نمایید");
                });
            }
        });
    });

    $(document).on('click', '.contract_edit_btn', function(e) {
        $('#contractModalLabel').html('تغییر مشخصات قرارداد');
        $('input').prop('disabled', false);
        $('select').prop('disabled', false);
        $('.to_hide').removeClass('d-none');
        $('input[name=contract_id]').val($(this).attr('data-id'));
        $('input[name=contract_reference]').val($(this).attr('data_contract_reference'));
        $('input[name=contract_location]').val($(this).attr('data_contract_location'));
        $('input[name=start_date]').val($(this).attr('data_start_date'));
        $('input[name=end_date]').val($(this).attr('data_end_date'));
        $('input[name=afghan_employee_number]').val($(this).attr('data_afghan_employee_number'));
        $('input[name=foreign_employee_number]').val($(this).attr('data_foreign_employee_number'));
        $('input[name=weapon_quantity]').val($(this).attr('data_weapon_quantity'));
        $('input[name=vehicle_quantity]').val($(this).attr('data_vehicle_quantity'));
        $('input[name=radio_quantity]').val($(this).attr('data_radio_quantity'));
        $('input[name=cost]').val($(this).attr('data_cost'));
        $('textarea[name=comment]').html($(this).attr('data_comment'));
        $('input').prop('disabled', false);
        $('select').prop('disabled', false);
        $('.to_hide').removeClass('d-none');
        $('p.show_cancel_reason').html($(this).attr('data_cancel_reason'));
        $('<a>', {
            text: 'دیدن ضمایم',
            title: 'دیدن ضمایم',
            href: $(this).attr('data_attachments'),
            target: '_blank'
        }).appendTo('.attachments');
        $('.pop_up_modal').modal('show');
    });

    $(document).on('click', '.contaract_view_btn', function(e) {
        $('#contractModalLabel').html('نمایش مشخصات قرارداد');
        $('input[name=contract_id]').val($(this).attr('data-id'));
        $('input[name=contract_reference]').val($(this).attr('data_contract_reference'));
        $('input[name=contract_location]').val($(this).attr('data_contract_location'));
        $('input[name=start_date]').val($(this).attr('data_start_date'));
        $('input[name=end_date]').val($(this).attr('data_end_date'));
        $('input[name=afghan_employee_number]').val($(this).attr('data_afghan_employee_number'));
        $('input[name=foreign_employee_number]').val($(this).attr('data_foreign_employee_number'));
        $('input[name=weapon_quantity]').val($(this).attr('data_weapon_quantity'));
        $('input[name=vehicle_quantity]').val($(this).attr('data_vehicle_quantity'));
        $('input[name=radio_quantity]').val($(this).attr('data_radio_quantity'));
        $('input[name=cost]').val($(this).attr('data_cost'));
        $('textarea[name=comment]').html($(this).attr('data_comment'));
        $('input').prop('disabled', true);
        $('select').prop('disabled', true);
        $('.to_hide').addClass('d-none');
        $('p.show_cancel_reason').html($(this).attr('data_cancel_reason'));
        $('<a>', {
            text: 'دیدن ضمایم',
            title: 'دیدن ضمایم',
            href: $(this).attr('data_attachments'),
            target: '_blank'
        }).appendTo('.attachments');
        $('.pop_up_modal').modal('show');

    });

    $(document).on('click', '.contract_cancel_btn', function() {
        $('input[name=id]').val($(this).attr('data-id'));
        $('#cancelModal').modal('show');
    });

    var submit_btn = false;
    $(document).on('submit', '#contract_store_form', function(event) {
        event.preventDefault();
        if (!submit_btn) {
            data = new FormData($("#contract_store_form")[0]);
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
                        submit_btn = false;
                        $('.form-block').unblock();
                        success_msg($('input[name=contract_id]').val() == 0 ? "موفقانه ثبت شد" : "موفقانه تغییر نمود");
                        $('.load_btn[data-route="contracts"]').click();
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
    $(document).on('submit', '#contract_cancel_form', function(event) {
        event.preventDefault();
        if (!submit_btn_1) {
            data = new FormData($("#contract_cancel_form")[0]);
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
                        $('.load_btn[data-route="contracts"]').click();
                        $('.form-block').unblock();
                        submit_btn_1 = false;
                        success_msg("موفقانه لغو/تکمیل شد");
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
        $('input[name=contract_id]').val('0');
        $('input[name=organization_id]').val(organization_id);
        $('#contractModalLabel').html('قرارداد جدید');
        $('.pop_up_modal').modal('show');
    });
</script>
