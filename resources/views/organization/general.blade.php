@extends('layouts.app')
@section('header')
    {{$organization->type == 1 ? 'کمپنی' : 'دوکان'}} {{ $organization->name_dr }}
@endsection
@section('content')
    <div class="card-header border-bottom form-block">
        @if ($organization->type == 1)
        <button class="btn btn-outline-primary load_btn btn-form-block" data-route="presidents" data-id="{{ encode_organization_id($organization->id) }}"><span class="fa fa-user-check"></span> رییس</button>
        <button class="btn btn-outline-primary load_btn btn-form-block" data-route="vice-presidents" data-id="{{ encode_organization_id($organization->id) }}"><span class="fa fa-user"></span> معاون</button>
        <button class="btn btn-outline-primary load_btn btn-form-block" data-route="licenses" data-id="{{ encode_organization_id($organization->id) }}"><span class="fa fa-credit-card"></span> جواز </button>
        @endif
        @if ($organization->type == 2)
        <button class="btn btn-outline-primary load_btn btn-form-block" data-route="presidents" data-id="{{ encode_organization_id($organization->id) }}"><span class="fa fa-user-check"></span> مسعول دوکان</button>
        <button class="btn btn-outline-primary load_btn btn-form-block" data-route="licenses" data-id="{{ encode_organization_id($organization->id) }}"><span class="fa fa-credit-card"></span> جواز </button>
        @endif
        {{-- <div class="btn-group">
            <button class="btn btn-outline-primary dropdown-toggle emp_btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"> <span class="fa fa-users"></span>
                کارمندان
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <button class="dropdown-item load_btn btn-form-block w-100" data-route="employees" data-id="{{ encode_organization_id($organization->id) }}">لست کارمندان </button>
                <button class="dropdown-item load_btn btn-form-block w-100" data-route="employee-payments" data-id="{{ encode_organization_id($organization->id) }}">فیس کارمندان</button>
                <button class="dropdown-item load_btn btn-form-block w-100" data-route="employee-attachments" data-id="{{ encode_organization_id($organization->id) }}">لست جدول کارمندان</button>
                <button class="dropdown-item load_btn btn-form-block w-100" data-route="employee-fired-list" data-id="{{ encode_organization_id($organization->id) }}">لست کارمندان منفک شده</button>
            </div>
        </div>
        <div class="btn-group">
            <button class="btn btn-outline-primary dropdown-toggle weapon_btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"> <span class="fa fa-newspaper"></span>
                سلاح
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <button class="dropdown-item load_btn btn-form-block w-100" data-route="weapons" data-id="{{ encode_organization_id($organization->id) }}">لست سلاح </button>
                <button class="dropdown-item load_btn btn-form-block w-100" data-route="weapon-payments" data-id="{{ encode_organization_id($organization->id) }}">فیس سلاح</button>
                <button class="dropdown-item load_btn btn-form-block w-100" data-route="weapon-attachments" data-id="{{ encode_organization_id($organization->id) }}">لست جدول سلاح</button>
                <button class="dropdown-item load_btn btn-form-block w-100" data-route="unused-weapons-list" data-id="{{ encode_organization_id($organization->id) }}">لست سلاح تسلیم شده</button>
            </div>
        </div>
        <div class="btn-group">
            <button class="btn btn-outline-primary dropdown-toggle vehicle_btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"> <span class="fa fa-car"></span>
                عراده جات
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <button class="dropdown-item load_btn btn-form-block w-100" data-route="vehicles" data-id="{{ encode_organization_id($organization->id) }}"> عراده جات</button>
                <button class="dropdown-item load_btn btn-form-block w-100" data-route="vehicle-attachments" data-id="{{ encode_organization_id($organization->id) }}">لست جدول عراده جات</button>
            </div>
        </div>
        <button class="btn btn-outline-primary load_btn btn-form-block" data-route="contracts" data-id="{{ encode_organization_id($organization->id) }}"><span class="fa fa-copy"></span> خلاصه قرارداد</button> --}}
    </div>
    <div class="card m-1" id="show_form"></div>
@endsection
@section('scripts')
    @include('organization.blockui')
    @if (session()->has('success_print'))
        <script>
            success_msg("{{ session()->get('success_print') }}");
        </script>
    @endif
    @if (session()->has('success_project_completed'))
        <script>
            success_msg("{{ session()->get('success_project_completed') }}");
        </script>
    @endif
    <script>
        $(document).on('click', '.load_btn', function() {
            var route = $(this).attr('data-route');
            var base_url = window.location.origin + '/' + route;
            $('.load_btn').removeClass('btn-primary text-white');

            if (route == 'employees' || route == 'employee-payments' || route == 'employee-fired-list' || route == 'employee-attachments') {
                $('.emp_btn').addClass('btn-primary text-white');
            } else {
                $('.emp_btn').removeClass('btn-primary text-white');
            }
            if (route == 'weapons' || route == 'weapon-payments' || route == 'unused-weapons-list' || route == 'weapon-attachments') {
                $('.weapon_btn').addClass('btn-primary text-white');
            } else {
                $('.weapon_btn').removeClass('btn-primary text-white');
            }
            if (route == 'vehicles' || route == 'vehicle-attachments') {
                $('.vehicle_btn').addClass('btn-primary text-white');
            } else {
                $('.vehicle_btn').removeClass('btn-primary text-white');
            }

            $('.load_btn[data-route="' + route + '"]').addClass('btn-primary text-white');
            $.ajax({
                url: base_url + "/" + $(this).attr('data-id'),
                method: 'GET',
                beforeSend: function() {},
                success: function(response) {
                    $('.form-block').unblock();
                    $('#show_form').html(response);
                }
            });
        });
    </script>
@endsection
