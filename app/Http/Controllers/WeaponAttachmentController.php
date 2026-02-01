<?php

namespace App\Http\Controllers;

use App\Models\WeaponAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WeaponAttachmentController extends Controller
{
    protected function index($organization_id)
    {
        $data['organization_id'] = $organization_id;

        $data['weapon_attachments'] = WeaponAttachment::where('organization_id', decode_organization_id($organization_id))->orderBy('id', 'desc')->get();
        return view('organization.weapon-attachment', $data);
    }

    protected function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'weapon_number' => 'required',
                'attachments' => $request->weapon_attachment_id == 0 ? 'required|mimes:pdf' : '',
            ],
            [
                'employee_number.required' => 'تعداد اسلحه را بنوسید',
                'attachments.required' => 'ضمایم را انتخاب نمایید',
                'attachments.mimes' => 'ضمایم باید با فارمت های pdf باشد',
            ]
        );

        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }

        if ($request->has('attachments')) {
            $file = Storage::disk('weapon_attachments')->put(date('Y') . '/' . date('m'), $request->file('attachments'));
        }

        $weapon_attachment = $request->weapon_attachment_id == 0 ? new WeaponAttachment() : WeaponAttachment::findOrFail($request->weapon_attachment_id);
        if ($request->weapon_attachment_id == 0) {

            $weapon_attachment->organization_id = decode_organization_id($request->organization_id);
        }

        $weapon_attachment->weapon_number = $request->weapon_number;
        $weapon_attachment->remain_weapon_number = $request->weapon_number;
        $weapon_attachment->attachments = $request->weapon_attachment_id == 0 ? $file : $weapon_attachment->attachments;
        if ($request->weapon_attachment_id != 0) {
            $weapon_attachment->is_approved = 0;
            $weapon_attachment->approved_by = null;
        }
        $request->weapon_attachment_id == 0 ? $weapon_attachment->created_by = get_user_id() : $weapon_attachment->updated_by = get_user_id();
        $request->weapon_attachment_id == 0 ? $weapon_attachment->save() : $weapon_attachment->update();

        return true;
    }

    protected function approve($id)
    {
        $weapon_attachment_payment = WeaponAttachment::findOrFail($id);
        $weapon_attachment_payment->is_approved = 1;
        $weapon_attachment_payment->approved_by = auth()->id();
        $weapon_attachment_payment->save();
        return true;
    }

    protected function reject($id)
    {
        $weapon_attachment_payment = WeaponAttachment::findOrFail($id);
        $weapon_attachment_payment->is_approved = 2;
        $weapon_attachment_payment->approved_by = auth()->id();
        $weapon_attachment_payment->save();
        return true;
    }
}
