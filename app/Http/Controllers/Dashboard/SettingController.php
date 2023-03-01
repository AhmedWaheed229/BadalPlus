<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\FilesTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use FilesTrait;

    protected $model;
    protected $viewsDomain = 'dashboard.settings.';

    public function __construct()
    {
        $this->model = new Setting();
    }

    private function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }

    public function index(){
        $record = $this->model->firstOrCreate();
        return $this->view('index', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'logo_ar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'logo_en' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'phone' => 'nullable',
            'email' => 'nullable',
            'address_ar' => 'nullable',
            'address_en' => 'nullable',
            'content_ar' => 'nullable',
            'content_en' => 'nullable',
        ]);
        $data = $request->except('_token', 'logo_ar', 'logo_en', 'icon');
        $record = $this->model->findOrFail($id);
        if ($request->hasFile('logo_ar')){
            $data['logo_ar'] = $this->saveFile($request->logo_ar,"images/settings")['name'];
        }
        if ($request->hasFile('logo_en')){
            $data['logo_en'] = $this->saveFile($request->logo_en,"images/settings")['name'];
        }
        if ($request->hasFile('icon')){
            $data['icon'] = $this->saveFile($request->icon,"images/settings")['name'];
        }
        $record->update($data);
        return back()->with(['success' => __('updated successfully')]);
    }
}
