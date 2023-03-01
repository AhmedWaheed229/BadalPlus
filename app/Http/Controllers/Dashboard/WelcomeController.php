<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Welcome;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    protected $model;
    protected $viewsDomain = 'dashboard.welcome.';

    public function __construct()
    {
        $this->model = new Welcome();
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
        if ($request->filled('type')){
            $records = $records->where('type', '=', $request->type);
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
            'content_ar' => 'required|string',
            'content_en' => 'required|string',
            'type' => 'required|string|in:title,list',
            'active' => 'boolean',
        ]);
        $request['active'] = $request['active'] ?? 0;
        $data = $request->except('_token');
        $this->model->create($data);
        return redirect(route('welcomes.index'))->with(['success' => __('added successfully')]);
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
            'content_ar' => 'required|string',
            'content_en' => 'required|string',
            'type' => 'required|string|in:title,list',
            'active' => 'boolean',
        ]);
        $request['active'] = $request['active'] ?? 0;
        $data = $request->except('_token');
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return redirect(route('welcomes.index'))->with(['success' => __('updated successfully')]);

    }

    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        $record->delete();
        return redirect()->back()->with(['success' => __('deleted successfully')]);
    }
}
