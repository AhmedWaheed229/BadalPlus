<?php
use App\Models\Currency;
use Illuminate\Support\Facades\Route;

function isActiveRoute($route, $output = 'active')
{
    if (Route::currentRouteName() == $route) {
        return $output;
    }
}

function isCurrentRoute($route, $output = 'current')
{
    if (Route::currentRouteName() == $route) {
        return $output;
    }
}


function rate($auth_currancy = 1,$currancy = 1, $price = 0){
    $currancy = Currency::where('active', 1)->find($currancy);
    $auth_currancy = Currency::where('active', 1)->find($auth_currancy);

    if(!$currancy){
        $currancy = Currency::first();
        $auth_currancy = Currency::first();
    }

    $price_convert = $price / $currancy->rate; // تحويل المبلغ للعملة الاساسية
    $auth_convert = number_format($price_convert / $auth_currancy->rate, 2); // تحويل لعملة المستخدم
    return $auth_convert . ' ' . $auth_currancy->name;
}

function rateNum($auth_currancy = 1,$currancy = 1, $price = 0){
    $currancy = Currency::where('active', 1)->find($currancy);
    $auth_currancy = Currency::where('active', 1)->find($auth_currancy);

    if(!$currancy){
        $currancy = Currency::first();
        $auth_currancy = Currency::first();
    }

    $price_convert = $price / $currancy->rate; // تحويل المبلغ للعملة الاساسية
    $auth_convert = number_format($price_convert / $auth_currancy->rate, 2); // تحويل لعملة المستخدم
    return $auth_convert;
}
function rateNumV($auth_currancy = 1, $price = 0, $currency_rate = 1){
    $auth_currancy = Currency::where('active', 1)->find($auth_currancy);

    if(!$auth_currancy){
        $auth_currancy = Currency::first();
    }

    $price_convert = $price / $currency_rate; // تحويل المبلغ للعملة الاساسية
    $auth_convert = number_format($price_convert / $auth_currancy->rate, 2); // تحويل لعملة المستخدم
    return $auth_convert;
}

