<?php

namespace App\Http\Controllers\Admin;

use App\Models\Configuration;
use App\Models\ConfigurationCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigurationController extends Controller
{
    public function __construct(Configuration $configuration) {
        $this->configuration = $configuration;
    }
    public function index()
    {
        return view('admin.configurations.index');
    }
    public function ajax()
    {
        return $this->configuration->ajaxDatatables();
    }
    public function create()
    {
        $categories = ConfigurationCategory::getAll();
        $data = [
            'page' => 'create',
            'categories' => $categories
        ];
        return view('admin.configurations.form', $data);
    }
    public function store(Request $request)
    {
        $this->configuration->createNew($request->all());

        return redirect()->route('configuration.index')->with('success', __('alert.admin.config.created'));
    }

    public function edit($id)
    {
        $categories = ConfigurationCategory::getAll();
        $config = $this->configuration->find($id);
        $data = [
            'page' => 'edit',
            'categories' => $categories,
            'data' => $config
        ];
        return view('admin.configurations.form', $data);
    }

    public function update(Request $request, Configuration $data)
    {
        $this->configuration->find($data->id)->update($request->all());

        return redirect()->route('configuration.index')->with('success', __('alert.admin.config.updated'));
    }

    public function destroy($id)
    {
        return $this->configuration->destroy($id);
    }
}
