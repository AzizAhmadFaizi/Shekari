<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GRN</title>
    <link href="{{asset('bootstrap-left/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        th {
            border: 1px solid black !important;
            font-weight: normal;
        }
        tr td{
            border: 1px solid black !important;
        }
        .title th {
            font-weight: bold;
        }

        @media  print {
            .hidden-print {
                display: none !important;
            }

            @page { 
                size: landscape !important;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row my-3 hidden-print">
            <div class="col-6">
                <td><a href="{{url()->previous()}}" class="btn btn-info form-control"><i class="fa fa-arrow-left"></i>Back</a> </td>
            </div>
            <div class="col-6">
                <td><button onclick="window.print();" class="btn btn-primary form-control"><i class="dripicons-print"></i>Print</button></td>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <img src="{{asset('imgs/UNHCR.png')}}" style="width: 40%;">
            </div>
            <div class="col-6 text-right">
                @php $logo = \App\Models\Configuration::where('type', 1)->first(); @endphp
                <img src="{{asset($logo->logo)}}" style="width: 25%;">
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h3>Goods Received Notes (GRN)</h3>
            </div>
            <div class="col-6">
                @php
                    $p_name = \App\Models\Branch::where('Branch_ID', $grn->warehouse_id)->first();
                @endphp
                <table style="border:1px solid black; margin-left:auto;">
                    <tr style="background-color: #c3c3c3; text-align: end;">
                        <td style="width: 180px;">NO:     @isset($p_name){{$p_name->Branch_Name}}@endisset {{$grn->specific_id}} </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <small>To be completed by the Warehouse Manager</small>
            </div>
            <div class="col-4">
                <small>Unit: Smallest Quantity managed</small>
            </div>
            <div class="col-4">
                <small>If Different from Quantity Received</small>
            </div>
        </div>
        <div class="row my-2">
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th>Warehouse / Store: {{$grn->Warehouse_Name}} - {{$grn->Warehouse_Code}}</th>
                        <th>Date: {{$grn->date}}</th>
                        <th>Sender: {{$grn->good_coming_from}}</th>
                    </tr>
                    <tr>
                        <th>Supplier Delivery Document No: {{$grn->supplier_doc_num}}</th>
                        <th>Transporter Vehicle Plate No: {{$grn->vehivle_plate_num}}</th>
                        <th>Transporter Waybill No: {{$grn->tran_waybill_num}}</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="row my-3">
            <table style="width: 100%;">
                <thead>
                    <tr class="text-center title">
                        <th>No</th>
                        <th>PO No</th>
                        <th>Description</th>
                        <th>Unit</th>
                        <th>Packaging <br><span style="font-weight: normal;">(Unit)</span></th>
                        <th>Qty <br>Expected</th>
                        <th>Qty <br>Received</th>
                        <th>Remarks <br><span style="font-weight: normal;">(Rejections, Shortages, Damages, Anomalies)</span></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                        $count = 10;
                        $count = $count - count($grn_items);
                    @endphp
                    @foreach ($grn_items as $item)
                    @php
                        $i = \App\Models\Item::withTrashed()->leftjoin('unit_of_mesure', 'unit_of_mesure.ID', 'item.Unit_of_Measure_ID')->where('item.ID', $item->item_id)->first();
                    @endphp
                    <tr class="text-center">
                        <td> {{$no++}}</td>
                        <td> {{$item->po_number}}</td>
                        <td> {{$i->Item_Name}}</td>
                        <td> {{$i->unit}}</td>
                        <td> {{$i->Number_of_Pieces_Per_Unite}}</td>
                        <td> {{$item->qty_expected}}</td>
                        <td> {{$item->qty_received}}</td>
                        <td> {{$item->remark}}</td>
                    </tr>
                    @endforeach
                    @for ($i = 0; $i < $count; $i++)
                    <tr class="text-center">
                        <td> {{$no++}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        <div class="row my-2">
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th>Delivered by:<br>
                            Name & Signature<br>
                            {{$grn->delivered_by}}</th>
                        <th>Quality and Quantity checked by :<br>
                            Name & Signature<br>
                            {{$grn->quality_checked_by}}</th>
                        <th>Reception approved by:<br>
                            Name & Signature Stamp<br>
                            {{$grn->approved_by}}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</body>
</html>
