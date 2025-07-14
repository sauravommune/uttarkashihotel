<?php

namespace App\Http\Controllers;

use App\DataTables\StatusDataTable;
use App\Http\Requests\StatusRequest;
use App\Models\Status;
use App\Repositories\StatusRepository;
use Exception;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    private StatusRepository $statusRepository;

    public function __construct(StatusRepository $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\DataTables\StatusDataTable $datatable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, StatusDataTable $datatable)
    {
        $data['title'] = 'Status Management';
        addVendors(['datatable', 'jquery-validate']);
        return $datatable->render('settings.status.index', $data);
    }

    /**
     * Show the form for creating a new resource or editing an existing one.
     *
     * @param int|null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($id = null)
    {
        addVendors(['jquery-validate', 'dropify']);

        if ($id) {
            $status = Status::findOrFail($id);
            $data['title'] = 'Edit Status';
        } else {
            $status = new Status();
            $data['title'] = 'Create Status';
        }

        $data['status'] = $status;

        return view('status.create', $data);
    }

    /**
     * Store or update a status.
     *
     * @param \App\Http\Requests\StatusRequest $request
     * @param int|null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(StatusRequest $request, $id = null)
    {
        try {
            $this->statusRepository->saveStatus($request, $id);
            return response()->json(['status' => 200, 'message' => 'Status Saved Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the details of a status.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewDetails($id)
    {
        $details = $this->statusRepository->getDetails($id);
        return view('status.details', compact('details'));
    }

    /**
     * Remove a status.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->statusRepository->removeStatus($id);
            return response()->json(['status' => 200, 'message' => 'Status Removed Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Handle additional methods as required, like adding an image form.
     */
    public function addImageForm()
    {
        $html = view('status.add_image_form')->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }
}
