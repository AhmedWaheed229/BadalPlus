<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::MainActive()->with('subCategories')->get();
        if (count($categories) > 0)
            return CategoryResource::collection($categories)->additional(["status" => true]);
        else
            return response()->json(["status" => false, "message" => __('no data found')]);
    }
}
