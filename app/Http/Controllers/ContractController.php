<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ContractController extends Controller
{
    protected function index($organization_id)
    {
        $data['organization_id'] = $organization_id;
        $data['contracts'] = Contract::where('organization_id', decode_organization_id($organization_id))->orderBy('id', 'desc')->get();
        return view('organization.contract', $data);
    }

    protected function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'contract_reference' => 'required',
                'contract_location' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'afghan_employee_number' => 'required',
                'foreign_employee_number' => 'required',
                'weapon_quantity' => 'required',
                'vehicle_quantity' => 'required',
                'radio_quantity' => 'required',
                'cost' => 'required',
                'attachments' => $request->contract_id == 0 ? 'required|mimes:pdf' : '',
            ],
            [
                'contract_reference.required' => 'مرجع قراردادی را بنوسید',
                'contract_location.required' => 'موقعیت قرارداد',
                'start_date.required' => 'تاریخ شروع قرارداد را انتخاب نمایید',
                'start_date.date' => 'تاریخ شروع قرارداد باید بشکل تاریخ باشد',
                'end_date.required' => 'تاریخ ختم قرارداد را انتخاب نمایید',
                'end_date.date' => 'تاریخ ختم قرارداد باید بشکل تاریخ باشد',
                'afghan_employee_number.required' => 'تعداد پرسونل افغانی را بنوسید',
                'foreign_employee_number.required' => 'تعداد پرسونل خارجی را بنوسید',
                'weapon_quantity.required' => 'تعداد سلاح را بنوسید',
                'vehicle_quantity.required' => 'تعداد وسایط را بنوسید',
                'radio_quantity.required' => 'تعداد مخابره را بنوسید',
                'cost.required' => 'ارزش پولی را بنوسید',
                'attachments.required' => 'ضمایم را انتخاب نمایید',
                'attachments.mimes' => 'ضمایم باید pdf باشد',
            ]
        );

        if ($validator->fails())
            return json_encode($validator->errors()->toArray());

        $contract = $request->contract_id == 0 ? new Contract() : Contract::findOrFail($request->contract_id);
        if ($request->contract_id == 0) {
            $contract->organization_id = decode_organization_id($request->organization_id);
        }

        if ($request->has('attachments')) {
            $img = Storage::disk('contract_attachments')->put(date('Y') . '/' . date('m'), $request->file('attachments'));
        }

        $contract->contract_reference = $request->contract_reference;
        $contract->contract_location = $request->contract_location;
        $contract->start_date = to_gregorian($request->start_date);
        $contract->end_date = to_gregorian($request->end_date);
        $contract->afghan_employee_number = $request->afghan_employee_number;
        $contract->foreign_employee_number = $request->foreign_employee_number;
        $contract->weapon_quantity = $request->weapon_quantity;
        $contract->vehicle_quantity = $request->vehicle_quantity;
        $contract->radio_quantity = $request->radio_quantity;
        $contract->cost = $request->cost;
        $contract->comment = $request->comment;
        $contract->attachments = $request->contract_id == 0 ? $img : $contract->attachments;
        if ($request->contract_id != 0) {
            $contract->is_approved = 0;
            $contract->approved_by = null;
        }
        $request->contract_id == 0 ? $contract->created_by = get_user_id() : $contract->updated_by = get_user_id();
        $request->contract_id == 0 ? $contract->save() : $contract->update();
        return true;
    }

    protected function deactive(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'status_reason' => 'required',
            ],
            [
                'status_reason.required' => 'دلیل لغو/تکمیل قرارداد را بنوسید',
            ]
        );

        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }

        $contract = Contract::findOrFail($request->id);
        $contract->status_reason = $request->status_reason;
        $contract->status = 0;
        $contract->updated_by = get_user_id();
        $contract->update();
        return true;
    }

    protected function approve($id)
    {
        $president = Contract::findOrFail($id);
        $president->is_approved = 1;
        $president->approved_by = auth()->id();
        $president->save();
        return true;
    }

    protected function reject($id)
    {
        $president = Contract::findOrFail($id);
        $president->is_approved = 2;
        $president->approved_by = auth()->id();
        $president->save();
        return true;
    }
}
