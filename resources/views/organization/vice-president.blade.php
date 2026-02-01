<style>
    .modal-dialog {
        width: 100% !important;
    }
</style>

<div class="card-header">
    <h4 class="card-title">لست معاونین</h4>
    @if (auth()->user()->role_id == 2)
        <button class="btn btn-primary show_modal" id="new_president_btn"><span data-feather='plus'></span>معاون
            جدید</button>
    @endif
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="datatables-ajax table">
            <thead class="table-dark">
                <tr>
                    <th>شماره</th>
                    <th>اسم</th>
                    <th>تخلص</th>
                    <th>ایمیل</th>
                    <th>حالت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @php $new_btn = 0; @endphp
                @foreach ($presidents as $item)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $item->name_dr }}</td>
                        <td>{{ $item->last_name_dr }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{!! $item->status == 1
                            ? '<span class="badge bg-success ps-1 pe-1">فعال</span>'
                            : '<span class="badge bg-dark ps-1 pe-1 ">تبدیل شده است</span>' !!}
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
                            <button type="button" class="btn btn-outline-primary btn-sm vice_president_view_btn round"
                                data-id="{{ $item->id }}" data_name_dr="{{ $item->name_dr }}"
                                data_grand_father_name="{{ $item->grand_father_name }}"
                                data_last_name_dr="{{ $item->last_name_dr }}"
                                data_current_job="{{ $item->current_job }}" data_father_name="{{ $item->father_name }}"
                                data_tin="{{ $item->tin }}" data_family_contact_no="{{ $item->family_contact_no }}"
                                data_contact_no="{{ $item->contact_no }}" data_nid_pass_no="{{ $item->nid_pass_no }}"
                                data_country_id="{{ $item->country_id }}"data_permanent_province_id="{{ $item->permanent_province_id }}"
                                data_permanent_district_id="{{ $item->permanent_district_id }}"
                                data_permanent_village="{{ $item->permanent_village }}"
                                data_city="{{ $item->city }}" data_street_no="{{ $item->street_no }}"
                                data_street_no="{{ $item->street_no }}"
                                data_main_office_address="{{ $item->main_office_address }}"
                                data_main_office_address="{{ $item->main_office_address }}"
                                data_current_province_id="{{ $item->current_province_id }}"
                                data_current_district_id="{{ $item->current_district_id }}"
                                data_current_village="{{ $item->current_village }}"
                                data_img="{{ URL::asset('storage/vice_president_images/' . $item->image) }}"
                                data_status_reason="{{ $item->status_reason }}"><span
                                    class="fa fa-eye"></span></button>
                            @if ($item->is_approved != 1 && auth()->user()->role_id == 2)
                                <button type="button" class="btn btn-outline-dark btn-sm round vice_president_edit_btn"
                                    data-id="{{ $item->id }}" data_name_dr="{{ $item->name_dr }}"
                                    data_grand_father_name="{{ $item->grand_father_name }}"
                                    data_last_name_dr="{{ $item->last_name_dr }}"
                                    data_current_job="{{ $item->current_job }}"
                                    data_father_name="{{ $item->father_name }}" data_tin="{{ $item->tin }}"
                                    data_family_contact_no="{{ $item->family_contact_no }}"
                                    data_contact_no="{{ $item->contact_no }}"
                                    data_nid_pass_no="{{ $item->nid_pass_no }}"
                                    data_country_id="{{ $item->country_id }}"data_permanent_province_id="{{ $item->permanent_province_id }}"
                                    data_permanent_district_id="{{ $item->permanent_district_id }}"
                                    data_permanent_village="{{ $item->permanent_village }}"
                                    data_city="{{ $item->city }}" data_street_no="{{ $item->street_no }}"
                                    data_street_no="{{ $item->street_no }}"
                                    data_main_office_address="{{ $item->main_office_address }}"
                                    data_main_office_address="{{ $item->main_office_address }}"
                                    data_current_province_id="{{ $item->current_province_id }}"
                                    data_current_district_id="{{ $item->current_district_id }}"
                                    data_current_village="{{ $item->current_village }}"
                                    data_img="{{ URL::asset('storage/vice_president_images/' . $item->image) }}"><span
                                        class="fa fa-edit"></span></button>
                            @endif
                            @if ($item->status == 1)
                                <button type="button"
                                    class="btn btn-outline-danger btn-sm round vice_president_cancel_btn"
                                    data-id="{{ $item->id }}"><span class="fa fa-trash"></span></button>
                            @endif
                            @if ($item->is_approved == 0)
                                {{-- <a href='#' class='me-1 vice_president_approve_btn' style='cursor: pointer;' data-id="{{ $item->id }}"><span class='btn btn-outline-success btn-sm waves-effect round fa fa-check'></span></a> --}}
                                {{-- <a href='#' class='me-1 vice_president_reject_btn' style='cursor: pointer;' data-id="{{ $item->id }}"><span class='btn btn-outline-primary btn-sm waves-effect round fa fa-times'></span></a> --}}
                            @endif
                        </th>
                    </tr>
                    @if ($item->status == 1)
                        <script>
                            var btn = document.getElementById('new_president_btn');
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
                <h5 class="modal-title" id="exampleModalLabel">دلیل تبدیل معاون</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('vice-president-deactive') }}" id="vice_president_cancel_form" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-1 form-group">
                        <input type="hidden" name="id">
                        <label class="mb-1">دلیل تبدیل معاون</label>
                        <textarea class="form-control" name="status_reason" id="" cols="30" rows="10"
                            placeholder="دلیل تبدیل معاون را بنوسید"></textarea>
                        <div class="invalid-feedback status_reason_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12">
                        <label class="w-100">ضمایم</label>
                        <input type="file" class="form-control-file" name="status_attachments">
                        <div class="invalid-feedback status_attachments_error"></div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-outline-primary btn-sm btn-form-block"><span
                            class="fa fa-save"></span></button>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"><span
                            class="fa fa-times"></span></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal modal-slide-in fade pop_up_modal" id="modals-slide-in">
    <div class="modal-dialog sidebar-xxl form-block">
        <form class="add-new-record modal-content pt-0 form-block" id="vice_president_store_form" method="POST"
            action="{{ route('vice-president-store') }}">
            @csrf
            <input type="hidden" name="organization_id" value="{{ $organization_id }}" />
            <input type="hidden" name="vice_president_id" />
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="vicePresidentModalLabel"></h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="row">
                    <div class="mb-1 col-sm-12 col-md-3">
                        <label class="mb-1">اسم</label>
                        <input type="text" class="form-control" name="name_dr" />
                        <div class="invalid-feedback name_dr_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-3">
                        <label class="mb-1">تخلص</label>
                        <input type="text" class="form-control" name="last_name_dr" />
                        <div class="invalid-feedback last_name_dr_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-3">
                        <label class="mb-1">اسم پدر</label>
                        <input type="text" class="form-control" name="father_name" />
                        <div class="invalid-feedback father_name_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-3">
                        <label class="mb-1">اسم پدرکلان</label>
                        <input type="text" class="form-control" name="grand_father_name" />
                        <div class="invalid-feedback father_name_error"></div>
                    </div>
                    {{-- <div class="mb-1 col-sm-12 col-md-3">
                        <label class="mb-1">اسم انگلیسی</label>
                        <input type="text" class="form-control" name="name_en" />
                        <div class="invalid-feedback name_en_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-3">
                        <label class="mb-1">تخلص انگلیسی</label>
                        <input type="text" class="form-control" name="last_name_en" />
                        <div class="invalid-feedback last_name_en_error"></div>
                    </div> --}}

                    {{-- <div class="mb-1 col-sm-12 col-md-2">
                        <label class="mb-1">ایمیل</label>
                        <input type="text" class="form-control" name="email" />
                        <div class="invalid-feedback email_error"></div>
                    </div> --}}
                    <div class="mb-1 col-sm-12 col-md-2">
                        <label class="mb-1">نمبر تذکره/پاسپورت</label>
                        <input type="text" class="form-control" name="nid_pass_no" />
                        <div class="invalid-feedback nid_pass_no_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-4">
                        <label class="mb-1">وظیفه فعلی</label>
                        <input type="text" class="form-control" name="current_job" />
                        <div class="invalid-feedback contact_no_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-2">
                        <label class="mb-1">شماره تماس</label>
                        <input type="text" maxlength="10" class="form-control" name="contact_no" />
                        <div class="invalid-feedback contact_no_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-2">
                        <label class="mb-1">شماره تماس عقارب</label>
                        <input type="text" maxlength="10" class="form-control" name="family_contact_no" />
                        <div class="invalid-feedback family_contact_no_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-2">
                        <label class="mb-1">نمبر تشخصیه (TIN)</label>
                        <input type="text" class="form-control" name="tin" />
                        <div class="invalid-feedback tin_error"></div>
                    </div>
                    {{-- <div class="mb-1 col-sm-12 col-md-3">
                        <label class="mb-1">کشور</label>
                        <select name="country_id" id="country_id" class="form-control select2">
                            <option value="">کشور را انتخاب نمایید</option>
                            @foreach ($countries as $item)
                                <option value="{{ $item->id }}">{{ $item->name_dr }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback country_id_error"></div>
                    </div> --}}
                </div>
                <h4 class="d-none permanent_resident">سکونت اصلی</h4>
                <div class="row show_div_if_afghan">
                    <div class="mb-1 col-sm-12 col-md-4">
                        <label class="mb-1">ولایت</label>
                        <select name="permanent_province_id" id="permanent_province_id" pro-type="permanent"
                            class="form-control select2 province btn-form-block">
                            <option value="">ولایت را انتخاب نمایید</option>
                            @foreach ($provinces as $item)
                                <option value="{{ $item->id }}">{{ $item->name_dr }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback permanent_province_id_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-4">
                        <label class="mb-1">ولسوالی</label>
                        <select name="permanent_district_id" id="permanent_district_id" class="form-control select2">
                            <option value="">ولسوالی را انتخاب نمایید</option>
                        </select>
                        <div class="invalid-feedback permanent_district_id_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-4">
                        <label class="mb-1">قریه</label>
                        <input type="text" class="form-control" name="permanent_village" />
                        <div class="invalid-feedback permanent_village_error"></div>
                    </div>
                </div>
                {{-- <div class="row show_div_if_foreign d-none">
                    <div class="mb-1 col-sm-12 col-md-4">
                        <label class="mb-1">شهر</label>
                        <input type="text" class="form-control" name="city" />
                        <div class="invalid-feedback city_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-4">
                        <label class="mb-1">نمبر سرک</label>
                        <input type="text" class="form-control" name="street_no" />
                        <div class="invalid-feedback street_no_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-4">
                        <label class="mb-1">آدرس دفتر مرکزی</label>
                        <input type="text" class="form-control" name="main_office_address" />
                        <div class="invalid-feedback main_office_address_error"></div>
                    </div>
                </div> --}}
                <h4>سکونت فعلی</h4>
                <div class="row">
                    <div class="mb-1 col-sm-12 col-md-4">
                        <label class="mb-1">ولایت</label>
                        <select name="current_province_id" id="current_province_id" pro-type="current"
                            class="form-control select2 province btn-form-block">
                            <option value="">ولایت را انتخاب نمایید</option>
                            @foreach ($provinces as $item)
                                <option value="{{ $item->id }}">{{ $item->name_dr }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback current_province_id_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-4">
                        <label class="mb-1">ولسوالی</label>
                        <select name="current_district_id" id="current_district_id" class="form-control select2">
                            <option value="">ولسوالی را انتخاب نمایید</option>
                        </select>
                        <div class="invalid-feedback current_district_id_error"></div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-4">
                        <label class="mb-1">قریه</label>
                        <input type="text" class="form-control" name="current_village" />
                        <div class="invalid-feedback current_village_error"></div>
                    </div>

                    <div class="mb-1 col-sm-12 col-md-4">
                        <label for="" class="mb-2">عکس رییس</label>
                        <div class="d-flex">
                            <a href="#" class="me-25">
                                <img src="{{ asset('user_default.jpg') }}" id="product-img"
                                    class="upload-product rounded me-50" alt="product image" height="100"
                                    width="100" />
                            </a>
                            <!-- upload and reset button -->
                            <div class="d-flex align-items-end mt-75 ms-1">
                                <div>
                                    <label for="product-upload"
                                        class="btn btn-sm btn-primary mb-75 me-75 to_hide">انتخاب</label>
                                    <input type="file" id="product-upload" name="image" hidden
                                        accept="image/*" />
                                    <div class="invalid-feedback image_error"></div>
                                    <button type="button" id="product-reset"
                                        class="btn btn-sm btn-outline-secondary mb-75 to_hide">حذف</button>
                                    <p class="mb-0 to_hide">عکس به فارمت های jpg,jpeg,png باشد</p>
                                </div>
                            </div>
                            <!--/ upload and reset button -->
                        </div>
                    </div>
                    <div class="mb-1 col-sm-12 col-md-4">
                        <label class="w-100 mb-3">ضمایم</label>
                        <input type="file" class="form-control-file" name="attachments" accept="application/pdf">
                        <div class="invalid-feedback attachments_error"></div>
                    </div>
                    <div class="mb-1">
                        <p class="show_cancel_reason"></p>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary btn-sm me-1 btn-form-block to_hide"><span
                        class="fa fa-save"></span></button>
                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"><span
                        class="fa fa-times"></span></button>
            </div>

        </form>
    </div>
</div>

@include('organization.general_scripts')
@include('organization.blockui')

<script>
    $(document).on('click', '.vice_president_approve_btn', function() {
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
                $.get("{{ route('vice-president-approve') }}/" + $(this).attr('data-id'), function(
                    data) {
                    if (data) {
                        success_msg("تایید گردید");
                        $('.load_btn[data-route="vice-presidents"]').click();
                    }
                }).fail(function(error) {
                    error_msg("لطفا دوباره کوشش نمایید");
                });
            }
        });
    });

    $(document).on('click', '.vice_president_reject_btn', function() {
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
                $.get("{{ route('vice-president-reject') }}/" + $(this).attr('data-id'), function(
                data) {
                    if (data) {
                        success_msg("رد گردید");
                        $('.load_btn[data-route="vice-presidents"]').click();
                    }
                }).fail(function(error) {
                    error_msg("لطفا دوباره کوشش نمایید");
                });
            }
        });
    });

    $(document).on('change', '.province', function(event) {
        var provinceType = $(this).attr('pro-type');
        $.ajax({
            url: "{{ route('province_districts') }}",
            type: 'GET',
            data: {
                'id': $(this).val()
            },
            dataType: 'html',
            beforeSend: function() {},
            success: function(data) {
                var districts = JSON.parse(data);
                var value = `<option value="">--انتخاب ولسوالی--</option>`;
                districts.forEach(item => {
                    value += `<option value="` + item.id + `">` + item.name_dr +
                    `</option>`;
                });

                provinceType == 'permanent' ? $('#permanent_district_id').html(value) : $(
                    '#current_district_id').html(value);
            },
            error: function() {
                error_function("لطفا دوباره کوشش نمایید");
            }
        });
    });

    $(document).on('change', '#country_id', function() {
        country_id = $(this).val();
        if (country_id == 1) {
            $('.show_div_if_afghan').removeClass('d-none');
            $('.permanent_resident').removeClass('d-none');
            $('.show_div_if_foreign').addClass('d-none');
        } else {
            $('.permanent_resident').removeClass('d-none');
            $('.show_div_if_foreign').removeClass('d-none');
            $('.show_div_if_afghan').addClass('d-none');
        }
    });
    $(document).on('click', '.vice_president_edit_btn', function(e) {
        $('p.show_cancel_reason').html('');
        $('#vicePresidentModalLabel').html('تغییر مشخصات معاون');
        $('input').prop('disabled', false);
        $('select').prop('disabled', false);
        $('.to_hide').removeClass('d-none');
        $('input[name=vice_president_id]').val($(this).attr('data-id'));
        $('input[name=name_dr]').val($(this).attr('data_name_dr'));
        $('input[name=last_name_dr]').val($(this).attr('data_last_name_dr'));
        $('input[name=father_name]').val($(this).attr('data_father_name'));
        $('input[name=grand_father_name]').val($(this).attr('data_grand_father_name'));
        $('input[name=current_job]').val($(this).attr('data_current_job'));
        $('input[name=tin]').val($(this).attr('data_tin'));
        $('input[name=contact_no]').val($(this).attr('data_contact_no'));
        $('input[name=family_contact_no]').val($(this).attr('data_family_contact_no'));
        $('input[name=nid_pass_no]').val($(this).attr('data_nid_pass_no'));
        $('select[name=country_id]').select2('val', $(this).attr('data_country_id'));
        $('.upload-product').attr('src', $(this).attr('data_img'));
        setTimeout(() => {
            $('select[name=current_district_id]').val($(this).attr('data_current_district_id')).trigger(
                'change');
        }, 800);
        $('select[name=permanent_province_id]').select2('val', $(this).attr('data_permanent_province_id'));
        $('input[name=permanent_village]').val($(this).attr('data_permanent_village'));
        $('select[name=current_province_id]').select2('val', $(this).attr('data_current_province_id'));
        $('input[name=current_village]').val($(this).attr('data_current_village'));
        setTimeout(() => {
            $('select[name=permanent_district_id]').val($(this).attr('data_permanent_district_id'))
                .trigger('change');
        }, 800);
        $('.pop_up_modal').modal('show');
    });

    $(document).on('click', '.vice_president_view_btn', function(e) {
        $('#vicePresidentModalLabel').html('نمایش مشخصات معاون');
        $('input[name=vice_president_id]').val($(this).attr('data-id'));
        $('input[name=name_dr]').val($(this).attr('data_name_dr'));
        $('input[name=last_name_dr]').val($(this).attr('data_last_name_dr'));
        $('input[name=father_name]').val($(this).attr('data_father_name'));
        $('input[name=grand_father_name]').val($(this).attr('data_grand_father_name'));
        $('input[name=current_job]').val($(this).attr('data_current_job'));
        $('input[name=tin]').val($(this).attr('data_tin'));
        $('input[name=contact_no]').val($(this).attr('data_contact_no'));
        $('input[name=family_contact_no]').val($(this).attr('data_family_contact_no'));
        $('input[name=nid_pass_no]').val($(this).attr('data_nid_pass_no'));
        $('select[name=country_id]').select2('val', $(this).attr('data_country_id'));
        $('.upload-product').attr('src', $(this).attr('data_img'));
        setTimeout(() => {
            $('select[name=current_district_id]').val($(this).attr('data_current_district_id')).trigger(
                'change');
        }, 800);
        $('select[name=permanent_province_id]').select2('val', $(this).attr('data_permanent_province_id'));
        $('input[name=permanent_village]').val($(this).attr('data_permanent_village'));
        $('select[name=current_province_id]').select2('val', $(this).attr('data_current_province_id'));
        $('input[name=current_village]').val($(this).attr('data_current_village'));
        setTimeout(() => {
            $('select[name=permanent_district_id]').val($(this).attr('data_permanent_district_id'))
                .trigger('change');
        }, 800);
        $('input').prop('disabled', true);
        $('select').prop('disabled', true);
        $('.to_hide').addClass('d-none');
        $('p.show_cancel_reason').html($(this).attr('data_status_reason'));
        $('.pop_up_modal').modal('show');

    });

    $(document).on('click', '.vice_president_cancel_btn', function() {
        $('input[name=id]').val($(this).attr('data-id'));
        $('#cancelModal').modal('show');
    });

    var submit_btn = false;
    $(document).on('submit', '#vice_president_store_form', function(event) {
        event.preventDefault();
        if (!submit_btn) {
            data = new FormData($("#vice_president_store_form")[0]);
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
                        success_msg($('input[name=vice_president_id]').val() == 0 ?
                            "موفقانه ثبت شد" : "موفقانه تغییر نمود");
                        $('.load_btn[data-route="vice-presidents"]').click();
                        $('div.modal-backdrop.fade.show').remove();
                        $('body').removeClass('modal-open');
                        submit_btn = false;
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

    var submit_btn_1 = false;
    $(document).on('submit', '#vice_president_cancel_form', function(event) {
        event.preventDefault();
        if (!submit_btn_1) {
            data = new FormData($("#vice_president_cancel_form")[0]);
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
                        $('.load_btn[data-route="vice-presidents"]').click();
                        $('.form-block').unblock();
                        submit_btn_1 = false;
                        success_msg("موفقانه تبدیل شد");
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

    $('.show_modal').click(function() {
        let organization_id = $('input[name=organization_id]').val();
        $('input').prop('disabled', false);
        $('select').prop('disabled', false);
        $('.to_hide').removeClass('d-none');
        $("input[name!=_token]").val('');
        $('input[name=vice_president_id]').val('0');
        $('input[name=organization_id]').val(organization_id);
        $('#vicePresidentModalLabel').html('معاون جدید');
        $('.pop_up_modal').modal('show');
    });
</script>
