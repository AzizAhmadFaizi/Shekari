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
                    <button class="btn btn-primary w-100" onclick="showCards('company')">راپور یخش شرکت ها</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-danger w-100" onclick="showCards('shop')"> راپور بخش دوکان ها </button>
                </div>
            </div>
        </div>
        <form id="filterForm" method="GET" action="{{ route('report') }}" class="mb-3 mx-4" style="display: none;">
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
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100"><i class="fas fa-eye"></i>&nbsp;&nbsp;نمایش
                        راپور</button>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-warning w-100" onclick="resetFilterInputs()"
                        title="پاک کردن فیلترها">
                        <i class="fas fa-undo"></i>
                    </button>
                </div>
            </div>
        </form>
        <div class="card-body">
            <hr>
            {{-- Company Cards --}}
            <div id="companyCards" style="display: none;">
                {{-- First Row --}}
                <div class="row">
                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content d-flex justify-content-between align-items-center">
                                <div class="custom-card-left d-flex align-items-center">
                                    <div class="custom-card-icon me-2">
                                        <i class="fas fa-store"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2 class="mb-0">تعداد شرکت ها</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_orgs }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content d-flex justify-content-between align-items-center">
                                <div class="custom-card-left d-flex align-items-center">
                                    <div class="custom-card-icon me-2">
                                        <i class="fas fa-store"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2 class="mb-0">تعداد شرکت ها فعال</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_orgs_status_1 }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content d-flex justify-content-between align-items-center">
                                <div class="custom-card-left d-flex align-items-center">
                                    <div class="custom-card-icon me-2">
                                        <i class="fas fa-store"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2 class="mb-0">تعداد شرکت ها غیر فعال</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_orgs_status_0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Second Row --}}
                <div class="row mt-2">
                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content">
                                <div class="custom-card-left">
                                    <div class="custom-card-icon">
                                        <i class="fas fa-box-open"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2>تعداد جواز شرکت ها</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_orgs_license }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content">
                                <div class="custom-card-left">
                                    <div class="custom-card-icon">
                                        <i class="fas fa-box-open"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2>تعداد جواز ها فعال شرکت ها</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_orgs_license_status_1 }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content">
                                <div class="custom-card-left">
                                    <div class="custom-card-icon">
                                        <i class="fas fa-box-open"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2>تعداد جواز ها لغو شده شرکت ها</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_orgs_license_status_0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Third Row --}}
                <div class="row mt-2">
                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content">
                                <div class="custom-card-left">
                                    <div class="custom-card-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2>عواید حاصل شده از شرکت ها</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_benefit_company }}&nbsp;افغانی</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content">
                                <div class="custom-card-left">
                                    <div class="custom-card-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2>تعداد جواز های چاپ شده</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_orgs_license_printed }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content">
                                <div class="custom-card-left">
                                    <div class="custom-card-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2>تعداد جواز های چاپ نشده</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_orgs_license_not_printed }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Fourth Row --}}
                <div class="row mt-2">
                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content">
                                <div class="custom-card-left">
                                    <div class="custom-card-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2>تعداد جواز های جدید</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_orgs_license_new }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content">
                                <div class="custom-card-left">
                                    <div class="custom-card-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2>تعداد جواز های تجدید</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_orgs_license_renewal }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content">
                                <div class="custom-card-left">
                                    <div class="custom-card-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2>تعداد جواز های مثنی</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_orgs_license_mushani }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Shop Cards --}}
            <div id="shopCards" style="display: none;">
                {{-- First Row --}}
                <div class="row">
                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content d-flex justify-content-between align-items-center">
                                <div class="custom-card-left d-flex align-items-center">
                                    <div class="custom-card-icon me-2">
                                        <i class="fas fa-store"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2 class="mb-0">تعداد دوکان ها</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_shops }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content d-flex justify-content-between align-items-center">
                                <div class="custom-card-left d-flex align-items-center">
                                    <div class="custom-card-icon me-2">
                                        <i class="fas fa-store"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2 class="mb-0">تعداد دوکان ها فعال</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_shops_status_1 }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content d-flex justify-content-between align-items-center">
                                <div class="custom-card-left d-flex align-items-center">
                                    <div class="custom-card-icon me-2">
                                        <i class="fas fa-store"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2 class="mb-0">تعداد دوکان ها غیر فعال</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_shops_status_0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Second Row --}}
                <div class="row mt-2">
                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content">
                                <div class="custom-card-left">
                                    <div class="custom-card-icon">
                                        <i class="fas fa-box-open"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2>تعداد جواز دوکان ها</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_shops_license }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content">
                                <div class="custom-card-left">
                                    <div class="custom-card-icon">
                                        <i class="fas fa-box-open"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2>تعداد جواز ها فعال دوکان ها</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_shops_license_status_1 }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content">
                                <div class="custom-card-left">
                                    <div class="custom-card-icon">
                                        <i class="fas fa-box-open"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2>تعداد جواز ها لغو شده دوکان ها</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_shops_license_status_0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Third Row --}}
                <div class="row mt-2">
                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content">
                                <div class="custom-card-left">
                                    <div class="custom-card-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2>عواید حاصل شده از دوکان ها</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_benefit }}&nbsp;افغانی</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content">
                                <div class="custom-card-left">
                                    <div class="custom-card-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2>تعداد جواز های چاپ شده</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_shops_license_printed }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content">
                                <div class="custom-card-left">
                                    <div class="custom-card-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2>تعداد جواز های چاپ نشده</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_shops_license_not_printed }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Fourth Row --}}
                <div class="row mt-2">
                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content">
                                <div class="custom-card-left">
                                    <div class="custom-card-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2>تعداد جواز های جدید</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_shops_license_new }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content">
                                <div class="custom-card-left">
                                    <div class="custom-card-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2>تعداد جواز های تجدید</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_shops_license_renewal }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-card">
                            <div class="custom-card-content">
                                <div class="custom-card-left">
                                    <div class="custom-card-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div class="custom-card-text">
                                        <h2>تعداد جواز های مثنی</h2>
                                    </div>
                                </div>
                                <span class="custom-badge">{{ $total_shops_license_mushani }}</span>
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

            document.getElementById('companyCards').style.display = (type === 'company') ? 'block' : 'none';
            document.getElementById('shopCards').style.display = (type === 'shop') ? 'block' : 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('companyCards').style.display = 'none';
            document.getElementById('shopCards').style.display = 'none';

            document.getElementById('filterForm').style.display = 'none';
            const activeTab = sessionStorage.getItem('activeTab');
            const isFormSubmission = window.location.search.includes('start_date') ||
                window.location.search.includes('end_date');

            if (activeTab && isFormSubmission) {
                showCards(activeTab);
            }
        });

        function resetFilterInputs() {
            document.getElementById('start_date').value = '';
            document.getElementById('end_date').value = '';
            const activeTab = sessionStorage.getItem('activeTab');

            if (activeTab) {
                document.getElementById('filterForm').submit();
            }
        }
    </script>
@endsection
@endsection
