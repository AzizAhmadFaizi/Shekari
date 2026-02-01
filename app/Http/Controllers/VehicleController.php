<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Vehicle;
use App\Models\VehicleAttachment;
use App\Models\VehicleStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    protected function index($organization_id)
    {
        $data['organization_id'] = $organization_id;

        $data['vehicles'] = Vehicle::where('organization_id', decode_organization_id($organization_id))->orderBy('id', 'desc')->get();
        $data['vehicle_attachments'] = VehicleAttachment::where(['organization_id' => decode_organization_id($organization_id), 'is_approved' => 1])->where('remain_vehicle_number', '>', 0)->get();
        $data['active_vehicles'] = Vehicle::where(['organization_id' => decode_organization_id($organization_id), 'is_approved' => 1, 'vehicle_status_id' => null])->orderBy('id', 'desc')->get();
        $data['colors'] = Color::all();
        return view('organization.vehicle', $data);
    }

    protected function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'vehicle_type' => 'required',
                'vehicle_owner_id' => 'required',
                'plate_no' => 'required',
                'color_id' => 'required',
                'engine_no' => 'required',
                'plate_no' => 'required',
                'shasi_no' => 'required',
                'issue_date' => 'required',
                'expire_date' => 'required',
                'vehicle_attachment_id' => 'required'
            ],
            [
                'vehicle_type.required' => 'نوعیت عراده را بنوسید',
                'vehicle_owner_id.required' => 'مالکیت را انتخاب نمایید',
                'plate_no.required' => 'پلیت نمبر را بنوسید',
                'color_id.required' => 'رنگ را انتخاب نمایید',
                'engine_no.required' => 'نمبر انجن را بنوسید',
                'shasi_no.required' => 'نمبر شاسی را بنوسید',
                'plate_no.required' => 'نمبر شاسی را بنوسید',
                'issue_date.required' => 'تاریخ صدور جواز سیر را انتخاب نمایید',
                'expire_date.required' => 'تاریخ اعتبار جواز سیر را انتخاب نمایید',
                'vehicle_attachment_id.required' => 'لست جدول عراده جات را انتخاب نمایید',
            ]
        );

        if ($validator->fails())
            return json_encode($validator->errors()->toArray());

        $vehicle = $request->vehicle_id == 0 ? new Vehicle() : Vehicle::findOrFail($request->vehicle_id);
        if ($request->vehicle_id == 0) {

            $vehicle->organization_id = decode_organization_id($request->organization_id);
            $e = VehicleAttachment::findOrFail($request->vehicle_attachment_id);
            $e->remain_vehicle_number = $e->remain_vehicle_number - 1;
            $e->update();
        }
        $vehicle->vehicle_type = $request->vehicle_type;
        $vehicle->vehicle_owner_id = $request->vehicle_owner_id;
        $vehicle->color_id = $request->color_id;
        $vehicle->engine_no = $request->engine_no;
        $vehicle->shasi_no = $request->shasi_no;
        $vehicle->plate_no = $request->plate_no;
        if ($request->vehicle_id != 0) {
            $vehicle->is_approved = 0;
            $vehicle->approved_by = null;
        }
        $vehicle->issue_date = to_gregorian($request->issue_date);
        $vehicle->expire_date = to_gregorian($request->expire_date);
        $vehicle->vehicle_attachment_id = $request->vehicle_attachment_id;
        $request->vehicle_id == 0 ? $vehicle->created_by = get_user_id() : $vehicle->updated_by = get_user_id();
        $request->vehicle_id == 0 ? $vehicle->save() : $vehicle->update();
        return true;
    }

    protected function deactive(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'is_active_reason' => 'required',
                'status_attachments' => 'required',
            ],
            [
                'is_active_reason.required' => 'دلیل لغو را بنوسید',
                'status_attachments.required' => 'ضمایم را انتخاب نمایید'
            ]
        );

        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }

        if ($request->has('status_attachments')) {
            $file = Storage::disk('vehicle_attachment_files')->put(date('Y') . '/' . date('m'), $request->file('status_attachments'));
        }

        $es = new VehicleStatus();
        $es->organization_id = decode_organization_id($request->org_id);
        $es->status_reason = $request->is_active_reason;
        $es->attachments = $file;
        $es->created_by = get_user_id();
        $es->save();

        foreach ($request->vehicles as $key => $value) {
            $employee = Vehicle::findOrFail($value);
            $employee->vehicle_status_id = $es->id;
            $employee->updated_by = get_user_id();
            $employee->update();
        }

        return true;
    }

    protected function approve($id)
    {
        $president = Vehicle::findOrFail($id);
        $president->is_approved = 1;
        $president->approved_by = auth()->id();
        $president->save();
        return true;
    }

    protected function reject($id)
    {
        $president = Vehicle::findOrFail($id);
        $president->is_approved = 2;
        $president->approved_by = auth()->id();
        $president->save();
        return true;
    }
}
