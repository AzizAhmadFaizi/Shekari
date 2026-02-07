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
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\Log;


class ShekariWeaponController extends Controller
{
    protected function index(Request $request)
{
    $organizations = Organization::where('type', 1)
        ->select('id', 'name_dr')
        ->get();

    if ($request->ajax()) {

        $query = ShekariWeapon::with([
                'organization',
                'serials',
                'createdBy'
            ])
            ->whereHas('organization', function ($q) {
                $q->where('type', 1);
            })
            ->orderBy('id', 'desc');

        /*
        |-----------------------------------
        | Filter by organization
        |-----------------------------------
        */
        if ($request->search_organization_id) {
            $query->where('organization_id', $request->search_organization_id);
        }

        /*
        |-----------------------------------
        | Filter by serial number
        |-----------------------------------
        */
        if ($request->search_serial_number) {
            $query->whereHas('serials', function ($q) use ($request) {
                $q->where('serial_number', 'like', '%' . $request->search_serial_number . '%');
            });
        }

        return DataTables::of($query)
            ->addIndexColumn()

            ->addColumn('name', fn($row) => $row->organization->name_dr ?? '-')
            ->addColumn('hijri_warada_date', fn($row) => $row->hijri_warada_date ?? '-')
            ->addColumn('maktoob_date', fn($row) => $row->maktoob_date ?? '-')
            ->addColumn('maktoob_number', fn($row) => $row->maktoob_number ?? '-')
            ->addColumn('quantity', fn($row) => $row->quantity ?? 0)
            ->addColumn('revenue', fn($row) => $row->revenue ?? 0)

            ->addColumn('action', function ($row) {
                               $serials = $row->serials->pluck('serial_number')->toArray(); // array of serials
                $serials_json = htmlspecialchars(json_encode($serials), ENT_QUOTES, 'UTF-8'); // safely encode
                $attachment = $row->attachment ? asset('storage/shekari_weapon_files/' . $row->attachment) : '';
                $btn = '';
                $btn .=  "<a href='#'
                    class='edit_btn'
                    style='cursor:pointer'
                    data-id='{$row->id}'
                    data-organization='{$row->organization->id}'
                    data-hijri='{$row->hijri_warada_date}'
                    data-maktoobdate='{$row->maktoob_date}'
                    data-maktoobnumber='{$row->maktoob_number}'
                    data-invoice='{$row->invoice_number}'
                    data-airo='{$row->airo_bill_number}'
                    data-way='{$row->warada_way}'
                    data-tarofa='{$row->tarofa}'
                    data-type='{$row->type}'
                    data-quantity='{$row->quantity}'
                    data-fess='{$row->fess}'
                    data-attachment='{$attachment}'
                    data-serials='{$serials_json}'
                >
                    <span class='btn btn-primary btn-sm fa fa-edit'></span>
                </a>";
                $btn .=  "<a href='#'
                    class='show_btn'
                    style='cursor:pointer'
                    data-id='{$row->id}'
                    data-organization='{$row->organization->id}'
                    data-hijri='{$row->hijri_warada_date}'
                    data-maktoobdate='{$row->maktoob_date}'
                    data-maktoobnumber='{$row->maktoob_number}'
                    data-invoice='{$row->invoice_number}'
                    data-airo='{$row->airo_bill_number}'
                    data-way='{$row->warada_way}'
                    data-tarofa='{$row->tarofa}'
                    data-type='{$row->type}'
                    data-quantity='{$row->quantity}'
                    data-fess='{$row->fess}'
                    data-attachment='{$attachment}'
                    data-serials='{$serials_json}'
                >
                    <span class='btn btn-info btn-sm fa fa-eye'></span>
                </a>";
                $btn .=  "<a href='#'
                    class='delete_btn'
                    style='cursor:pointer'
                    data-id='{$row->id}'
                >
                    <span class='btn btn-danger btn-sm fa fa-trash'></span>
                </a>"
                ;
                return $btn;
            })

            ->rawColumns(['action'])
            ->make(true);
    }

    return view('shekari-weapon.index', compact('organizations'));
}


//    protected function index(Request $request)
//     {

//         $data['organizations'] = Organization::where('type', 1)
//         ->select('id', 'name_dr')
//         ->get();
//         if ($request->ajax()){

//             $data = ShekariWeapon::with([
//                 'organization',
//                 'serials',
//                 'createdBy'
//                 ])
//                 ->whereHas('organization', function ($query) {
//                     $query->where('type', 1); // Only organizations with type = 1
//                     })
//                     ->orderBy('id', 'desc')
//                     ->get();



//                     if ($request->organization_id) {
//                         $data = $data->where('organization_id', $request->organization_id);
//                         }

//                 // if ($request->serial_number) {
//                 //     $data = $data->filter(function ($row) use ($request) {
//                 //         return $row->serials->contains(function ($serial) use ($request) {
//                 //             return strpos($serial->serial_number, $request->serial_number) !== false;
//                 //         });
//                 //     });
//                 // }

//                    if ($request->serial_number) {
//                        $data->whereHas('serials', function ($q) use ($request) {
//                            $q->where('serial_number', 'like', '%' . $request->serial_number . '%');
//                            });

//                 }


//                return DataTables::of($data)
//                ->addIndexColumn()

//                 ->addColumn('name', function ($row) {
//                     return $row->organization->name_dr ?? '-';
//                 })
//                 ->addColumn('hijri_warada_date', function ($row) {
//                     return $row->hijri_warada_date ?? '-';
//                 })
//                 ->addColumn('maktoob_date', function ($row) {
//                     return $row->maktoob_date ?? '-';
//                 })
//                 ->addColumn('maktoob_number', function ($row) {
//                     return $row->maktoob_number ?? '-';
//                 })
//                 ->addColumn('quantity', function ($row) {
//                     return $row->quantity ?? 0;
//                 })
//                 ->addColumn('revenue', function ($row) {
//                     return $row->revenue ?? 0;
//                 })
//                 ->addColumn('action', function ($row) {
//                 $serials = $row->serials->pluck('serial_number')->toArray(); // array of serials
//                 $serials_json = htmlspecialchars(json_encode($serials), ENT_QUOTES, 'UTF-8'); // safely encode
//                 $attachment = $row->attachment ? asset('storage/shekari_weapon_files/' . $row->attachment) : '';
//                 $btn = '';
//                 $btn .=  "<a href='#'
//                     class='edit_btn'
//                     style='cursor:pointer'
//                     data-id='{$row->id}'
//                     data-organization='{$row->organization->id}'
//                     data-hijri='{$row->hijri_warada_date}'
//                     data-maktoobdate='{$row->maktoob_date}'
//                     data-maktoobnumber='{$row->maktoob_number}'
//                     data-invoice='{$row->invoice_number}'
//                     data-airo='{$row->airo_bill_number}'
//                     data-way='{$row->warada_way}'
//                     data-tarofa='{$row->tarofa}'
//                     data-type='{$row->type}'
//                     data-quantity='{$row->quantity}'
//                     data-fess='{$row->fess}'
//                     data-attachment='{$attachment}'
//                     data-serials='{$serials_json}'
//                 >
//                     <span class='btn btn-primary btn-sm fa fa-edit'></span>
//                 </a>";
//                 $btn .=  "<a href='#'
//                     class='show_btn'
//                     style='cursor:pointer'
//                     data-id='{$row->id}'
//                     data-organization='{$row->organization->id}'
//                     data-hijri='{$row->hijri_warada_date}'
//                     data-maktoobdate='{$row->maktoob_date}'
//                     data-maktoobnumber='{$row->maktoob_number}'
//                     data-invoice='{$row->invoice_number}'
//                     data-airo='{$row->airo_bill_number}'
//                     data-way='{$row->warada_way}'
//                     data-tarofa='{$row->tarofa}'
//                     data-type='{$row->type}'
//                     data-quantity='{$row->quantity}'
//                     data-fess='{$row->fess}'
//                     data-attachment='{$attachment}'
//                     data-serials='{$serials_json}'
//                 >
//                     <span class='btn btn-info btn-sm fa fa-eye'></span>
//                 </a>";
//                 $btn .=  "<a href='#'
//                     class='delete_btn'
//                     style='cursor:pointer'
//                     data-id='{$row->id}'
//                 >
//                     <span class='btn btn-danger btn-sm fa fa-trash'></span>
//                 </a>"
//                 ;
//                 return $btn;
//             })
//                 ->rawColumns(['action'])
//                 ->make(true);
//         }


//         return view('shekari-weapon.index',   $data);
//     }
   protected function store(Request $request)
    {
        // dd($request->all());
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
            // $attach = null;
            // if ($request->has('attachment')) {
            //     $attach = Storage::disk('shekari_weapon_files')
            //         ->put(date('Y') . '/' . date('m'), $request->file('attachment'));
            // }

            // ==============================
            // upload attachment (EDIT SAFE)
            // ==============================
            $request->shekari_weapon_id == 0 ?  $shekari_weapon = new ShekariWeapon() : $shekari_weapon = ShekariWeapon::findOrFail($request->shekari_weapon_id);

            $attach = $shekari_weapon->attachment ?? null; // keep old by default

            if ($request->hasFile('attachment')) {

                // delete old file if exists
                if ($shekari_weapon->attachment &&
                    Storage::disk('shekari_weapon_files')->exists($shekari_weapon->attachment)) {

                    Storage::disk('shekari_weapon_files')->delete($shekari_weapon->attachment);
                }

                // upload new file
                $attach = Storage::disk('shekari_weapon_files')->put(
                    date('Y') . '/' . date('m'),
                    $request->file('attachment')
                );
            }

            // ==============================
            // create shekari_weapon
            // ==============================

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
            $shekari_weapon->updated_by = $request->shekari_weapon_id != 0 ? auth()->id() : null;
            $shekari_weapon->save();

        // =============================================================
            // handle serial numbers (ALWAYS SAFE)
            // =============================================================

            // always delete old serials
            DB::table('shekari_weapon_serial_numbers')
                ->where('shekari_weapon_id', $shekari_weapon->id)
                ->delete();

            // insert only if exists
            if ($request->has('serial_numbers') && is_array($request->serial_numbers)) {

                foreach ($request->serial_numbers as $serial) {

                    if(trim($serial) == '') continue; // skip empty rows

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

   protected function delete($id)
    {
        $shekari_weapon = ShekariWeapon::findOrFail($id);
        // delete file if exists
        if ($shekari_weapon->attachment && Storage::disk('shekari_weapon_files')->exists($shekari_weapon->attachment)) {
            Storage::disk('shekari_weapon_files')->delete($shekari_weapon->attachment);
        }
        $shekari_weapon->delete();
        return true;
    }

      protected function report(Request $request)
    {
        $data['organizations'] = Organization::where('type', 1)
        ->select('id', 'name_dr')
        ->get();

        $specialReportStartDate = null;
        $specialReportEndDate = null;
        $startDate = null;
        $endDate = null;
        $data['special_card_total_quantity'] = 0;
        $data['special_card_total_revenue'] = 0;
        $data['general_card_total_quantity'] = 0;
        $data['general_card_total_revenue'] = 0;

        $organization_id = $request->input('organization_id');
        $specialReportStartRaw = trim($request->input('special_report_start_date'));
        $specialReportEndRaw = trim($request->input('special_report_end_date'));

        $startRaw = trim($request->input('start_date'));
        $endRaw = trim($request->input('end_date'));



        if (!empty($specialReportStartRaw)) {
            try {
                $specialReportStartDate = Jalalian::fromFormat('Y-m-d', $specialReportStartRaw)->toCarbon()->format('Y-m-d');
            } catch (\Exception $e) {
                return ['Invalid special report start date format: ' . $specialReportStartRaw];
            }
        }
        if (!empty($specialReportEndRaw)) {
            try {
                $specialReportEndDate = Jalalian::fromFormat('Y-m-d', $specialReportEndRaw)->toCarbon()->format('Y-m-d');
            } catch (\Exception $e) {
                return ['Invalid special report end date format: ' . $specialReportEndRaw];
            }
        }
        if (!empty($startRaw)) {
            try {
                $startDate = Jalalian::fromFormat('Y-m-d', $startRaw)->toCarbon()->format('Y-m-d');
            } catch (\Exception $e) {
                return ['Invalid start date format: ' . $startRaw];
            }
        }
        if (!empty($endRaw)) {
            try {
                $endDate = Jalalian::fromFormat('Y-m-d', $endRaw)->toCarbon()->format('Y-m-d');
            } catch (\Exception $e) {
                return ['Invalid end date format: ' . $endRaw];
            }
        }

        if($organization_id)
        {
            $data['special_card_total_quantity'] = ShekariWeapon::when($organization_id, fn($query) => $query->where('organization_id', $organization_id))
                ->when($specialReportStartDate, fn($query) => $query->whereDate('created_at', '>=', $specialReportStartDate))
                ->when($specialReportEndDate, fn($query) => $query->whereDate('created_at', '<=', $specialReportEndDate))
                ->sum('quantity');

            $data['special_card_total_revenue'] = ShekariWeapon::when($organization_id, fn($query) => $query->where('organization_id', $organization_id))
                ->when($specialReportStartDate, fn($query) => $query->whereDate('created_at', '>=', $specialReportStartDate))
                ->when($specialReportEndDate, fn($query) => $query->whereDate('created_at', '<=', $specialReportEndDate))
                ->sum('revenue');

         } else {
            // dd($startDate,$endDate);
            $data['general_card_total_quantity'] = ShekariWeapon::when($startDate, fn($query) => $query->whereDate('created_at', '>=', $startDate))
                ->when($endDate, fn($query) => $query->whereDate('created_at', '<=', $endDate))
                ->sum('quantity');

            $data['general_card_total_revenue'] = ShekariWeapon::when($startDate, fn($query) => $query->whereDate('created_at', '>=', $startDate))
                ->when($endDate, fn($query) => $query->whereDate('created_at', '<=', $endDate))
                ->sum('revenue');
         }

        //  dd($data);
        return view('shekari-weapon.report', $data);
    }
}
