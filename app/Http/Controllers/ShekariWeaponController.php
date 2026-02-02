<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\ShekariWeapon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ShekariWeaponController extends Controller
{
    protected function index(Request $request)
    {
        // dd('helloooooooooo');
          $data['organizations'] = Organization::select('id', 'name_dr')->get();
        return view('shekari-weapon.index', $data);
    }

   protected function store(Request $request)
{
    $validator = Validator::make(
        $request->all(),
        [
            'organization_id' => 'required',
            'hijri_warada_date' => 'date',
            'maktoob_date' => 'date',

            // ✅ validate serial numbers
            // 'serial_numbers' => 'nullable|array',
            // 'serial_numbers.*' => 'required|string|max:255',
        ],
        [
            'organization_id.required' => 'اتخاب شرکت الزامی میباشد',
            'hijri_warada_date.date' => 'تاریخ واردات الزامی میباشد',
            'maktoob_date.date' => 'تاریخ مکتوب الزامی میباشد',
        ]
    );

    if ($validator->fails()) {
        return json_encode($validator->errors()->toArray());
    }

    DB::beginTransaction();
    try {

        // ==============================
        // upload attachment
        // ==============================
        $attach = null;
        if ($request->has('attachment')) {
            $attach = Storage::disk('shekari_weapon_files')
                ->put(date('Y') . '/' . date('m'), $request->file('attachment'));
        }



        // ==============================
        // create shekari_weapon
        // ==============================
        $shekari_weapon = new ShekariWeapon();

        $shekari_weapon->organization_id = $request->organization_id;
        $shekari_weapon->hijri_warada_date = $request->hijri_warada_date;
        $shekari_weapon->maktoob_date = $request->maktoob_date;
        $shekari_weapon->maktoob_number = $request->maktoob_number;
        $shekari_weapon->invoice_number = $request->invoice_number;
        $shekari_weapon->airo_bill_number = $request->airo_bill_number;
        $shekari_weapon->warada_way = $request->warada_way;
        $shekari_weapon->tarofa = $request->tarofa;
        $shekari_weapon->type = $request->type;
        $shekari_weapon->quantity = $request->quantity;
        $shekari_weapon->fess = $request->fess;
        $shekari_weapon->revenue = $request->quantity * $request->fess;
        $shekari_weapon->attachment = $request->has('attachment') ? $attach : null;
        $shekari_weapon->created_by = auth()->id();
        $shekari_weapon->save();

        // =============================================================
        // create  shekari_weapon_serial_numbers data comes in array
        // =============================================================

        if ($request->filled('serial_numbers')) {
            foreach ($request->serial_numbers as $serial) {
                DB::table('shekari_weapon_serial_numbers')->insert([
                    'shekari_weapon_id' => $shekari_weapon->id,
                    'serial_number'     => $serial,
                    'created_by'        => auth()->id(),
                    'created_at'        => now(),
                ]);
            }
        }
        DB::commit();
        return true;

    } catch (\Exception $e) {

    dd($e->getMessage());
        DB::rollBack();
        return response()->json([
            'response' => false,
            'message'  => $e->getMessage()
        ], 500);
    }
}

}
