<?php

namespace App\Http\Controllers;

use App\Models\Weapon;
use App\Models\WeaponAttachment;
use App\Models\WeaponPrint;
use App\Models\WeaponStatus;
use App\Models\WeaponType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WeaponController extends Controller
{
    protected function index($organization_id)
    {
        $data['organization_id'] = $organization_id;

        $data['weapon_attachments'] = WeaponAttachment::where(['organization_id' => decode_organization_id($organization_id), 'is_approved' => 1])->where('remain_weapon_number', '>', 0)->get();
        $data['weapons'] = Weapon::where(['organization_id' => decode_organization_id($organization_id), 'weapon_status_id' => null])->orderBy('id', 'desc')->get();
        $data['weapon_types'] = WeaponType::select('id', 'name_dr')->get();
        $data['active_weapons'] = Weapon::where(['organization_id' => decode_organization_id($organization_id), 'weapon_status_id' => null, 'is_approved' => 1])->orderBy('id', 'desc')->select('id', 'weapon_no', 'weapon_diameter', 'is_used', 'magazine_quantity')->get();
        return view('organization.weapon', $data);
    }

    protected function unused_weapons($organization_id)
    {
        $data['organization_id'] = $organization_id;

        $data['weapons'] = Weapon::where('organization_id', decode_organization_id($organization_id))->where('weapon_status_id', '!=', null)->orderBy('id', 'desc')->get();
        return view('organization.unused-weapon', $data);
    }

    protected function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'weapon_no' => 'required',
                'weapon_diameter' => 'required',
                'is_used' => 'required',
                'weapon_type_id' => 'required',
                'magazine_quantity' => 'required|numeric'
            ],
            [
                'weapon_no.required' => 'نمبر اسلحه را بنوسید',
                'weapon_diameter.required' => 'قطر اسلحه را بنوسید',
                'is_used.required' => 'نوعیت سلاح را انتخاب نمایید',
                'magazine_quantity.required' => 'تعداد جبه را بنوسید',
                'weapon_type_id.required' => 'سلاح را انتخاب نمایید',
                'magazine_quantity.numeric' => 'تعداد جبه را به نمبر بنوسید',
            ]
        );

        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }

        $weapon = $request->weapon_id == 0 ? new Weapon() : Weapon::findOrFail($request->weapon_id);
        if ($request->weapon_id == 0) {

            $weapon->organization_id = decode_organization_id($request->organization_id);
            $e = WeaponAttachment::findOrFail($request->weapon_attachment_id);
            $e->remain_weapon_number = $e->remain_weapon_number - 1;
            $e->update();
        }

        $weapon->weapon_no = $request->weapon_no;
        $weapon->weapon_diameter = $request->weapon_diameter;
        $weapon->is_used = $request->is_used;
        $weapon->magazine_quantity = $request->magazine_quantity;
        $weapon->weapon_attachment_id = $request->weapon_attachment_id;
        $weapon->weapon_type_id = $request->weapon_type_id;
        $request->weapon_id == 0 ? $weapon->created_by = get_user_id() : $weapon->updated_by = get_user_id();
        if ($request->weapon_id != 0) {
            $weapon->is_approved = 0;
            $weapon->approved_by = null;
        }
        $request->weapon_id == 0 ? $weapon->save() : $weapon->update();

        return true;
    }

    protected function deactive(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'new_weapons' => 'required|array',
                'is_active_reason' => 'required',
                'status_attachments' => 'required',
            ],
            [
                'new_weapons.required' => 'اسلحه را انتخاب نمایید',
                'is_active_reason.required' => 'دلیل لغو را بنوسید',
                'status_attachments.required' => 'ضمایم را انتخاب نمایید'
            ]
        );

        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }

        $x = base64_decode($request->org_id);
        $x = explode('-', $x)[1];

        if ($request->has('status_attachments')) {
            $file = Storage::disk('weapon_attachment_files')->put(date('Y') . '/' . date('m'), $request->file('status_attachments'));
        }

        $es = new WeaponStatus();
        $es->organization_id = base64_decode($x);
        $es->status_reason = $request->is_active_reason;
        $es->attachments = $file;
        $es->created_by = get_user_id();
        $es->save();

        foreach ($request->new_weapons as $key => $value) {
            $employee = Weapon::findOrFail($value);
            $employee->weapon_status_id = $es->id;
            $employee->updated_by = get_user_id();
            $employee->update();
        }

        return true;
    }

    protected function send_to_print(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'weapons' => 'required|array',
                'project_name_dr' => 'required',
                'card_limit_dr' => 'required',
                'project_name_en' => 'required',
                'card_limit_en' => 'required',
                'issue_date' => 'required',
                'valid_date' => 'required',
            ],
            [
                'weapons.required' => 'اسلحه را انتخاب نمایید',
                'project_name_dr.required' => 'نام پروژه (دری) را بنوسید',
                'card_limit_dr.required' => 'محدودیت کارت (دری) را بنوسید',
                'project_name_en.required' => 'نام پروژه(انگلیسی) را بنوسید',
                'card_limit_en.required' => 'محدودیت کارت (انگلیسی) را بنوسید',
                'issue_date.required' => 'تاریخ صدور را انتخاب نمایید',
                'valid_date.required' => 'تاریخ اعتبار را انتخاب نمایید',
            ]
        );

        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }


        foreach ($request->weapons as $key => $value) {
            $weapon = Weapon::findOrFail($value);
            $weapon->status = 2;
            $weapon->updated_by = get_user_id();
            $weapon->update();

            $weapon_print = new WeaponPrint();
            $weapon_print->organization_id = $weapon->organization_id;
            $weapon_print->weapon_id = $weapon->id;
            $weapon_print->project_name_dr = $request->project_name_dr;
            $weapon_print->card_limit_dr = $request->card_limit_dr;
            $weapon_print->project_name_en = $request->project_name_en;
            $weapon_print->card_limit_en = $request->card_limit_en;
            $weapon_print->issue_date = to_gregorian($request->issue_date);
            $weapon_print->valid_date = to_gregorian($request->valid_date);
            $weapon_print->created_by = get_user_id();
            $weapon_print->save();
        }

        return true;
    }

    protected function approve($id)
    {
        $president = Weapon::findOrFail($id);
        $president->is_approved = 1;
        $president->approved_by = auth()->id();
        $president->save();
        return true;
    }

    protected function reject($id)
    {
        $president = Weapon::findOrFail($id);
        $president->is_approved = 2;
        $president->approved_by = auth()->id();
        $president->save();
        return true;
    }
}
