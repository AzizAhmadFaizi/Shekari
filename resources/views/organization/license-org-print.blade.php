<!DOCTYPE html>
<html lang="en">

<head>
    @php $margin_right = 0; @endphp
    @switch($license->license_type_id)
        @case(1)
            @php  $margin_right = 454;  @endphp
        @break

        @case(2)
            @php $margin_right = 585 @endphp
        @break

        @case(3)
            @php $margin_right = 715 @endphp
        @break

        @default
    @endswitch

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>چاپ جواز</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('moi.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/plugins/extensions/ext-component-sweet-alerts.css') }}">
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script>
        function myfunc() {
            Swal.fire({
                title: 'آیا کارت درست چاپ شد ',
                text: "",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'نخیر',
                confirmButtonText: 'بلی'
            }).then((result) => {
                if (result.value == true) {
                    window.location.href = "{{ route('license-printed', $license->id) }}";
                }
            });
        }
    </script>
    <style>
        @media print {
            @page {
                size: A4 landscape !important;
                margin: 0px !important;
                padding: 0px !important;
            }
        }

        body {
            margin: 0px !important;
            /* padding: 0px !important; */
            direction: rtl !important;
            /* width: 297mm !important;
            height: 210mm !important; */
        }

        .FrontCover {
            width: 297mm !important;
            height: 209.8mm !important;
            background: url("{{ asset('card/license_companyv3.jpg') }}") no-repeat;
            background-size: cover;
        }

        /* .backCover {
            width: 297mm !important;
            height: 210mm !important;
            background: url("{{ asset('card/license_back.png') }}") no-repeat;
            background-size: cover;
            transform: rotate(180deg);
        } */

        .president_image {
            position: absolute;
            margin-top: 289px;
            margin-right: 54px;
        }

        .vice_president_image {
            position: absolute;
            margin-top: 289px;
            margin-right: 914px;
        }

        .card_status {
            position: absolute;
            margin-right: {{ $margin_right }}px;
            margin-top: 289px;
        }

        .img {
            width: 153px;
            height: 193px;
        }

        .president_name_dr {
            position: absolute;
            width: 200px;
            height: 22px;
            margin-top: 493px;
            margin-right: 44px;
            overflow: hidden;
        }

        .president_name_en {
            position: absolute;
            width: 183px;
            height: 22px;
            margin-top: 450px;
            margin-right: 32px;
            overflow: hidden;
        }

        .vice_president_name_dr {
            position: absolute;
            width: 200px;
            height: 22px;
            margin-top: 493px;
            margin-right: 905px;
            overflow: hidden;
        }

        .vice_president_name_en {
            position: absolute;
            width: 183px;
            height: 22px;
            margin-top: 450px;
            margin-right: 830px;
            overflow: hidden;
        }

        .org_name_dr {
            position: absolute;
            width: 153px;
            height: 28px;
            margin-top: 349px;
            margin-right: 440px;
            /* overflow: hidden; */
            white-space: nowrap;
        }

        .org_name_ps {
            position: absolute;
            width: 219px;
            height: 28px;
            margin-top: 500px;
            margin-right: 280px;
            overflow: hidden;
        }

        .serial_number {
            position: absolute;
            margin-top: 197px;
            margin-right: 132px;
        }

        .dates {
            position: absolute;
            margin-right: 930px;
            margin-top: 186px;
        }

        .duration_en {
            position: absolute;
            width: 175px;
            height: 20px;
            margin-top: 592px;
            margin-right: 558px;
            overflow: hidden;
        }

        .duration_dr {
            position: absolute;
            width: 96px;
            height: 25px;
            margin-top: 589px;
            margin-right: 274px;
            overflow: hidden;
        }

        .logo {
            position: absolute;
            margin-top: 605px;
            margin-right: 59px;
        }

        .qrcode {
            position: absolute;
            margin-top: 614px;
            margin-right: 59.3rem;
        }
    </style>
</head>

<body onafterprint="myfunc()">
    @if ($president)
    <div class="FrontCover">
        <div class="serial_number">
            @php $id='WC-' . \Morilog\Jalali\CalendarUtils::strftime('Y', strtotime(date('Y'))) . '-' . str_pad($license->type_id, 5, '0', STR_PAD_LEFT) @endphp
            <h3>{{ $id }}</h3>
        </div>
        <div class="dates">
            <h3 style="margin-bottom: -19px;">{{ to_jalai($license->issue_date) }}</h3>
            <h3>{{ to_jalai($license->expire_date) }}</h3>
        </div>
        <div class="president_image">
            <img class="img" src="{{ URL::asset('storage/president_images/' . $president->image) }}" alt="">
        </div>
        <div class="card_status">
            <img src="{{ asset('card/tick.png') }}" style="width: 20px;" alt="">
        </div>
        @if (!empty($vice_president))
            <div class="vice_president_image">
                <img class="img" src="{{ URL::asset('storage/vice_president_images/' . $vice_president->image) }}" alt="">
            </div>
        @endif
        <div class="president_name_dr">
            <h4 style="margin-top:2px;text-align:center;">{{ $president->name_dr . ' ' . $president->last_name_dr }}</h4>
        </div>
        <div class="vice_president_name_dr">
            <h4 style="margin-top:2px;text-align:center;">{{ !empty($vice_president) ? $vice_president->name_dr . ' ' . $vice_president->last_name_dr : 'ندارد' }}</h4>
        </div>
        <div class="org_name_dr">
            <h2 style="margin-top:2px;text-align:center;">{{ $organization->name_dr }}</h2>
        </div>
        <div class="org_name_ps">
            <h2 style="margin-top:2px;text-align:center;">{{ $organization->name_dr }}</h2>
        </div>
        <div class="logo">
            <img src="{{ URL::asset('storage/organization_logos/' . $organization->logo) }}" style="height: 127px; width: 126px;" alt="">
        </div>
        <div class="qrcode">
            {!! QrCode::size(115)->generate($id) !!}
        </div>
    </div>
        <div class="backCover">
        </div>
    @else
        <h1 style="color:red;text-align:center;margin-top:20%">رییس این کمپنی لغو شده است</h3>
    @endif
</body>

</html>
