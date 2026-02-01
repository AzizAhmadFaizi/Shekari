<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeAttachment;
use App\Models\EmployeeStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    protected function index($organization_id)
    {
        $data['organization_id'] = $organization_id;

        $data['employee_attachments'] = EmployeeAttachment::where(['organization_id' => decode_organization_id($organization_id), 'is_approved' => 1])->where('remain_employee_number', '>', 0)->get();
        $data['employees'] = Employee::where(['organization_id' => decode_organization_id($organization_id), 'employee_status_id' => null])->orderBy('id', 'desc')->get();
        $data['active_employees'] = Employee::where(['organization_id' => decode_organization_id($organization_id), 'employee_status_id' => null, 'is_approved' => 1])->orderBy('id', 'desc')->select('id', 'name', 'last_name', 'position', 'national_id')->get();
        return view('organization.employee', $data);
    }

    protected function fired_employees($organization_id)
    {
        $data['organization_id'] = $organization_id;
        $data['employees'] = Employee::where('organization_id', decode_organization_id($organization_id))->where('employee_status_id', '!=', null)->orderBy('id', 'desc')->get();
        return view('organization.employee-fired', $data);
    }

    protected function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'last_name' => 'required',
                'father_name' => 'required',
                'national_id' => 'required',
                'position' => 'required',
                'nationality' => 'required',
                'employee_attachment_id' => 'required',
                'attachments' => $request->employee_id == 0 ? 'required|mimes:pdf' : '',
            ],
            [
                'name.required' => 'اسم را بنوسید',
                'last_name.required' => 'تخلص را بنوسید',
                'father_name.required' => 'اسم پدر را بنوسید',
                'national_id.required' => 'نمبر تذکره/پاسپورت را بنوسید',
                'position.required' => 'وظیفه را بنوسید',
                'nationality.required' => 'ملیت را انتخاب نمایید',
                'employee_attachment_id.required' => 'جدول کارمندان را انتخاب نمایید',
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

        $employee = $request->employee_id == 0 ? new Employee() : Employee::findOrFail($request->employee_id);
        if ($request->employee_id == 0) {
            $employee->organization_id = decode_organization_id($request->organization_id);
            $e = EmployeeAttachment::findOrFail($request->employee_attachment_id);
            $e->remain_employee_number = $e->remain_employee_number - 1;
            $e->update();
        }

        $employee->name = $request->name;
        $employee->last_name = $request->last_name;
        $employee->father_name = $request->father_name;
        $employee->position = $request->position;
        $employee->national_id = $request->national_id;
        $employee->nationality = $request->nationality;
        $employee->employee_attachment_id = $request->employee_attachment_id;
        $employee->attachments = $request->employee_id == 0 ? $file : $employee->attachments;
        if ($request->employee_id != 0) {
            $employee->is_approved = 0;
            $employee->approved_by = null;
        }
        $request->employee_id == 0 ? $employee->created_by = get_user_id() : $employee->updated_by = get_user_id();
        $request->employee_id == 0 ? $employee->save() : $employee->update();

        return true;
    }

    protected function deactive(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'employees' => 'required|array',
                'is_active_reason' => 'required',
                'status_attachments' => 'required',
            ],
            [
                'employees.required' => 'کارمندان را انتخاب نمایید',
                'is_active_reason.required' => 'دلیل لغو را بنوسید',
                'status_attachments.required' => 'ضمایم را انتخاب نمایید'
            ]
        );

        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }

        if ($request->has('status_attachments')) {
            $file = Storage::disk('employee_status_attachments')->put(date('Y') . '/' . date('m'), $request->file('status_attachments'));
        }

        $es = new EmployeeStatus();
        $es->organization_id = decode_organization_id($request->org_id);
        $es->status_reason = $request->is_active_reason;
        $es->attachments = $file;
        $es->created_by = get_user_id();
        $es->save();

        foreach ($request->employees as $key => $value) {
            $employee = Employee::findOrFail($value);
            $employee->employee_status_id = $es->id;
            $employee->updated_by = get_user_id();
            $employee->update();
        }

        return true;
    }

    protected function approve($id)
    {
        $employee_payment = Employee::findOrFail($id);
        $employee_payment->is_approved = 1;
        $employee_payment->approved_by = auth()->id();
        $employee_payment->save();
        return true;
    }

    protected function reject($id)
    {
        $employee_payment = Employee::findOrFail($id);
        $employee_payment->is_approved = 2;
        $employee_payment->approved_by = auth()->id();
        $employee_payment->save();
        return true;
    }
}
