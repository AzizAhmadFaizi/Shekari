<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Organization;
use App\Models\President;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PresidentController extends Controller
{
    protected function index($organization_id)
    {
        $data['organization_id'] = $organization_id;
        $data['organization'] = Organization::where('id', decode_organization_id($organization_id))->first();
        $data['presidents'] = President::where('organization_id', decode_organization_id($organization_id))->orderBy('id', 'desc')->get();
        $data['countries'] = Country::select('id', 'name_dr')->get();
        $data['provinces'] = Province::select('id', 'name_dr')->get();
        return view('organization.president', $data);
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
                'tin' =>  $request->organization_type == 1 ? 'required' : '',
                'image' => $request->president_id == 0 ? 'required|mimes:jpeg,jpg,png' : '',
            ],
            [
                'name_dr.required' => 'نام دری را بنوسید',
                'last_name_dr.required' => 'تخلص دری را بنوسید',
                'father_name.required' =>  'نام پدر را بنوسید',
                'country_id.required' => 'کشور را انتخاب نمایید',
                'contact_no.required' => 'شماره تماس را بنوسید',
                'nid_pass_no.required' => 'نمبر تذکره/پاسپورت را بنوسید',
                'current_job.required' => 'وظیفه فعلی را بنوسید',
                'permanent_province_id.required' =>  'ولایت را انتخاب نمایید',
                'permanent_district_id.required' =>  'ولسوالی را انتخاب نمایید',
                'permanent_village.required' =>  'قریه را بنوسید',
                'current_province_id.required' => 'ولایت را انتخاب نمایید',
                'current_district_id.required' => 'ولسوالی را انتخاب نمایید',
                'current_village.required' =>  'قریه را بنوسید',
                'tin.required' =>  'TIN را بنوسید',
                'image.required' => 'عکس را انتخاب نمایید',
                'image.mimes' => 'عکس باید با فارمت های jpg,jpeg,png باشد',
            ]
        );

        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }

        if ($request->has('image')) {
            $img = Storage::disk('president_images')->put(date('Y') . '/' . date('m'), $request->file('image'));
        }
        if ($request->has('attachments')) {
            $attachment = Storage::disk('president_attachments')->put(date('Y') . '/' . date('m'), $request->file('attachments'));
        }

        $president = $request->president_id == 0 ? new President() : President::findOrFail($request->president_id);
        if ($request->president_id == 0) {
            $president->organization_id = decode_organization_id($request->organization_id);
        }
        $president->name_dr = $request->name_dr;
        $president->last_name_dr = $request->last_name_dr;
        $president->father_name = $request->father_name;
        $president->grand_father_name = $request->grand_father_name;
        $president->contact_no = $request->contact_no;
        $president->family_contact_no = $request->family_contact_no;
        $president->nid_pass_no = $request->nid_pass_no;
        $president->tin = $request->tin;
        // $president->country_id = $request->country_id;
        // if ($request->country_id == 1) {
            $president->permanent_province_id = $request->permanent_province_id;
            $president->permanent_district_id = $request->permanent_district_id;
            $president->permanent_village = $request->permanent_village;
        // } else {
        //     $president->city = $request->city;
        //     $president->street_no = $request->street_no;
        //     $president->main_office_address = $request->main_office_address;
        // }
        if ($request->president_id != 0) {
            $president->is_approved = 0;
            $president->approved_by = null;
        }
        $president->current_province_id = $request->current_province_id;
        $president->current_district_id = $request->current_district_id;
        $president->current_village = $request->current_village;
        $president->image = $request->has('image') ? $img : $president->image;
        $president->attachments = $request->has('attachments') ? $attachment : $president->attachments;
        $request->president_id == 0 ? $president->created_by = get_user_id() : $president->updated_by = get_user_id();
        $request->president_id == 0 ? $president->save() : $president->update();
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

        $president = President::findOrFail($request->id);
        $president->status_reason = $request->status_reason;
        $president->status = 0;
        $president->status_attachments =  $attachment;
        $president->updated_by = get_user_id();
        $president->update();
        return true;
    }

    protected function approve($id)
    {
        $president = President::findOrFail($id);
        $president->is_approved = 1;
        $president->approved_by = auth()->id();
        $president->save();
        return true;
    }

    protected function reject($id)
    {
        $president = President::findOrFail($id);
        $president->is_approved = 2;
        $president->approved_by = auth()->id();
        $president->save();
        return true;
    }
}
