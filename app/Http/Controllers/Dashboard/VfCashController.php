<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\VfCash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VfCashController extends Controller
{

    protected $model;
    protected $viewsDomain = 'dashboard.cash.';

    public function __construct()
    {
        $this->model = new VfCash();
    }

    private function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }

    public function index()
    {
        $records = $this->model->all();
        return $this->view('index', compact('records'));
    }

    public function create()
    {
        return $this->view('create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|regex:/^01[0-2,5]\d{8}$/|unique:vf_numbers,number',
            'show' => 'boolean'
        ]);
        $data = $request->except('_token');
        $this->model->create($data);
        return redirect(route('cash.index'))->with(['success' => __('added successfully')]);
    }
    public function show($id)
    {
        dd($id);
    }
    public function edit($id)
    {
        $record = $this->model->findOrFail($id);
        return $this->view('edit', compact('record'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'number' => ['required', 'regex:/^01[0-2,5]\d{8}$/', Rule::unique('vf_numbers', 'number')->ignore($id)],
            'show' => 'boolean'
        ]);
        $data = $request->except('_token');
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return redirect(route('cash.index'))->with(['success' => __('updated successfully')]);
    }
    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        $record->delete();
        return redirect()->back()->with(['success' => __('deleted successfully')]);
    }
}
