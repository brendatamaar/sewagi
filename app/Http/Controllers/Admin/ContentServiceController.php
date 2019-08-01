<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContentService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContentServiceController extends Controller
{
    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function index()
    {
        return view('admin.content_service.index');
    }

    public function ajax()
    {
        return $this->contentService->ajaxDatatables();
    }

    public function create()
    {
        return view('admin.content_service.form', ['page' => 'create']);
    }

    public function store(Request $request)
    {
        $this->contentService->create($request->all());

        return redirect()->route('content-service.index')->with('success', __('alert.admin.content_service.created'));
    }

    public function edit($id)
    {
        return view('admin.content_service.form', ['page' => 'edit', 'data' => $this->contentService->find($id)]);
    }

    public function update(Request $request, ContentService $data)
    {
        $this->contentService->find($data->id)->update($request->all());

        return redirect()->route('content-service.index')->with('success', __('alert.admin.content_service.updated'));
    }

    public function destroy($id)
    {
        $this->contentService->destroy($id);
        return response()->json([
            'message' => __('alert.admin.content_service.deleted'),
        ]);
    }
}
