<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkingField;
use Yajra\DataTables\DataTables;

class WorkingFieldController extends Controller
{
    public function __construct(WorkingField $workingField)
    {
        $this->workingField = $workingField;
    }

    public function index()
    {
        return view('admin.working_field.index');
    }

    public function ajax()
    {
       return $this->workingField->ajaxDatatables();
    }

    public function create()
    {
        return view('admin.working_field.form', ['page' => 'create']);
    }

    public function store(Request $request)
    {
        $this->workingField->create($request->all());

        return redirect()->route('working-field.index')->with('success', __('Success add working field'));
    }

    public function edit($id)
    {
        return view('admin.working_field.form', ['page' => 'edit', 'data' => $this->workingField->find($id)]);
    }

    public function update(Request $request, WorkingField $data)
    {
        $this->workingField->find($data->id)->update($request->all());

        return redirect()->route('working-field.index')->with('success', __('Success Update Data'));
    }

    public function destroy($id)
    {
        $this->workingField->destroy($id);
        return response()->json([
            'message' => __('alert.admin.working_field.deleted')
        ]);
    }
}
