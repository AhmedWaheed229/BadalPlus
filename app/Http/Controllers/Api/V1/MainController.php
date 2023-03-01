<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\SettingResource;
use App\Http\Resources\V1\SlidesResource;
use App\Http\Resources\V1\WelcomeResource;
use App\Http\Resources\V1\WhyUsResource;
use App\Models\Setting;
use App\Models\Slide;
use App\Models\Welcome;
use App\Models\WhyUs;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function settings(){
        $settings = Setting::first();

        if ($settings)
            return SettingResource::make($settings)->additional(["status" => true]);
        else
            return response()->json(["status" => false, "message" => __('no data found')]);
    }

    public function welcome(){
        $welcome_title = Welcome::active()->title()->first();
        $welcome_list = Welcome::active()->list()->get();

        if ($welcome_title && count($welcome_list) > 0)
            return WelcomeResource::make($welcome_title)->additional(['list' => WelcomeResource::collection($welcome_list), "status" => true,]);
        else
            return response()->json(["status" => false, "message" => __('no data found')]);
    }

    public function slides(){
        $slides = Slide::with('lists')->active()->get();
        if (count($slides) > 0)
            return SlidesResource::collection($slides)->additional(["status" => true]);
        else
            return response()->json(["status" => false, "message" => __('no data found')]);
    }

    public function whyUs(){
        $why_us = WhyUs::active()->get();
        if (count($why_us) > 0)
            return WhyUsResource::collection($why_us)->additional(["status" => true]);
        else
            return response()->json(["status" => false, "message" => __('no data found')]);
    }
}
