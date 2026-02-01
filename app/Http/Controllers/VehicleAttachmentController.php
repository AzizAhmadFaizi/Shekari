<?php

namespace App\Http\Controllers;

use App\Models\VehicleAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VehicleAttachmentController extends Controller
{
    protected function index($organization_id)
    {
        $data['organization_id'] = $organization_id;

        $data['vehicle_attachments'] = VehicleAttachment::where('organization_id', decode_organization_id($organization_id))->orderBy('id', 'desc')->get();
        return view('organization.vehicle-attachment', $data);
    }

    protected function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'vehicle_number' => 'required',
                'attachments' => $request->vehicle_attachment_id == 0 ? 'required|mimes:pdf' : '',
            ],
            [
                'vehicle_number.required' => 'تعداد وسایط را بنوسید',
                'attachments.required' => 'ضمایم را انتخاب نمایید',
                'attachments.mimes' => 'ضمایم باید با فارمت های pdf باشد',
            ]
        );

        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }

        if ($request->has('attachments')) {
            $file = Storage::disk('vehicle_attachment_files')->put(date('Y') . '/' . date('m'), $request->file('attachments'));
        }

        $vehicle_attachment = $request->vehicle_attachment_id == 0 ? new VehicleAttachment() : VehicleAttachment::findOrFail($request->vehicle_attachment_id);
        if ($request->vehicle_attachment_id == 0) {
            $vehicle_attachment->organization_id = decode_organization_id($request->organization_id);
        }

        $vehicle_attachment->vehicle_number = $request->vehicle_number;
        $vehicle_attachment->remain_vehicle_number = $request->vehicle_number;
        $vehicle_attachment->attachments = $request->vehicle_attachment_id == 0 ? $file : $vehicle_attachment->attachments;
        if ($request->vehicle_attachment_id != 0) {
            $vehicle_attachment->is_approved = 0;
            $vehicle_attachment->approved_by = null;
        }
        $request->vehicle_attachment_id == 0 ? $vehicle_attachment->created_by = get_user_id() : $vehicle_attachment->updated_by = get_user_id();
        $request->vehicle_attachment_id == 0 ? $vehicle_attachment->save() : $vehicle_attachment->update();

        return true;
    }

    protected function approve($id)
    {
        $vehicle_attachment = VehicleAttachment::findOrFail($id);
        $vehicle_attachment->is_approved = 1;
        $vehicle_attachment->approved_by = auth()->id();
        $vehicle_attachment->save();
        return true;
    }

    protected function reject($id)
    {
        $vehicle_attachment = VehicleAttachment::findOrFail($id);
        $vehicle_attachment->is_approved = 2;
        $vehicle_attachment->approved_by = auth()->id();
        $vehicle_attachment->save();
        return true;
    }
}
