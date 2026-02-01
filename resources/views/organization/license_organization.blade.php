<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GRN</title>
    <link href="{{asset('app-assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css" />
    <style>
        @media  print {
            .hidden-print {
                display: none !important;
            }

            .container{
                max-width: unset;
                padding: unset;
                margin: unset;
            }

            @page {
                size: A4 landscape !important;
                margin: 0px !important;
                padding: 0px !important;
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
            <div class="col-12">
                <img src="{{ asset('card/license_shop.png') }}" style="width: 99.85%;">
                {{-- <div class="president_name_dr"> --}}
                    <p>{{ $president->name_dr . ' ' . $president->last_name_dr }}</p>
                {{-- </div> --}}
            </div>
        </div>
    </div>
</body>
</html>
