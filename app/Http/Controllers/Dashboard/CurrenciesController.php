<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrenciesController extends Controller
{
    protected $model;
    protected $viewsDomain = 'dashboard.currency.';

    public function __construct()
    {
        $this->model = new Currency();
    }

    private function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }

    public function index(Request $request)
    {
        $records = $this->model->query();
        if ($request->filled('name')){
            $records = $records->where(function ($q) use ($request){
                $q->where('name_ar', 'LIKE', "%{$request->name}%")
                    ->orWhere('name_en', 'LIKE', "%{$request->name}%");
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
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'active' => 'boolean',
            'rate' => 'required|numeric|gt:0',
        ]);
        $request['active'] = $request['active'] ?? 0;
        $data = $request->except('_token');
        $this->model->create($data);
        return redirect(route('currencies.index'))->with(['success' => __('added successfully')]);
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $record = $this->model->findOrFail($id);
        return $this->view('edit', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'active' => 'boolean',
            'rate' => 'required|numeric|gt:0',
        ]);
        $request['active'] = $request['active'] ?? 0;
        $data = $request->except('_token');
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return redirect(route('currencies.index'))->with(['success' => __('updated successfully')]);

    }

    public function destroy($id)
    {
        return back();
    }
}
