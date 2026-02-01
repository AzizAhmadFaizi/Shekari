<style>
    .modal-dialog {
        width: 50% !important;
    }
</style>

<div class="card-header">
    <h4 class="card-title">لست جواز</h4>
        @if (auth()->user()->role_id == 2)
            <button class="btn btn-primary show_modal" id="new_license_btn"><span data-feather='plus'></span>ثبت جواز</button>
        @endif
    </div>
    <div class="card-body">
    <div class="table-responsive">
        <table class="datatables-ajax table">
            <thead class="table-dark">
                <tr>
                    <th>شماره</th>
                    <th>نوعیت</th>
                    <th>تاریخ صدور</th>
                    <th>تاریخ انقضاء</th>
                    <th>حالت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @php $new_btn = 0; @endphp
                @foreach ($licenses as $item)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $item->license_type_details->name_dr }}</td>
                        <td>{{ to_jalai($item->issue_date) }}</td>
                        <td>{{ to_jalai($item->expire_date) }}</td>
                        <td>
                            {!! $item->status == 1 ? '<span class="badge bg-success ps-1 pe-1">فعال</span>' : '<span class="badge bg-dark ps-1 pe-1 ">لغو شده است</span>' !!}
                            {!! $item->is_printed == 1 ? '<span class="badge bg-primary ps-1 pe-1">چاپ شده</span>' : '<span class="badge bg-dark ps-1 pe-1 ">چاپ نشده</span>' !!}
                            {{-- @switch($item->is_approved)
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
                            @endswitch --}}
                        </td>
                        <th class="text-center">
                            <button type="button" class="btn btn-outline-primary btn-sm license_view_btn round" data-id="{{ $item->id }}" data_license_type_id="{{ $item->license_type_id }}" data_issue_date="{{ to_jalai($item->issue_date) }}" data_expire_date="{{ to_jalai($item->expire_date) }}" data_status_reason="{{ $item->status_reason }}" data_attachment_files="{{ URL::asset('storage/attachment_files/' . $item->attachment_files) }}" data_tariff_no="{{ $item->tariff_no }}" data_tariff_date="{{ to_jalai($item->tariff_date) }}" data_tariff_amount="{{ $item->tariff_amount }}"><span class="fa fa-eye"></span></button>
                            @if ($item->is_approved != 1 && auth()->user()->role_id == 2)
                                <button type="button" class="btn btn-outline-dark btn-sm round license_edit_btn" data-id="{{ $item->id }}" data_license_type_id="{{ $item->license_type_id }}" data_issue_date="{{ to_jalai($item->issue_date) }}" data_expire_date="{{ to_jalai($item->expire_date) }}" data_status_reason="{{ $item->status_reason }}" data_attachment_files="{{ URL::asset('storage/attachment_files/' . $item->attachment_files) }}" data_tariff_no="{{ $item->tariff_no }}" data_tariff_date="{{ to_jalai($item->tariff_date) }}" data_tariff_amount="{{ $item->tariff_amount }}"><span class="fa fa-edit"></span></button>
                            @endif
                            @if ($item->status == 1)
                                <button type="button" class="btn btn-outline-danger btn-sm round license_cancel_btn" data-id="{{ $item->id }}"><span class="fa fa-trash"></span></button>
                            @endif
                            @if ($item->is_printed == 0)
                                <a href="{{ route('license-print', encode_organization_id($item->id)) }}" class="btn btn-outline-secondary btn-sm round"> <span class="fa fa-print"> </span></a>
                            @endif
                            @if ($item->is_approved == 0)
                                {{-- <a href='#' class='me-1 license_approve_btn' style='cursor: pointer;' data-id="{{ $item->id }}"><span class='btn btn-outline-success btn-sm waves-effect round fa fa-check'></span></a> --}}
                                {{-- <a href='#' class='me-1 license_reject_btn' style='cursor: pointer;' data-id="{{ $item->id }}"><span class='btn btn-outline-primary btn-sm waves-effect round fa fa-times'></span></a> --}}
                            @endif
                        </th>
                    </tr>
                    @if ($item->status == 1)
                        <script>
                            var btn = document.getElementById('new_license_btn');
                            btn.outerHTML = "";
                        </script>
                    @endif
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
                <h5 class="modal-title" id="exampleModalLabel">دلیل لغو جواز</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('license-deactive') }}" id="license_cancel_form" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-1 form-group">
                        <input type="hidden" name="id">
                        <label class="mb-1">دلیل لغو جواز</label>
                        <textarea class="form-control" name="status_reason" id="" cols="30" rows="10" placeholder="دلیل لغو جواز را بنوسید"></textarea>
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
        <form class="add-new-record modal-content pt-0 form-block" id="license_store_form" method="POST" action="{{ route('license-store') }}">
            @csrf
            <input type="hidden" name="organization_id" value="{{ $organization_id }}" />
            <input type="hidden" name="organization_type" value="{{ $organization_type }}" />
            <input type="hidden" name="license_id" />
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="licenseModalLabel"></h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="row">
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">نوعیت جواز</label>
                        <select name="license_type_id" id="license_type_id" class="form-control select2">
                            <option value="">نوعیت جواز را انتخاب نمایید</option>
                            @foreach ($license_types as $item)
                                <option value="{{ $item->id }}">{{ $item->name_dr }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback license_type_id_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">تاریخ صدور</label>
                        <input type="text" class="form-control farsi-date-picker" id="issue_date" name="issue_date" autocomplete="off"/>
                        <div class="invalid-feedback issue_date_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">تاریخ اعتبار</label>
                        <input type="text" class="form-control farsi-date-picker" id="expire_date" name="expire_date" autocomplete="off"/>
                        <div class="invalid-feedback expire_date_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">نمبر آویز بانکی</label>
                        <input type="text" class="form-control" name="tariff_no" />
                        <div class="invalid-feedback tariff_no_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">مقدار پول</label>
                        <input type="text" class="form-control" name="tariff_amount"/>
                        <div class="invalid-feedback tariff_amount_error"></div>
                    </div>
                    <div class="form-group mb-1 col-sm-12 col-md-6">
                        <label class="mb-1">تاریخ آویز</label>
                        <input type="text" class="form-control farsi-date-picker" name="tariff_date" autocomplete="off"/>
                        <div class="invalid-feedback tariff_date_error"></div>
                    </div>
                </div>
                <div class="mb-1">
                    <label for="" class="mb-1 to_hide">ضمایم</label>
                    <p class="attachments"></p>
                    <input type="file" class="form-control-file to_hide" name="attachment_files" accept="application/pdf">
                    <div class="invalid-feedback attachment_files_error"></div>
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
    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [year, month, day].join('-');
    }

    $(document).on('change', '#issue_date', function() {
        var date = new Date($(this).val());
        date.setFullYear(date.getFullYear() + 1);
        $('#expire_date').val(formatDate(date));
    });

    $(document).on('click', '.license_approve_btn', function() {
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
                $.get("{{ route('license-approve') }}/" + $(this).attr('data-id'), function(data) {
                    if (data) {
                        success_msg("تایید گردید");
                        $('.load_btn[data-route="licenses"]').click();
                    }
                }).fail(function(error) {
                    error_msg("لطفا دوباره کوشش نمایید");
                });
            }
        });
    });

    $(document).on('click', '.license_reject_btn', function() {
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
                $.get("{{ route('license-reject') }}/" + $(this).attr('data-id'), function(data) {
                    if (data) {
                        success_msg("رد گردید");
                        $('.load_btn[data-route="licenses"]').click();
                    }
                }).fail(function(error) {
                    error_msg("لطفا دوباره کوشش نمایید");
                });
            }
        });
    });

    $(document).on('click', '.license_edit_btn', function(e) {
        $('#licenseModalLabel').html('تغییر مشخصات جواز');
        $('input').prop('disabled', false);
        $('select').prop('disabled', false);
        $('.to_hide').removeClass('d-none');
        $('input[name=license_id]').val($(this).attr('data-id'));
        $('input[name=issue_date]').val($(this).attr('data_issue_date'));
        $('input[name=expire_date]').val($(this).attr('data_expire_date'));
        $('input[name=tariff_amount]').val($(this).attr('data_tariff_amount'));
        $('input[name=tariff_no]').val($(this).attr('data_tariff_no'));
        $('input[name=tariff_date]').val($(this).attr('data_tariff_date'));
        $('select[name=license_type_id]').select2('val', $(this).attr('data_license_type_id'));
        $('.attachments').empty();
        $('<a>', {
            text: 'دیدن ضمایم',
            title: 'دیدن ضمایم',
            href: $(this).attr('data_attachment_files'),
            target: '_blank'
        }).appendTo('.attachments');
        $('.pop_up_modal').modal('show');
    });

    $(document).on('click', '.license_view_btn', function(e) {
        $('#licenseModalLabel').html('نمایش مشخصات جواز');
        $('input[name=issue_date]').val($(this).attr('data_issue_date'));
        $('input[name=expire_date]').val($(this).attr('data_expire_date'));
        $('input[name=tariff_amount]').val($(this).attr('data_tariff_amount'));
        $('input[name=tariff_no]').val($(this).attr('data_tariff_no'));
        $('input[name=tariff_date]').val($(this).attr('data_tariff_date'));
        $('select[name=license_type_id]').select2('val', $(this).attr('data_license_type_id'));
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

    $(document).on('click', '.license_cancel_btn', function() {
        $('input[name=id]').val($(this).attr('data-id'));
        $('#cancelModal').modal('show');
    });

    var submit_btn = false;
    $(document).on('submit', '#license_store_form', function(event) {
        event.preventDefault();
        if (!submit_btn) {
            data = new FormData($("#license_store_form")[0]);
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
                        success_msg($('input[name=license_id]').val() == 0 ? "موفقانه ثبت شد" : "موفقانه تغییر نمود");
                        $('.load_btn[data-route="licenses"]').click();
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
    $(document).on('submit', '#license_cancel_form', function(event) {
        event.preventDefault();
        if (!submit_btn_1) {
            data = new FormData($("#license_cancel_form")[0]);
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
                        $('.load_btn[data-route="licenses"]').click();
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
        $("input[name=tariff_amount]").val('{{$organization_type == 1 ? 200000 : 7000}}');
        $('input[name=license_id]').val('0');
        $('input[name=organization_id]').val(organization_id);
        $('input[name=organization_type]').val('{{ $organization_type }}');
        $('#licenseModalLabel').html('ثبت جواز');
        $('.pop_up_modal').modal('show');
    });
</script>
