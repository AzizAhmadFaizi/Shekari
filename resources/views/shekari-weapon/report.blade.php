@extends('layouts.app')

@section('content')
    <style>
        .custom-card {
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: 0.3s;
            height: 100%;
        }

        .custom-card:hover {
            background-color: #f0f0f0;
        }

        .custom-card-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 15px;
        }

        .custom-card-left {
            display: flex;
            align-items: center;
        }

        .custom-card-icon {
            font-size: 28px;
            margin-right: 15px;
            margin-left: 10px;
            color: #007bff;
        }

        .custom-badge {
            background-color: #007bff;
            color: white;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 16px;
            white-space: nowrap;
        }
    </style>

    <div class="card">
        <div class="card-header">
            <div class="row col-md-12">
                <div class="col-md-6">
                    <button class="btn btn-primary w-100" onclick="showCards('special')">خاص راپور</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-warning w-100" onclick="showCards('general')">عمومی راپور </button>
                </div>
            </div>
        </div>


        <div class="card-body">
            {{-- special Cards for special report راپور خاص --}}
            <div id="specialCards" style="display: none;">
                <form id="filterForm" method="GET" action="{{ route('shekari-weapon-report') }}" class="mb-3 mx-4">
                    <div class="row">
                        <div class="col-sm-12 col-md-3">
                            <label>شرکت ها</label>
                            <select name="organization_id" id="organization_id" pro-type="current"
                                class="form-control select2 province btn-form-block">
                                <option value="">شرکت را انتخاب نمایید</option>
                                @foreach ($organizations as $item)
                                    <option value="{{ $item->id }}"
                                        {{ request('organization_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name_dr }}
                                    </option>
                                @endforeach
                            </select>

                            <div class="invalid-feedback organization_id_error"></div>
                        </div>

                        <div class="col-md-3">
                            <label for="special_report_start_date">تاریخ شروع</label>
                            <input type="text" name="special_report_start_date" id="special_report_start_date"
                                class="form-control farsi-date-picker" placeholder="تاریخ شروع را انتخاب کنید"
                                value="{{ request('special_report_start_date') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="special_report_end_date">تاریخ ختم</label>
                            <input type="text" name="special_report_end_date" id="special_report_end_date"
                                class="form-control farsi-date-picker" placeholder="تاریخ ختم را انتخاب کنید"
                                value="{{ request('special_report_end_date') }}">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-success mx-1"><i class="fas fa-eye"></i>&nbsp;&nbsp;نمایش
                                راپور</button>
                            <button type="button" class="btn btn-info" onclick="resetFilterInputs()"
                                title="پاک کردن فیلترها">
                                <i class="fas fa-undo"></i>
                            </button>
                        </div>

                    </div>
                </form>
                {{-- First Row --}}
                <hr />
                <div class="row">
                    <div class="col-md-6">
                        <div class="custom-card">
                            <div class="custom-card-content d-flex justify-content-between align-items-center">
                                <div class="custom-card-left d-flex align-items-center">
                                    <div class="custom-card-icon me-2">
                                        <i class="fas fa-hashtag"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2 class="mb-0">تعداد</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $special_card_total_quantity }}</span>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="custom-card">
                            <div class="custom-card-content d-flex justify-content-between align-items-center">
                                <div class="custom-card-left d-flex align-items-center">
                                    <div class="custom-card-icon me-2">
                                        <i class="fas fa-money-bill"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2 class="mb-0">عواید</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $special_card_total_revenue }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- general Cards --}}
            <div id="generalCards" style="display: none;">
                <form id="filterForm" method="GET" action="{{ route('shekari-weapon-report') }}" class="mb-3 mx-4">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="start_date">تاریخ شروع</label>
                            <input type="text" name="start_date" id="start_date" class="form-control farsi-date-picker"
                                placeholder="تاریخ شروع را انتخاب کنید" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="end_date">تاریخ ختم</label>
                            <input type="text" name="end_date" id="end_date" class="form-control farsi-date-picker"
                                placeholder="تاریخ ختم را انتخاب کنید" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-success mx-1"><i class="fas fa-eye"></i>&nbsp;&nbsp;نمایش
                                راپور</button>
                            <button type="button" class="btn btn-info" onclick="resetFilterInputs()"
                                title="پاک کردن فیلترها">
                                <i class="fas fa-undo"></i>
                            </button>
                        </div>

                    </div>
                </form>
                {{-- First Row Of general Card --}}
                <hr />
                <div class="row">
                    <div class="col-md-6">
                        <div class="custom-card">
                            <div class="custom-card-content d-flex justify-content-between align-items-center">
                                <div class="custom-card-left d-flex align-items-center">
                                    <div class="custom-card-icon me-2">
                                        <i class="fas fa-hashtag"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2 class="mb-0">تعداد</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $general_card_total_quantity }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="custom-card">
                            <div class="custom-card-content d-flex justify-content-between align-items-center">
                                <div class="custom-card-left d-flex align-items-center">
                                    <div class="custom-card-icon me-2">
                                        <i class="fas fa-store"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2 class="mb-0">عواید</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $general_card_total_revenue }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@section('scripts')
    @include('organization.general_scripts')
    @include('organization.dari-datepicker')

    <script>
        function showCards(type) {

            document.getElementById('filterForm').style.display = 'block';

            sessionStorage.setItem('activeTab', type);

            document.getElementById('specialCards').style.display = (type === 'special') ? 'block' : 'none';
            document.getElementById('generalCards').style.display = (type === 'general') ? 'block' : 'none';

            if (type === 'special') {
                // Re-initialize select2
                $('#organization_id').select2({
                    width: '100%'
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('specialCards').style.display = 'none';
            document.getElementById('generalCards').style.display = 'none';


            document.getElementById('filterForm').style.display = 'none';
            const activeTab = sessionStorage.getItem('activeTab');
            const isFormSubmission = window.location.search.includes('start_date') ||
                window.location.search.includes('end_date') || window.location.search.includes('organization_id') ||
                window.location.search.includes('special_report_start_date') || window.location.search.includes(
                    'special_report_end_date');

            if (activeTab && isFormSubmission) {
                showCards(activeTab);
            }
        });

        function resetFilterInputs() {
            document.getElementById('start_date').value = '';
            document.getElementById('end_date').value = '';
            document.getElementById('special_report_start_date').value = '';
            document.getElementById('special_report_end_date').value = '';
            document.getElementById('organization_id').value = '';
            $('#organization_id').trigger('change');
            const activeTab = sessionStorage.getItem('activeTab');

            if (activeTab) {
                document.getElementById('filterForm').submit();
            }
        }
    </script>
@endsection

@endsection
