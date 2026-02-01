<?php

namespace App\Http\Controllers;

use App\Models\EmployeePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EmployeePaymentController extends Controller
{
    protected function index($organization_id)
    {
        $data['organization_id'] = $organization_id;

        $data['employee_payments'] = EmployeePayment::where('organization_id', decode_organization_id($organization_id))->orderBy('id', 'desc')->get();
        return view('organization.employee-payment', $data);
    }

    protected function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'employee_number' => 'required',
                'tariff_no' => 'required',
                'tariff_amount' => 'required',
                'tariff_date' => 'required|date',
                'attachments' => $request->employee_payment_id == 0 ? 'required|mimes:pdf' : '',
            ],
            [
                'employee_number.required' => 'تعداد کارمندان را بنوسید',
                'tariff_no.required' => 'نمبر تعرفه را بنوسید',
                'tariff_amount.required' => 'مقدار تعرفه را بنوسید',
                'tariff_date.required' => 'تاریخ پرداخت تعرفه را انتخاب نمایید',
                'attachments.required' => 'ضمایم را انتخاب نمایید',
                'attachments.mimes' => 'ضمایم باید با فارمت های pdf باشد',
            ]
        );

        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }

        if ($request->has('attachments')) {
            $file = Storage::disk('employee_payment_attachments')->put(date('Y') . '/' . date('m'), $request->file('attachments'));
        }

        $employee = $request->employee_payment_id == 0 ? new EmployeePayment() : EmployeePayment::findOrFail($request->employee_payment_id);
        if ($request->employee_payment_id == 0) {
            $employee->organization_id = decode_organization_id($request->organization_id);
        }

        $employee->employee_number = $request->employee_number;
        $employee->tariff_no = $request->tariff_no;
        $employee->tariff_amount = $request->tariff_amount;
        $employee->tariff_date = to_gregorian($request->tariff_date);
        $employee->attachments = $request->employee_payment_id == 0 ? $file : $employee->attachments;
        if ($request->employee_payment_id != 0) {
            $employee->is_approved = 0;
            $employee->approved_by = null;
        }
        $request->employee_payment_id == 0 ? $employee->created_by = get_user_id() : $employee->updated_by = get_user_id();
        $request->employee_payment_id == 0 ? $employee->save() : $employee->update();

        return true;
    }

    protected function approve($id)
    {
        $employee_payment = EmployeePayment::findOrFail($id);
        $employee_payment->is_approved = 1;
        $employee_payment->approved_by = auth()->id();
        $employee_payment->save();
        return true;
    }

    protected function reject($id)
    {
        $employee_payment = EmployeePayment::findOrFail($id);
        $employee_payment->is_approved = 2;
        $employee_payment->approved_by = auth()->id();
        $employee_payment->save();
        return true;
    }
}
