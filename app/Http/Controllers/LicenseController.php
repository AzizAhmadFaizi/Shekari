<?php

namespace App\Http\Controllers;

use App\Models\License;
use App\Models\LicenseType;
use App\Models\Organization;
use App\Models\President;
use App\Models\VicePresident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LicenseController extends Controller
{
    protected function index($organization_id)
    {
        $data['organization_id'] = $organization_id;
        $data['organization_type'] = Organization::where('id', decode_organization_id($organization_id))->first()->type;
// dd($data['organization_type']);
        $data['licenses'] = License::where('organization_id', decode_organization_id($organization_id))->orderBy('id', 'desc')->get();
        $data['license_types'] = LicenseType::select('id', 'name_dr')->get();
        return view('organization.license', $data);
    }

    protected function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'license_type_id' => 'required',
                'issue_date' => 'required',
                'expire_date' => 'required',
                'tariff_no' => 'required',
                'tariff_date' => 'required',
                'tariff_amount' => 'required',
                'attachment_files' => $request->license_id == 0 ? 'required|mimes:pdf' : '',
            ],
            [
                'license_type_id.required' => 'نوعیت جواز را انتخاب نمایید',
                'issue_date.required' => 'تاریخ صدور را انتخاب نمایید',
                'issue_date.date' => 'تاریخ صدور باید شکل تاریخ باشد',
                'expire_date.required' => 'تاریخ انقضاء را انتخاب نمایید',
                'expire_date.date' => 'تاریخ انقضاء باید شکل تاریخ باشد',
                'tariff_no.required' => 'نمبر آویز بانکی را بنوسید',
                'tariff_date.required' => 'تاریخ پرداخت آویز را انتخاب نمایید',
                'tariff_date.date' => 'تاریخ آویز بشکل تاریخ باشد',
                'tariff_amount.required' => 'مقدار پرداخت را بنوسید',
                'attachment_files.required' => 'ضمایم را انتخاب نمایید',
                'attachment_files.mimes' => 'ضمایم باید با فارمت های pdf باشد',
            ]
        );

        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }

        if ($request->has('attachment_files')) {
            $file = Storage::disk('attachment_files')->put(date('Y') . '/' . date('m'), $request->file('attachment_files'));
        }

        $license = $request->license_id == 0 ? new License() : License::findOrFail($request->license_id);

        if ($request->license_id == 0) {
            $x = base64_decode($request->organization_id);
            $x = explode('-', $x)[1];
            $license->organization_id = base64_decode($x);
        }
        $new_id = 1;
        $last_id = License::where('type', $request->organization_type)->orderBy('id', 'DESC')->first();
        if (isset($last_id)) {
            $new_id = $last_id->type_id + 1;
        }

        $license->type_id = $new_id;
        $license->type = $request->organization_type;
        $license->license_type_id = $request->license_type_id;
        $license->issue_date = to_gregorian($request->issue_date);
        $license->expire_date = to_gregorian($request->expire_date);
        $license->tariff_no = $request->tariff_no;
        $license->tariff_date = to_gregorian($request->tariff_date);
        $license->tariff_amount = $request->tariff_amount;
        $license->attachment_files = $request->license_id == 0 ? $file : $license->attachment_files;
        if ($request->license_id != 0) {
            $license->is_approved = 0;
            $license->approved_by = null;
        }
        $request->license_id == 0 ? $license->created_by = get_user_id() : $license->updated_by = get_user_id();
        $request->license_id == 0 ? $license->save() : $license->update();

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
                'status_reason.required' => 'دلیل لغو را بنوسید',
            ]
        );

        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }

        $license = License::findOrFail($request->id);
        $license->status_reason = $request->status_reason;
        $license->status = 0;
        $license->updated_by = get_user_id();
        $license->update();
        return true;
    }

    protected function print($license_id)
    {

        $data['license'] = License::findOrFail(decode_organization_id($license_id));
        $data['organization'] = Organization::where('id', $data['license']->organization_id)->select('name_en', 'name_dr', 'logo', 'type')->first();
        $data['president'] = President::where(['status' => 1, 'organization_id' => $data['license']->organization_id])->orderBy('id', 'desc')->select('name_dr', 'name_en', 'last_name_dr', 'last_name_en', 'image')->first();
        $data['vice_president'] = VicePresident::where(['status' => 1, 'organization_id' => $data['license']->organization_id])->orderBy('id', 'desc')->select('name_dr', 'name_en', 'last_name_dr', 'last_name_en', 'image')->first();
        if ($data['organization']->type == 1) {
            return view('organization.license-org-print', $data);
        }elseif ($data['organization']->type == 2) {
            return view('organization.license-print', $data);
        }
    }

    protected function printed($license_id)
    {
        $license = License::findOrFail($license_id);
        $license->is_printed = 1;
        $license->is_approved = 1;
        $license->printed_by = get_user_id();
        $license->approved_by = get_user_id();
        $license->printed_at = date('Y-m-d');
        $license->update();
        $organization = Organization::where('id', $license->organization_id)->first();
        President::where('organization_id', $organization->id)->update([
            'is_approved' => 1,
            'approved_by' => get_user_id()
        ]);
        VicePresident::where('organization_id', $organization->id)->update([
            'is_approved' => 1,
            'approved_by' => get_user_id()
        ]);

        return redirect()->route('organization-general-form', encode_organization_id($license->organization_id))->with('success_print', 'جواز موفقانه چاپ گردید');
    }

    protected function approve($id)
    {
        $license = License::findOrFail($id);
        $license->is_approved = 1;
        $license->approved_by = auth()->id();
        $license->save();
        return true;
    }

    protected function reject($id)
    {
        $license = License::findOrFail($id);
        $license->is_approved = 2;
        $license->approved_by = auth()->id();
        $license->save();
        return true;
    }
}
