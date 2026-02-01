<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\License;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Morilog\Jalali\Jalalian;

class ReportController extends Controller
{
    // protected function index(Request $request)
    // {

    //     dd($request->all());

    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');


    //     // $startDate = Jalalian::fromFormat('Y/m/d', $request->input('start_date'))->toCarbon()->format('Y-m-d');
    //     // $endDate = Jalalian::fromFormat('Y/m/d', $request->input('end_date'))->toCarbon()->format('Y-m-d');


    //     // Shops Part
    //     $data['total_shops'] = Organization::where('type', 2)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     $data['total_shops_status_1'] = Organization::where('type', 2)
    //         ->where('status', 1)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     $data['total_shops_status_0'] = Organization::where('type', 2)
    //         ->where('status', 0)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     $data['total_shops_license'] = License::whereIn('license_type_id', [1, 2, 3])
    //         ->where('type', 2)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     $data['total_shops_license_status_1'] = License::where('type', 2)
    //         ->where('status', 1)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     $data['total_shops_license_status_0'] = License::where('type', 2)
    //         ->where('status', 0)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     $data['total_benefit'] = License::where('type', 2)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->sum('tariff_amount');

    //     $data['total_shops_license_printed'] = License::where('is_printed', 1)
    //         ->where('type', 2)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     $data['total_shops_license_not_printed'] = License::where('is_printed', 0)
    //         ->where('type', 2)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     $data['total_shops_license_new'] = License::where('license_type_id', 1)
    //         ->where('type', 2)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     $data['total_shops_license_renewal'] = License::where('license_type_id', 2)
    //         ->where('type', 2)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     $data['total_shops_license_mushani'] = License::where('license_type_id', 3)
    //         ->where('type', 2)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     // Companies Part
    //     $data['total_orgs'] = Organization::where('type', 1)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     $data['total_orgs_status_1'] = Organization::where('type', 1)
    //         ->where('status', 1)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     $data['total_orgs_status_0'] = Organization::where('type', 1)
    //         ->where('status', 0)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     $data['total_orgs_license'] = License::whereIn('license_type_id', [1, 2, 3])
    //         ->where('type', 1)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     $data['total_orgs_license_status_1'] = License::where('type', 1)
    //         ->where('status', 1)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     $data['total_orgs_license_status_0'] = License::where('type', 1)
    //         ->where('status', 0)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     $data['total_orgs_license_printed'] = License::where('is_printed', 1)
    //         ->where('type', 1)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     $data['total_orgs_license_not_printed'] = License::where('is_printed', 0)
    //         ->where('type', 1)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     $data['total_orgs_license_new'] = License::where('license_type_id', 1)
    //         ->where('type', 1)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     $data['total_orgs_license_renewal'] = License::where('license_type_id', 2)
    //         ->where('type', 1)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     $data['total_orgs_license_mushani'] = License::where('license_type_id', 3)
    //         ->where('type', 1)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->count();

    //     $data['total_benefit_company'] = License::where('type', 1)
    //         ->when($startDate, function ($query) use ($startDate) {
    //             return $query->where('created_at', '>=', $startDate);
    //         })
    //         ->when($endDate, function ($query) use ($endDate) {
    //             return $query->where('created_at', '<=', $endDate);
    //         })
    //         ->sum('tariff_amount');

    //     return view('reports.index', $data);
    // }

    protected function index(Request $request)
    {

        $startDate = null;
        $endDate = null;
        $startRaw = trim($request->input('start_date'));
        $endRaw = trim($request->input('end_date'));

        if (!empty($startRaw)) {
            try {
                $startDate = Jalalian::fromFormat('Y-m-d', $startRaw)->toCarbon()->format('Y-m-d');
            } catch (\Exception $e) {
                return ['Invalid start date format: ' . $startRaw];
            }
        }
        if (!empty($endRaw)) {
            try {
                $endDate = Jalalian::fromFormat('Y-m-d', $endRaw)->toCarbon()->format('Y-m-d');
            } catch (\Exception $e) {
                return ['Invalid end date format: ' . $endRaw];
            }
        }
        // Shops Part
        $data['total_shops'] = Organization::where('type', 2)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $data['total_shops_status_1'] = Organization::where('type', 2)
            ->where('status', 1)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $data['total_shops_status_0'] = Organization::where('type', 2)
            ->where('status', 0)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $data['total_shops_license'] = License::whereIn('license_type_id', [1, 2, 3])
            ->where('type', 2)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $data['total_shops_license_status_1'] = License::where('type', 2)
            ->where('status', 1)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $data['total_shops_license_status_0'] = License::where('type', 2)
            ->where('status', 0)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $data['total_benefit'] = License::where('type', 2)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->sum('tariff_amount');

        $data['total_shops_license_printed'] = License::where('is_printed', 1)
            ->where('type', 2)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $data['total_shops_license_not_printed'] = License::where('is_printed', 0)
            ->where('type', 2)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $data['total_shops_license_new'] = License::where('license_type_id', 1)
            ->where('type', 2)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $data['total_shops_license_renewal'] = License::where('license_type_id', 2)
            ->where('type', 2)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $data['total_shops_license_mushani'] = License::where('license_type_id', 3)
            ->where('type', 2)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        // Companies Part
        $data['total_orgs'] = Organization::where('type', 1)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $data['total_orgs_status_1'] = Organization::where('type', 1)
            ->where('status', 1)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $data['total_orgs_status_0'] = Organization::where('type', 1)
            ->where('status', 0)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $data['total_orgs_license'] = License::whereIn('license_type_id', [1, 2, 3])
            ->where('type', 1)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $data['total_orgs_license_status_1'] = License::where('type', 1)
            ->where('status', 1)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $data['total_orgs_license_status_0'] = License::where('type', 1)
            ->where('status', 0)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $data['total_orgs_license_printed'] = License::where('is_printed', 1)
            ->where('type', 1)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $data['total_orgs_license_not_printed'] = License::where('is_printed', 0)
            ->where('type', 1)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $data['total_orgs_license_new'] = License::where('license_type_id', 1)
            ->where('type', 1)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $data['total_orgs_license_renewal'] = License::where('license_type_id', 2)
            ->where('type', 1)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $data['total_orgs_license_mushani'] = License::where('license_type_id', 3)
            ->where('type', 1)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $data['total_benefit_company'] = License::where('type', 1)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->sum('tariff_amount');

        return view('reports.index', $data);
    }
}
