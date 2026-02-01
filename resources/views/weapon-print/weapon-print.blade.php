<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <title>چاپ کارت</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('moi.png') }}">
    <script src="{{ asset('app-assets/vendors/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('html2canvas/html2canvas.min.js') }}"></script>
    <style>
        body {
            background-color: #5f6368;
            width: 2.11in !important;
            min-width: 2.11in !important;
            margin: 0 auto !important;
            padding: 0 !important;
            height: 3.367in !important;
            font-family: Calibri !important;
            font-weight: bold !important;
            font-size: 13px;
        }

        .front {
            min-width: 1024px !important;
            min-height: 648px !important;
            direction: rtl !important;
            -moz-direction: rtl !important;
            background: url("{{ asset('card/weapon_dr.png') }}") no-repeat;
            background-size: cover;
        }

        .back {
            background: url("{{ asset('card/weapon_en.png') }}") no-repeat;
            min-width: 1024px !important;
            min-height: 648px !important;
            direction: ltr !important;
            background-size: cover;
        }

        .qrcode {
            position: absolute;
            margin-top: 400px;
            margin-right: 811px;
        }

        .qrcode_1 {
            position: absolute;
            margin-top: 400px;
            margin-left: 816px;
        }

        .logo {
            position: absolute;
            margin-top: 196px;
            margin-right: 809px;
        }

        .logo_1 {
            position: absolute;
            margin-top: 196px;
            margin-left: 812px;
        }

        .dari_details {
            position: absolute;
            margin-right: 166px;
            margin-top: 185px;
        }

        .dari_details>p {
            font-size: 20px;
        }

        .english_details>p {
            font-size: 20px;
        }

        .new_card_dr {
            position: absolute;
            margin-left: 550px;
            margin-top: 154px;
        }

        .update_card_dr {
            position: absolute;
            margin-left: 406px;
            margin-top: 154px;
        }

        .new_card_en {
            position: absolute;
            margin-left: 452px;
            margin-top: 154px;
        }

        .update_card_en {
            position: absolute;
            margin-left: 619px;
            margin-top: 154px;
        }

        .card_limit_dr {
            position: absolute;
            margin-right: 424px;
            margin-top: 531px;
        }
        .card_limit_en {
            position: absolute;
            margin-left: 335px;
            margin-top: 531px;
        }

        .english_details {
            position: absolute;
            margin-left: 254px;
            margin-top: 185px;
        }
    </style>
    <script>
        $(document).on('click', '.front', function() {
            var data_index = $(this).attr('data-index');
            const screenshotTarget = document.getElementById("front-" + data_index);
            html2canvas(screenshotTarget, {
                width: 1024,
                height: 648,
            }).then((canvas) => {
                const base64image = canvas.toDataURL("image/bmp");
                var anchor = document.createElement('a');
                anchor.setAttribute("href", base64image);
                anchor.setAttribute("download", "front.bmp");
                anchor.click();
                anchor.remove();
            });
        });
        $(document).on('click', '.back', function() {
            var data_index = $(this).attr('data-index');
            const screenshotTarget = document.getElementById("back-" + data_index);
            html2canvas(screenshotTarget, {
                width: 1024,
                height: 648,
            }).then((canvas) => {
                const base64image = canvas.toDataURL("image/bmp");
                var anchor = document.createElement('a');
                anchor.setAttribute("href", base64image);
                anchor.setAttribute("download", "back.bmp");
                anchor.click();
                anchor.remove();
                myfunc();
            });
        });
    </script>
</head>

<body>
    @foreach ($weapons as $item)
        @php $id='SCWC-' . \Morilog\Jalali\CalendarUtils::strftime('Y', strtotime(date('Y'))) . '-' . str_pad($item->id, 7, '0', STR_PAD_LEFT) @endphp
        <div class="{{ $item->card_type == 1 ? 'new_card_dr' : 'update_card_dr' }}">
            <img src="{{ asset('card/tick.png') }}" style="width: 20px;" alt="">
        </div>
        <div class="front" data-index="{{ $loop->iteration }}" id="front-{{ $loop->iteration }}" style="cursor: pointer;">
            <div class="dari_details">
                <p>{{ $id }}</p>
                <p style="padding-top:5px;">{{ $item->organization_details->name_dr }}</p>
                <p style="padding-top:5px;">{{ $item->project_name_dr }}</p>
                <p style="padding-top:5px;">{{ $item->weapon_table_details->weapon_no }}</p>
                <p style="padding-top:2px;">{{ $item->weapon_table_details->weapon_type_details->name_dr }}</p>
                <p style="padding-top:7px;">{{ to_jalai($item->issue_date) }}</p>
                <p style="padding-top:6px;">{{ to_jalai($item->valid_date) }}</p>
            </div>
            <div class="qrcode">
                {!! QrCode::size(177)->generate($id) !!}
            </div>
            <div class="logo">
                <img src="{{ URL::asset('storage/organization_logos/' . $item->organization_details->logo) }}" style="height: 184px; width:184px;" alt="">
            </div>
            <div class="card_limit_dr">
                <h2>{{ $item->card_limit_dr }}</h2>
            </div>
        </div>
        <div class="back" data-index="{{ $loop->iteration }}" id="back-{{ $loop->iteration }}" style="cursor: pointer;">
            <div class="{{ $item->card_type == 1 ? 'new_card_en' : 'update_card_en' }}">
                <img src="{{ asset('card/tick.png') }}" style="width: 20px;" alt="">
            </div>
            <div class="english_details">
                <p>{{ $id }}</p>
                <p style="padding-top:5px;">{{ $item->organization_details->name_en }}</p>
                <p style="padding-top:5px;">{{ $item->project_name_en }}</p>
                <p style="padding-top:2px;">{{ $item->weapon_table_details->weapon_type_details->name_en }}</p>
                <p style="padding-top:5px;">{{ $item->weapon_table_details->weapon_no }}</p>
                <p style="padding-top:7px;">{{ $item->issue_date }}</p>
                <p style="padding-top:6px;">{{ $item->valid_date }}</p>
            </div>
            <div class="qrcode_1">
                {!! QrCode::size(177)->generate($id) !!}
            </div>
            <div class="logo_1">
                <img src="{{ URL::asset('storage/organization_logos/' . $item->organization_details->logo) }}" style="height: 184px; width:184px;" alt="">
            </div>
            <div class="card_limit_en">
                <h2>{{ $item->card_limit_en }}</h2>
            </div>
        </div>
    @endforeach
</body>

</html>
