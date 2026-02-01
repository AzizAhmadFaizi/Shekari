<?php

namespace App\Http\Controllers;

use App\Models\Weapon;
use App\Models\License;
use App\Models\Vehicle;
use App\Models\Contract;
use App\Models\District;
use App\Models\Employee;
use App\Models\President;
use Illuminate\Support\Str;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\VicePresident;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends Controller
{
    protected function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Organization::where('type', 1)->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name_details', function ($data) {
                    return $data->status == 1 ? "<a href='" . route('organization-general-form', encode_organization_id($data->id)) . "' style='cursor: pointer;' >" . $data->name_dr . "</a>" :
                        $data->name_dr;
                    return $data->created_by_details->name;
                })
                ->addColumn('created_by_details', function ($data) {
                    return $data->created_by_details->name;
                })
                ->addColumn('status_details', function ($data) {
                    $btn = "";
                    $btn .= $data->status == 1 ? "<span class='me-1 badge bg-success'>فعال</span>" : "<span class='badge bg-danger'>غیر فعال</span>";
                    // switch ($data->is_approved) {
                    //     case 0:
                    //         $btn .= "<span class='btn btn-outline-warning btn-sm waves-effect round fa fa-info'> در حال انتظار </span>";
                    //         break;
                    //     case 1:
                    //         $btn .= "<span class='btn btn-outline-success btn-sm waves-effect round fa fa-check'>  تایید شده </span>";
                    //         break;
                    //     case 2:
                    //         $btn .= "<span class='btn btn-outline-danger btn-sm waves-effect round fa fa-times'> رد شده </span>";
                    //         break;
                    // }
                    return $btn;
                })
                ->addColumn('logo_details', function ($data) {
                    return "<img src='" . URL::asset('storage/organization_logos/' . $data->logo) . "' width='30'/>";
                })
                ->addColumn('action', function ($data) {
                    $btn = '';
                    if ($data->is_approved != 1 and $data->status == 1)
                        $btn .= "<a href='#' class='edit_btn me-1' style='cursor: pointer;' data-id='" . $data->id . "' data-name-dr='" . $data->name_dr . "' data-type='" . $data->type . "' data-main_office_address='" . $data->main_office_address . "' data-sub_main_office_address='" . $data->sub_main_office_address . "' data-img='" . URL::asset('storage/organization_logos/' . $data->logo) . "'><span class='btn btn-outline-dark btn-sm waves-effect round fa fa-edit'></span></a>";

                    if ($data->status == 1) {
                        $btn .=  "<a href='#' class='me-1 deactive_btn' style='cursor: pointer;' data-id='" . $data->id . "'><span class='btn btn-outline-danger btn-sm waves-effect round fa fa-trash'></span></a>";
                        if (auth()->user()->role_id == 4) {
                            $btn .=  "<a href='#' class='me-1 approve_btn' style='cursor: pointer;' data-id='" . $data->id . "'><span class='btn btn-outline-success btn-sm waves-effect round fa fa-check'></span></a>";
                            $btn .=  "<a href='#' class='me-1 reject_btn' style='cursor: pointer;' data-id='" . $data->id . "'><span class='btn btn-outline-primary btn-sm waves-effect round fa fa-times'></span></a>";
                        }
                    }
                    $btn .= "<a href='" . route('organization-general-form', encode_organization_id($data->id)) . "' class='btn btn-sm btn-outline-dark round waves-effect'><span class='fa fa-eye'></span></a>";
                    return $btn;
                })
                ->rawColumns(['created_by_details'])
                ->escapeColumns([])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('organization.index');
    }

    protected function shops(Request $request)
    {
        if ($request->ajax()) {
            $data = Organization::where('type', 2)->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name_details', function ($data) {
                    return $data->status == 1 ? "<a href='" . route('organization-general-form', encode_organization_id($data->id)) . "' style='cursor: pointer;' >" . $data->name_dr . "</a>" :
                        $data->name_dr;
                    return $data->created_by_details->name;
                })
                ->addColumn('created_by_details', function ($data) {
                    return $data->created_by_details->name;
                })
                ->addColumn('status_details', function ($data) {
                    $btn = "";
                    $btn .= $data->status == 1 ? "<span class='me-1 badge bg-success'>فعال</span>" : "<span class='badge bg-danger'>غیر فعال</span>";
                    // switch ($data->is_approved) {
                    //     case 0:
                    //         $btn .= "<span class='btn btn-outline-warning btn-sm waves-effect round fa fa-info'> در حال انتظار </span>";
                    //         break;
                    //     case 1:
                    //         $btn .= "<span class='btn btn-outline-success btn-sm waves-effect round fa fa-check'>  تایید شده </span>";
                    //         break;
                    //     case 2:
                    //         $btn .= "<span class='btn btn-outline-danger btn-sm waves-effect round fa fa-times'> رد شده </span>";
                    //         break;
                    // }
                    return $btn;
                })
                ->addColumn('logo_details', function ($data) {
                    return "<img src='" . URL::asset('storage/organization_logos/' . $data->logo) . "' width='30'/>";
                })
                ->addColumn('action', function ($data) {
                    $btn = '';
                    if ($data->is_approved != 1 and $data->status == 1)
                        $btn .= "<a href='#' class='edit_btn me-1' style='cursor: pointer;' data-id='" . $data->id . "' data-name-dr='" . $data->name_dr . "' data-type='" . $data->type . "' data-main_office_address='" . $data->main_office_address . "' data-sub_main_office_address='" . $data->sub_main_office_address . "' data-img='" . URL::asset('storage/organization_logos/' . $data->logo) . "'><span class='btn btn-outline-dark btn-sm waves-effect round fa fa-edit'></span></a>";

                    if ($data->status == 1) {
                        $btn .=  "<a href='#' class='me-1 deactive_btn' style='cursor: pointer;' data-id='" . $data->id . "'><span class='btn btn-outline-danger btn-sm waves-effect round fa fa-trash'></span></a>";
                        if (auth()->user()->role_id == 4) {
                            $btn .=  "<a href='#' class='me-1 approve_btn' style='cursor: pointer;' data-id='" . $data->id . "'><span class='btn btn-outline-success btn-sm waves-effect round fa fa-check'></span></a>";
                            $btn .=  "<a href='#' class='me-1 reject_btn' style='cursor: pointer;' data-id='" . $data->id . "'><span class='btn btn-outline-primary btn-sm waves-effect round fa fa-times'></span></a>";
                        }
                    }
                    $btn .= "<a href='" . route('organization-general-form', encode_organization_id($data->id)) . "' class='btn btn-sm btn-outline-dark round waves-effect'><span class='fa fa-eye'></span></a>";
                    return $btn;
                })
                ->rawColumns(['created_by_details'])
                ->escapeColumns([])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('organization.shop');
    }

    protected function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'type' => 'required',
                'name_dr' => $request->organization_id == 0  ? 'required|unique:organizations' : 'required',
                'main_office_address' => $request->organization_id == 1  ? 'required' : '',
            ],
            [
                'name_dr.required' => 'اسم دری را بنوسید',
                'name_dr.unique' => 'این شرکت قبلا ثبت شده است',
                'main_office_address.required' => 'ادرس ضروری میباشد',
                'image.required' => 'عکس را انتخاب نمایید',
            ]
        );

        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }

        $request->organization_id == 0 ? $organization = new Organization() : $organization = Organization::findOrFail($request->organization_id);
        if ($request->has('image'))
            $img = Storage::disk('organization_logos')->put(date('Y') . '/' . date('m'), $request->file('image'));

        $organization->name_dr = $request->name_dr;
        $organization->main_office_address = $request->main_office_address;
        $organization->sub_main_office_address = $request->sub_main_office_address;
        $organization->type = $request->type;
        $organization->logo = $request->has('image') ? $img : $organization->logo;
        $request->organization_id == 0 ? $organization->created_by = auth()->id() : $organization->updated_by = auth()->id();
        if ($request->organization_id != 0) {
            $organization->is_approved = 0;
            $organization->approved_by = null;
        }
        $organization->save();

        return response()->json(['response' => true, 'organization_id' => encode_organization_id($organization->id)]);
    }

    protected function show($organization_id)
    {

        $data['organization'] = Organization::findOrFail(decode_organization_id($organization_id));
        $data['presidents'] = President::where('organization_id', decode_organization_id($organization_id))->get();
        $data['vice_presidents'] = VicePresident::where('organization_id', decode_organization_id($organization_id))->get();
        $data['licenses'] = License::where('organization_id', decode_organization_id($organization_id))->get();
        $data['employees'] = Employee::where('organization_id', decode_organization_id($organization_id))->get();
        $data['weapons'] = Weapon::where('organization_id', decode_organization_id($organization_id))->get();
        $data['vehicles'] = Vehicle::where('organization_id', decode_organization_id($organization_id))->get();
        $data['contracts'] = Contract::where('organization_id', decode_organization_id($organization_id))->get();
        return view('organization.show', $data);
    }

    protected function deactive($id)
    {
        $position = Organization::findOrFail($id);
        $position->status = 0;
        $position->updated_by = auth()->id();
        $position->save();
        return true;
    }

    protected function approve($id)
    {
        $organization = Organization::findOrFail($id);
        $organization->is_approved = 1;
        $organization->approved_by = auth()->id();
        $organization->save();
        return true;
    }

    protected function reject($id)
    {
        $organization = Organization::findOrFail($id);
        $organization->is_approved = 2;
        $organization->approved_by = auth()->id();
        $organization->save();
        return true;
    }

    protected function show_general_form($organization_id)
    {
        $data['organization'] = Organization::findOrFail(decode_organization_id($organization_id));
        if ($data['organization']->type == 1) {
            Session::flash('menu', 'company');
        }else {
            Session::flash('menu', 'shop');
        }
        return view('organization.general', $data);
    }

    protected function province_districts(Request $request)
    {
        $districts = District::where('province_id', $request->id)->get();

        return json_encode($districts);
    }
}
