<?php

namespace App\Http\Controllers;

use App\Models\WeaponPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WeaponPaymentController extends Controller
{
    protected function index($organization_id)
    {
        $data['organization_id'] = $organization_id;

        $data['weapon_payments'] = WeaponPayment::where('organization_id', decode_organization_id($organization_id))->orderBy('id', 'desc')->get();
        return view('organization.weapon-payment', $data);
    }

    protected function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'weapon_quantity' => 'required',
                'tariff_no' => 'required',
                'tariff_amount' => 'required',
                'tariff_date' => 'required|date',
                'attachments' => $request->weapon_payment_id == 0 ? 'required|mimes:pdf' : '',
            ],
            [
                'weapon_quantity.required' => 'تعداد اسلحه را بنوسید',
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
            $file = Storage::disk('weapon_payment_attachments')->put(date('Y') . '/' . date('m'), $request->file('attachments'));
        }

        $weapon_payment = $request->weapon_payment_id == 0 ? new WeaponPayment() : WeaponPayment::findOrFail($request->weapon_payment_id);
        if ($request->weapon_payment_id == 0) {
            $weapon_payment->organization_id = decode_organization_id($request->organization_id);
        }

        $weapon_payment->weapon_quantity = $request->weapon_quantity;
        $weapon_payment->tariff_no = $request->tariff_no;
        $weapon_payment->tariff_amount = $request->tariff_amount;
        if ($request->weapon_payment_id != 0) {
            $weapon_payment->is_approved = 0;
            $weapon_payment->approved_by = null;
        }
        $weapon_payment->tariff_date = to_gregorian($request->tariff_date);
        $weapon_payment->attachments = $request->weapon_payment_id == 0 ? $file : $weapon_payment->attachments;
        $request->weapon_payment_id == 0 ? $weapon_payment->created_by = get_user_id() : $weapon_payment->updated_by = get_user_id();
        $request->weapon_payment_id == 0 ? $weapon_payment->save() : $weapon_payment->update();

        return true;
    }

    protected function approve($id)
    {
        $employee_payment = WeaponPayment::findOrFail($id);
        $employee_payment->is_approved = 1;
        $employee_payment->approved_by = auth()->id();
        $employee_payment->save();
        return true;
    }

    protected function reject($id)
    {
        $employee_payment = WeaponPayment::findOrFail($id);
        $employee_payment->is_approved = 2;
        $employee_payment->approved_by = auth()->id();
        $employee_payment->save();
        return true;
    }
}
