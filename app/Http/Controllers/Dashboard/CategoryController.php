<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\FilesTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use FilesTrait;

    protected $model;
    protected $viewsDomain = 'dashboard.category.';

    public function __construct()
    {
        $this->model = new Category();
    }

    private function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }

    public function index(Request $request)
    {
        $categories =  $this->model->active()->main()->get();
        $records = $this->model->query();
        if ($request->filled('name')){
            $records = $records->where(function ($q) use ($request){
                $q->where('name_ar', 'LIKE', "%{$request->name}%")
                ->orWhere('name_ar', 'LIKE', "%{$request->name}%");
            });
        }
        if ($request->filled('active')){
            $records = $records->where('active', '=', $request->active);
        }
        if ($request->filled('category')){
            $records = $records->where('parent_id', '=', $request->category);
        }
        $records = $records->orderBy('active','desc')->get();
        return $this->view('index', compact('records', 'categories'));
    }


    public function create()
    {
        $categories =  $this->model->active()->main()->get();
        return $this->view('create', compact('categories'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'active' => 'boolean',
            'parent_id' => 'nullable|numeric|min:0',
            'image' => 'required_if:parent_id,==,0,|image|mimes:jpeg,png,jpg,gif,svg',
        ];
        if (isset($request->parent_id) && is_numeric($request->parent_id) && $request->parent_id > 0){
            $rules['percent'] = 'required_if:parent_id,==,'.$request->parent_id;
            $rules['parent_id'] = 'required|exists:categories,id';
        }
        $request->validate($rules);

        $request['active'] = $request['active'] ?? 0;
        $data = $request->except('_token', 'image');
        if ($request->hasFile('image')){
            $data['image'] = $this->saveFile($request->image,"images/categories")['name'];
        }
        $this->model->create($data);
        return redirect(route('categories.index'))->with(['success' => __('added successfully')]);
    }


    public function show($id)
    {
        return redirect()->back();
    }


    public function edit($id)
    {
        $categories =  $this->model->active()->main()->get();
        $record = $this->model->findOrFail($id);
        return $this->view('edit', compact('record', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $rules = [
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'active' => 'boolean',
            'parent_id' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
        if (isset($request->parent_id) && is_numeric($request->parent_id) && $request->parent_id > 0){
            $rules['percent'] = 'required_if:parent_id,==,'.$request->parent_id;
            $rules['parent_id'] = 'required|exists:categories,id';
        }
        $request->validate($rules);
        $request['active'] = $request['active'] ?? 0;
        $data = $request->except('_token', 'image');
        $record = $this->model->findOrFail($id);
        if ($request->hasFile('image')){
            $data['image'] = $this->saveFile($request->image,"images/categories")['name'];
        }
        $record->update($data);
        return redirect(route('categories.index'))->with(['success' => __('updated successfully')]);

    }

    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        $record->delete();
        return redirect()->back()->with(['success' => __('deleted successfully')]);
    }

    public function subCategories(Request $request){
        if ($request->filled('category_id')){
            $categories = $this->model->Active();
            $categories = $categories->where('parent_id', $request->category_id);
            $categories = $categories->get();
            return response()->json($categories);
        }
        return response()->json([]);
    }
}
