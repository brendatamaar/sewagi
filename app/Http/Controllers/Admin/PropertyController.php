<?php

namespace App\Http\Controllers\Admin;

use App\Models\Property;
use App\Models\PropertyAmenity;
use App\Models\PropertyFacility;
use App\Models\PropertyStyle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    public function __construct(Property $property) {
        $this->property = $property;
    }
    public function index()
    {
        return view('admin.property.index');
    }
    public function ajax(Request $request)
    {
        return $this->property->ajaxDatatables($request->all());
    }
    public function view($id)
    {  
        return view('admin.property.form', ['page' => 'view', 'data' => $this->property->find($id)]);
    }
    public function create()
    {
        return view('admin.property.form', ['page' => 'create']);
    }
    public function store(Request $request)
    {
        $this->property->create($request->all());

        return redirect()->route('property.index')->with('success', __('alert.admin.property.created'));
    }

    public function edit($id)
    {
        return view('admin.property.form', ['page' => 'edit', 'data' => $this->property->find($id)]);
    }

    public function update(Request $request, Property $data)
    {
        $this->property->find($data->id)->update($request->all());

        return redirect()->route('property.index')->with('success', __('alert.admin.property.updated'));
    }

    public function destroy($id)
    {
        return $this->property->destroy($id);
    }
}
