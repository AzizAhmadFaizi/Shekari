<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Province;
use App\Models\VicePresident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VicePresidentController extends Controller
{
    protected function index($organization_id)
    {
        $data['organization_id'] = $organization_id;

        $data['presidents'] = VicePresident::where('organization_id', decode_organization_id($organization_id))->orderBy('id', 'desc')->get();
        $data['countries'] = Country::select('id', 'name_dr')->get();
        $data['provinces'] = Province::select('id', 'name_dr')->get();
        return view('organization.vice-president', $data);
    }

    protected function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name_dr' => 'required',
                'last_name_dr' => 'required',
                'father_name' => 'required',
                'grand_father_name' => 'required',
                'contact_no' => 'required',
                'nid_pass_no' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png',
                'current_job' => 'required',
                'permanent_province_id' => 'required',
                'permanent_district_id' => 'required',
                'permanent_village' => 'required',
                'current_province_id' => 'required',
                'current_district_id' => 'required',
                'current_village' =>  'required',
                'tin' =>  'required',
            ],
            [
                'name_dr.required' => 'نام دری را بنوسید',
                'name_en.required' => 'نام انگلیسی را بنوسید',
                'last_name_dr.required' => 'تخلص دری را بنوسید',
                'last_name_en.required' => 'تخلص انگلیسی بنوسید',
                'father_name.required' =>  'نام پدر را بنوسید',
                'email.required' => 'ایمیل را بنوسید',
                'country_id.required' => 'کشور را انتخاب نمایید',
                'email.unique' => 'این ایمیل قبلا ثبت شده است',
                'contact_no.required' => 'شماره تماس را بنوسید',
                'nid_pass_no.required' => 'نمبر تذکره/پاسپورت را بنوسید',
                'current_job.required' => 'وظیفه فعلی را بنوسید',
                'permanent_province_id.required' =>  'ولایت را انتخاب نمایید',
                'permanent_district_id.required' =>  'ولسوالی را انتخاب نمایید',
                'permanent_village.required' =>  'قریه را بنوسید',
                'city.required' =>  'شهر را بنوسید',
                'street_no.required' =>  'نمبر سرک را بنوسید',
                'main_office_address.required' =>  'آدرس دفتر مرکزی رابنوسید',
                'current_province_id.required' => 'ولایت را انتخاب نمایید',
                'current_district_id.required' => 'ولسوالی را انتخاب نمایید',
                'current_village.required' =>  'قریه را بنوسید',
                'tin.required' =>  'TIN را بنوسید',
                'image.required' => 'عکس را انتخاب نمایید',
                'image.mimes' => 'عکس باید با فارمت های jpg,jpeg,png باشد',
                'attachments.required' => 'ضمایم را انتخاب نمایید',
            ]
        );

        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }

        if ($request->has('image')) {
            $img = Storage::disk('vice_president_images')->put(date('Y') . '/' . date('m'), $request->file('image'));
        }
        if ($request->has('attachments')) {
            $attachment = Storage::disk('vice_president_attachments')->put(date('Y') . '/' . date('m'), $request->file('attachments'));
        }
        $vice_president = $request->vice_president_id == 0 ? new VicePresident() : VicePresident::findOrFail($request->vice_president_id);
        if ($request->vice_president_id == 0) {
            $vice_president->organization_id = decode_organization_id($request->organization_id);
        }
        $vice_president->name_dr = $request->name_dr;
        $vice_president->last_name_dr = $request->last_name_dr;
        $vice_president->father_name = $request->father_name;
        $vice_president->grand_father_name = $request->grand_father_name;
        $vice_president->contact_no = $request->contact_no;
        $vice_president->family_contact_no = $request->family_contact_no;
        $vice_president->nid_pass_no = $request->nid_pass_no;
        $vice_president->tin = $request->tin;
        // if ($request->country_id == 1) {
            $vice_president->permanent_province_id = $request->permanent_province_id;
            $vice_president->permanent_district_id = $request->permanent_district_id;
            $vice_president->permanent_village = $request->permanent_village;
        // } else {
            // $vice_president->city = $request->city;
            // $vice_president->street_no = $request->street_no;
            // $vice_president->main_office_address = $request->main_office_address;
        // }
        if ($request->vice_president_id != 0) {
            $vice_president->is_approved = 0;
            $vice_president->approved_by = null;
        }
        $vice_president->current_province_id = $request->current_province_id;
        $vice_president->current_district_id = $request->current_district_id;
        $vice_president->current_village = $request->current_village;
        $vice_president->image = $request->vice_president_id == 0 ? $img : $vice_president->image;
        $request->vice_president_id == 0 ? $vice_president->created_by = get_user_id() : $vice_president->updated_by = get_user_id();
        $vice_president->attachments = $request->has('attachments') ? $attachment : $vice_president->attachments;
        $request->vice_president_id == 0 ? $vice_president->save() : $vice_president->update();
        return true;
    }

    protected function deactive(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'status_reason' => 'required',
                'status_attachments' => 'required'
            ],
            [
                'status_reason.required' => 'دلیل تبدیلی را بنوسید',
                'status_attachments.required' => 'ضمایم را انتخاب نمایید'
            ]
        );

        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }

        if ($request->has('status_attachments')) {
            $attachment = Storage::disk('president_attachments')->put(date('Y') . '/' . date('m'), $request->file('status_attachments'));
        }

        $vice_president = VicePresident::findOrFail($request->id);
        $vice_president->status_reason = $request->status_reason;
        $vice_president->status = 0;
        $vice_president->status_attachments =  $attachment;
        $vice_president->updated_by = get_user_id();
        $vice_president->update();
        return true;
    }

    protected function approve($id)
    {
        $vice_president = VicePresident::findOrFail($id);
        $vice_president->is_approved = 1;
        $vice_president->approved_by = auth()->id();
        $vice_president->save();
        return true;
    }

    protected function reject($id)
    {
        $vice_president = VicePresident::findOrFail($id);
        $vice_president->is_approved = 2;
        $vice_president->approved_by = auth()->id();
        $vice_president->save();
        return true;
    }
}
