<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Slide;
use App\Models\Welcome;
use App\Models\WhyUs;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $welcome_title = Welcome::active()->title()->first();
        $welcome_list = Welcome::active()->list()->get();
        $slides = Slide::with('lists')->active()->get();
        $why_us = WhyUs::Active()->get();
        return view('welcome', compact('welcome_title','welcome_list','slides','why_us'));
    }

    public function browse(Request $request){

        $posts = Post::query();

        if($request->filled('category')){
            $posts = $posts->whereHas('category', function($q) use ($request){
                return $q->where('parent_id', $request->category);
            });
        }
        if($request->filled('sub_category')){
            $posts = $posts->where('category_id', $request->sub_category);
        }

        if($request->filled('currency')){
            $posts = $posts->where('currency_id', $request->currency);
        }

        if($request->filled('title')){
            $posts = $posts->where('title', 'like', '%' . $request->title . '%');
        }

        $posts = $posts->where('active', 1)->where('status', 1)
        ->with('user', 'currency', 'category')->latest()->paginate(15);
        $categories_parent = Category::where('parent_id','0')->get();
        $post_count = Post::where('active', 1)->where('status', 1)->count();

        return view('browse', compact('posts', 'post_count'))->with('categories_parent',$categories_parent);
    }

    public function getSubCategoris(Request $request)
    {
        $categories = Category::where('parent_id', $request->id)->where('active', 1)->get();

        return response()->json($categories);
    }
}
