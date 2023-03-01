<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Models\SlideList;
use Illuminate\Http\Request;

class SlideListController extends Controller
{
    protected $model;
    protected $viewsDomain = 'dashboard.slide_list.';

    public function __construct()
    {
        $this->model = new SlideList();
    }

    private function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }

    public function index(Request $request)
    {
        $records = $this->model->query();
        if ($request->filled('content')){
            $records = $records->where(function ($q) use ($request){
               $q->where('content_ar', 'LIKE', "%{$request['content']}%")
                   ->orWhere('content_en', 'LIKE', "%{$request['content']}%");
            });
        }
        if ($request->filled('active')){
            $records = $records->where('active', '=', $request->active);
        }
        if ($request->filled('slide')){
            $records = $records->where('slide_id', '=', $request->slide);
        }
        $records = $records->orderBy('active','desc')->get();
        $slides = Slide::active()->get();
        return $this->view('index', compact('records', 'slides'));
    }


    public function create()
    {
        $slides = Slide::active()->get();
        return $this->view('create', compact('slides'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content_ar' => 'required|string',
            'content_en' => 'required|string',
            'active' => 'boolean',
            'slide_id' => 'required|numeric|exists:slides,id',
        ]);
        $request['active'] = $request['active'] ?? 0;
        $data = $request->except('_token');
        $this->model->create($data);
        return redirect(route('slide_lists.index'))->with(['success' => __('added successfully')]);
    }


    public function show($id)
    {
        return redirect()->back();
    }


    public function edit($id)
    {
        $slides = Slide::active()->get();
        $record = $this->model->findOrFail($id);
        return $this->view('edit', compact('record', 'slides'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'content_ar' => 'required|string',
            'content_en' => 'required|string',
            'active' => 'boolean',
            'slide_id' => 'required|numeric|exists:slides,id',
        ]);
        $request['active'] = $request['active'] ?? 0;
        $data = $request->except('_token');
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return redirect(route('slide_lists.index'))->with(['success' => __('updated successfully')]);

    }

    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        $record->delete();
        return redirect()->back()->with(['success' => __('deleted successfully')]);
    }
}
