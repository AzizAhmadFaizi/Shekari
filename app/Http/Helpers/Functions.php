<?php

use Illuminate\Support\Str;

function encode_organization_id($id)
{
    return base64_encode(Str::random(30) . '-' . base64_encode($id));
}

function decode_organization_id($id)
{
    $x = base64_decode($id);
    $x = explode('-', $x)[1];
    $x = base64_decode($x);
    return $x;
}

function to_gregorian($date)
{
    return \Morilog\Jalali\Jalalian::fromFormat('Y-m-d', $date)->toCarbon();
}

function to_jalai($date)
{
    return \Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime($date));
}

function get_user_id()
{
    return auth()->user()->id;
}
