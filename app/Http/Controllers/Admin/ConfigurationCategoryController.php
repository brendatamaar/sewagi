<?php

namespace App\Http\Controllers\Admin;

use App\Models\ConfigurationCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigurationCategoryController extends Controller
{
    public function __construct(ConfigurationCategory $configurationCategory) {
        $this->configurationCategory = $configurationCategory;
    }
    public function index()
    {
        return view('admin.configurations.categories.index');
    }
    public function ajax()
    {
        return $this->configurationCategory->ajaxDatatables();
    }
    public function create()
    {
        return view('admin.configurations.categories.form', ['page' => 'create']);
    }
    public function store(Request $request)
    {
        $this->configurationCategory->create($request->all());

        return redirect()->route('configuration-category.index')->with('success', __('alert.admin.config_category.created'));
    }

    public function edit($id)
    {
        return view('admin.configurations.categories.form', ['page' => 'edit', 'data' => $this->configurationCategory->find($id)]);
    }

    public function update(Request $request, ConfigurationCategory $data)
    {
        $this->configurationCategory->find($data->id)->update($request->all());

        return redirect()->route('configuration-category.index')->with('success', __('alert.admin.config_category.updated'));
    }

    public function destroy($id)
    {
        return $this->configurationCategory->destroy($id);
    }
}
