<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Post;
use App\Models\User;
use App\Traits\FilesTrait;
use Illuminate\Http\Request;

class PostController extends Controller
{

    use FilesTrait;

    protected $model;
    protected $viewsDomain = 'dashboard.post.';

    public function __construct()
    {
        $this->model = new Post();
    }

    private function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }

    public function index(Request $request)
    {
        $records = $this->model->query();
        if ($request->filled('title')){
            $records = $records->where('title', 'LIKE', "%{$request->title}%");
        }
        if ($request->filled('user')){
            $records = $records->where('created_by', $request->user);
        }
        if ($request->filled('active')){
            $records = $records->where('active', '=', $request->active);
        }
        $records = $records->orderBy('active','asc')->paginate(10);
        $users = User::all();
        return $this->view('index', compact('records', 'users'));
    }

    public function activate($id){
        $record = $this->model->findOrFail($id);
        $record->active = 1;
        $record->save();
        return back()->with(['success' => __('activated successfully')]);
    }
    public function inActivate($id){
        $record = $this->model->findOrFail($id);
        $record->active = 2;
        $record->save();
        return back()->with(['success' => __('in activated successfully')]);
    }
    public function pending($id){
        $record = $this->model->findOrFail($id);
        $record->active = 0;
        $record->save();
        return back()->with(['success' => __('pending successfully')]);
    }

    public function create()
    {
        return $this->view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            "main_category" => "required|numeric|exists:categories,id",
            "sub_category" => "required|numeric|exists:categories,id",
            "currency_id" => "required|numeric|exists:currencies,id",
            "price" => "required|numeric|gt:0",
            "min_price"=>"required|numeric|gt:0",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $data = $request->except('_token', 'image', 'main_category', 'sub_category');
        if ($request->hasFile('image')){
            $data['image'] = $this->saveFile($request->image,"images/posts")['name'];
        }
        $data['status'] = 1;
        $data['active'] = 0;
        $data['category_id'] = $request->sub_category;
        $data['created_by'] = auth()->id();
        $this->model->create($data);
        return redirect(route('profile', auth()->id()))->with(['success' => __('added successfully') . ' ' . __('we will preview your post')]);
    }

    public function show($id)
    {
        $record = Post::with("user", "currency", "category")
            ->where("status", 1)
            ->where("active", 1)->findOrFail($id);
        return $this->view('show', compact('record'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
