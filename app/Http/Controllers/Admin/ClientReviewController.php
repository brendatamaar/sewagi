<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateClientReviewRequest;
use App\Models\ClientReview;
use Yajra\DataTables\DataTables;

class ClientReviewController extends Controller
{
    public function __construct(ClientReview $clientReview) {
        $this->clientReview = $clientReview;
    }
    public function index()
    {
        return view('admin.client_reviews.index');
    }
    public function ajax()
    {
        return $this->clientReview->ajaxDatatables();
    }
    public function create()
    {
        return view('admin.client_reviews.form', ['page' => 'create']);
    }
    public function store(Request $request)
    {
        $this->clientReview->createNew($request->all());

        return redirect()->route('client-review.index')->with('success', __('alert.admin.client_review.created'));
    }
    public function edit($id)
    {
        return view('admin.client_reviews.form', ['page' => 'edit', 'data' => $this->clientReview->find($id)]);
    }
    public function update(Request $request, ClientReview $data)
    {
        $this->clientReview->find($data->id)->update($request->all());

        return redirect()->route('client-review.index')->with('success', __('alert.admin.active_worker.updated'));
    }
    public function destroy($id)
    {
        return $this->clientReview->destroy($id);
    }
}
