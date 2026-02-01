<?php

namespace App\Http\Controllers;

use App\Models\EmployeeAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EmployeeAttachmentController extends Controller
{
    protected function index($organization_id)
    {
        $data['organization_id'] = $organization_id;
        $data['employee_attachments'] = EmployeeAttachment::where('organization_id', decode_organization_id($organization_id))->orderBy('id', 'desc')->get();
        return view('organization.employee-attachment', $data);
    }

    protected function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'employee_number' => 'required',
                'attachments' => $request->employee_attachment_id == 0 ? 'required|mimes:pdf' : '',
            ],
            [
                'employee_number.required' => 'تعداد کارمندان را بنوسید',
                'attachments.required' => 'ضمایم را انتخاب نمایید',
                'attachments.mimes' => 'ضمایم باید با فارمت های pdf باشد',
            ]
        );

        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }

        if ($request->has('attachments')) {
            $file = Storage::disk('employee_attachments')->put(date('Y') . '/' . date('m'), $request->file('attachments'));
        }

        $employee = $request->employee_attachment_id == 0 ? new EmployeeAttachment() : EmployeeAttachment::findOrFail($request->employee_attachment_id);
        if ($request->employee_attachment_id == 0) {
            $employee->organization_id = decode_organization_id($request->organization_id);
        }

        $employee->employee_number = $request->employee_number;
        $employee->remain_employee_number = $request->employee_number;
        $employee->attachments = $request->employee_attachment_id == 0 ? $file : $employee->attachments;
        if ($request->employee_attachment_id != 0) {
            $employee->is_approved = 0;
            $employee->approved_by = null;
        }
        $request->employee_attachment_id == 0 ? $employee->created_by = get_user_id() : $employee->updated_by = get_user_id();
        $request->employee_attachment_id == 0 ? $employee->save() : $employee->update();

        return true;
    }

    protected function approve($id)
    {
        $employee_payment = EmployeeAttachment::findOrFail($id);
        $employee_payment->is_approved = 1;
        $employee_payment->approved_by = auth()->id();
        $employee_payment->save();
        return true;
    }

    protected function reject($id)
    {
        $employee_payment = EmployeeAttachment::findOrFail($id);
        $employee_payment->is_approved = 2;
        $employee_payment->approved_by = auth()->id();
        $employee_payment->save();
        return true;
    }
}
