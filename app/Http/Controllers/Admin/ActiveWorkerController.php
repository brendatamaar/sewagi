<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateActiveWorkerRequest;
use App\Models\ActiveWorker;
use Yajra\DataTables\DataTables;

class ActiveWorkerController extends Controller
{
    public function __construct(ActiveWorker $activeWorker)
    {
        $this->activeWorker = $activeWorker;
    }

    public function index()
    {
        return view('admin.active_worker.index');
    }

    public function ajax()
    {
        return $this->activeWorker->ajaxDatatables();
    }

    public function create()
    {
        return view('admin.active_worker.form', ['page' => 'create']);
    }

    public function store(CreateActiveWorkerRequest $request)
    {
        $this->activeWorker->create($request->all());

        return redirect()->route('active-worker.index')->with('success', __('alert.admin.active_worker.created'));
    }

    public function edit($id)
    {
        return view('admin.active_worker.form', ['page' => 'edit', 'data' => $this->activeWorker->find($id)]);
    }

    public function update(Request $request, ActiveWorker $data)
    {
        $this->activeWorker->find($data->id)->update($request->all());

        return redirect()->route('active-worker.index')->with('success', __('alert.admin.active_worker.updated'));
    }

    public function destroy($id)
    {
        $this->activeWorker->destroy($id);
        return response()->json([
            'message' => __('alert.admin.active_worker.deleted')
        ]);
    }
}
