<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Traits\FilesTrait;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    use FilesTrait;

    protected $model;
    protected $viewsDomain = 'dashboard.slide.';

    public function __construct()
    {
        $this->model = new Slide();
    }

    private function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }

    public function index(Request $request)
    {
        $records = $this->model->query();
        if ($request->filled('title')){
            $records = $records->where(function ($q) use ($request) {
                $q->where('title_ar', 'LIKE', "%{$request->title}%")
                    ->orWhere('title_en', 'LIKE', "%{$request->title}%");
            });
        }
        if ($request->filled('active')){
            $records = $records->where('active', '=', $request->active);
        }
        $records = $records->orderBy('active','desc')->get();
        return $this->view('index', compact('records'));
    }


    public function create()
    {
        return $this->view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'active' => 'boolean',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $request['active'] = $request['active'] ?? 0;
        $data = $request->except('_token', 'icon');
        if ($request->hasFile('icon')){
            $data['icon'] = $this->saveFile($request->icon,"images/slides")['name'];
        }
        $this->model->create($data);
        return redirect(route('slides.index'))->with(['success' => __('added successfully')]);
    }


    public function show($id)
    {
        return redirect()->back();
    }


    public function edit($id)
    {
        $record = $this->model->findOrFail($id);
        return $this->view('edit', compact('record'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'active' => 'boolean',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $request['active'] = $request['active'] ?? 0;
        $data = $request->except('_token', 'icon');
        $record = $this->model->findOrFail($id);
        if ($request->hasFile('icon')){
            $data['icon'] = $this->saveFile($request->icon,"images/slides")['name'];
        }
        $record->update($data);
        return redirect(route('slides.index'))->with(['success' => __('updated successfully')]);

    }

    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        $record->delete();
        return redirect()->back()->with(['success' => __('deleted successfully')]);
    }
}
