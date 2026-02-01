<style>
    .modal-dialog {
        width: 50% !important;
    }
</style>
<div class="card-header">
    <h4 class="card-title">لست جدول وسایط</h4>
    @if (auth()->user()->role_id == 2)
        <button class="btn btn-primary show_modal"><span class="fa fa-dollar-sign"> </span> ثبت جدول وسایط </button>
    @endif
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="datatables-ajax table">
            <thead class="table-dark">
                <tr>
                    <th>شماره</th>
                    <th>تعداد وسایط</th>
                    <th>وسایط باقیمانده</th>
                    <th>ضمایم</th>
                    <th>حالت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @php $new_btn = 0; @endphp
                @foreach ($vehicle_attachments as $item)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $item->vehicle_number }}</td>
                        <td>{{ $item->remain_vehicle_number }}</td>
                        <td><a href="{{ URL::asset('storage/vehicle_attachments/' . $item->attachments) }}">دیدن ضمایم</a></td>
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
                        <th class="text-center">
                            @if ($item->is_approved != 1 && auth()->user()->role_id == 2)
                                <button type="button" class="btn btn-outline-dark btn-sm round vehicle_payment_edit_btn" data-id="{{ $item->id }}" data_vehicle_number="{{ $item->vehicle_number }}"><span class="fa fa-edit"></span></button>
                            @endif
                            @if (auth()->user()->role_id == 4)
                                <a href='#' class='me-1 vehicle_attachment_approve_btn' style='cursor: pointer;' data-id="{{ $item->id }}"><span class='btn btn-outline-success btn-sm waves-effect round fa fa-check'></span></a>
                                <a href='#' class='me-1 vehicle_attachment_reject_btn' style='cursor: pointer;' data-id="{{ $item->id }}"><span class='btn btn-outline-primary btn-sm waves-effect round fa fa-times'></span></a>
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
    <div class="modal-dialog sidebar-xxl form-block" style="width:30% !important;">
        <form class="add-new-record modal-content pt-0 form-block" id="vehicle_store_form_3" method="POST" action="{{ route('vehicle-attachment-store') }}">
            @csrf
            <input type="hidden" name="organization_id" value="{{ $organization_id }}" />
            <input type="hidden" name="vehicle_attachment_id" />
            <div class="modal-header mb-1">
                <h5 class="modal-title"> ثبت جدول وسایط</h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="row">
                    <div class="mb-1">
                        <label class="mb-1">تعداد وسایط</label>
                        <input type="text" class="form-control" name="vehicle_number" />
                        <div class="invalid-feedback vehicle_number_error"></div>
                    </div>
                </div>
                <div class="mb-1">
                    <label for="" class="mb-1 w-100">ضمایم</label>
                    <input type="file" class="form-control-file" name="attachments" accept="application/pdf">
                    <div class="invalid-feedback attachments_error"></div>
                </div>
                <button type="submit" class="btn btn-outline-primary btn-sm me-1 btn-form-block"><span class="fa fa-save"></span></button>
                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"><span class="fa fa-times"></span></button>
            </div>

        </form>
    </div>
</div>

@include('organization.general_scripts')
@include('organization.blockui')
<script>
    $(document).on('click', '.vehicle_attachment_approve_btn', function() {
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
                $.get("{{ route('vehicle-attachment-approve') }}/" + $(this).attr('data-id'), function(data) {
                    if (data) {
                        success_msg("تایید گردید");
                        $('.load_btn[data-route="vehicle-attachments"]').click();
                    }
                }).fail(function(error) {
                    error_msg("لطفا دوباره کوشش نمایید");
                });
            }
        });
    });

    $(document).on('click', '.vehicle_attachment_reject_btn', function() {
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
                $.get("{{ route('vehicle-attachment-reject') }}/" + $(this).attr('data-id'), function(data) {
                    if (data) {
                        success_msg("رد گردید");
                        $('.load_btn[data-route="vehicle-attachments"]').click();
                    }
                }).fail(function(error) {
                    error_msg("لطفا دوباره کوشش نمایید");
                });
            }
        });
    });

    $(document).on('click', '.vehicle_payment_edit_btn', function(e) {
        $('#vehicleModalLabel').html('تغییر مشخصات جدول وسایط');
        $('input[name=vehicle_attachment_id]').val($(this).attr('data-id'));
        $('input[name=vehicle_number]').val($(this).attr('data_vehicle_number'));
        $('.pop_up_modal').modal('show');
    });

    var submit_btn_2 = false;
    $(document).on('submit', '#vehicle_store_form_3', function(event) {
        event.preventDefault();
        if (!submit_btn_2) {
            data = new FormData($("#vehicle_store_form_3")[0]);
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
                    submit_btn_2 = true;
                },
                success: function(data) {
                    if (data == true) {
                        $('div.modal-backdrop.fade.show').remove();
                        $('.form-block').unblock();
                        submit_btn_2 = false;
                        success_msg($('input[name=vehicle_attachment_id]').val() == 0 ? "موفقانه ثبت شد" : "موفقانه تغییر نمود");
                        $('.load_btn[data-route="vehicle-attachments"]').click();
                        $('.pop_up_modal').modal('hide');
                    } else {
                        $('.form-block').unblock();
                        var response = JSON.parse(data);
                        $.each(response, function(prefix, val) {
                            $('div.' + prefix + '_error').text(val[0]);
                            $("input[name=" + prefix + "]").addClass('is-invalid');
                        });
                    }
                    submit_btn_2 = false;
                },
                error: function() {
                    $('.form-block').unblock();
                    error_msg("لطفا دوباره کوشش نمایید");
                    submit_btn_2 = false;
                }
            });
        }

    });

    $('.show_modal').click(function() {
        let organization_id = $('input[name=organization_id]').val();
        $('input').prop('disabled', false);
        $('.to_hide').removeClass('d-none');
        $("input[name!=_token]").val('');
        $('input[name=vehicle_attachment_id]').val('0');
        $('input[name=organization_id]').val(organization_id);
        $('#vehicleModalLabel').html('ثبت جدول وسایط');
        $('.pop_up_modal').modal('show');
    });
</script>
