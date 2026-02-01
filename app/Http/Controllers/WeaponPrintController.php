<?php

namespace App\Http\Controllers;

use App\Models\Weapon;
use App\Models\WeaponPrint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class WeaponPrintController extends Controller
{
    protected function index(Request $request)
    {
        if ($request->ajax()) {
            $data = WeaponPrint::where('status', 0)->groupBy('organization_id')->select('organization_id')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('company_details', function ($data) {
                    return $data->organization_details->name_en . ' - ' . $data->organization_details->name_dr;
                })
                ->addColumn('total_weapons_to_print', function ($data) {
                    $d = WeaponPrint::where(['status' => 0, 'organization_id' => $data->organization_id])->get();
                    return '<span class="badge bg-primary ms-1 me-1">' . count($d) . '</span>';
                })
                ->addColumn('logo_details', function ($data) {
                    return "<img src='" . URL::asset('storage/organization_logos/' . $data->organization_details->logo) . "' width='30'/>";
                })
                ->addColumn('action', function ($data) {
                    $btn = '';
                    if (auth()->user()->role_id == 2)
                        $btn .= "<a href='#!' class='me-1 printed_btn' style='cursor: pointer;' data-id='" . $data->organization_id . "' ><span class='btn btn-outline-success btn-sm waves-effect round fa fa-check'></span></a>";
                    if (auth()->user()->role_id == 3)
                        $btn .= "<a href='" . route('weapon-print', base64_encode(Str::random(30) . '-' . base64_encode($data->organization_id))) . "' class='me-1' style='cursor: pointer;' data-id='" . $data->id . "' ><span class='btn btn-outline-primary btn-sm waves-effect round fa fa-print'></span></a>";
                    return $btn;
                })
                ->escapeColumns([])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('weapon-print.index');
    }

    protected function print_weapon_card($organization_id)
    {
        $data['weapons'] = WeaponPrint::where(['organization_id' => decode_organization_id($organization_id), 'status' => 0])->get();
        return view('weapon-print.weapon-print', $data);
    }

    protected function weapon_printed($organization_id)
    {
        $weapon_print = WeaponPrint::where(['organization_id' => $organization_id, 'status' => 0])->get();
        foreach ($weapon_print as $wp) {
            $weapon = Weapon::where('id', $wp->weapon_id)->first();
            $weapon->status = 3;
            $weapon->updated_by = get_user_id();
            $weapon->update();

            $wp->status = 1;
            $wp->updated_by = get_user_id();
            $wp->update();
        }

        return true;
    }
}
