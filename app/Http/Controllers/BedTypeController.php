<?php

namespace App\Http\Controllers;

use App\DataTables\BedTypeDataTable;
use App\Repositories\BedTypeRepository;
use Exception;
use Illuminate\Http\Request;

class BedTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(private BedTypeRepository $bedTypeRepository) {}

    public function index(BedTypeDataTable $dataTable)
    {
        addVendors(['datatable', 'jquery-validate']);
        return $dataTable->render('bedType.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = request('id') ? 'Edit' : 'Add';
        $bedType = $this->bedTypeRepository->getBedType();
        $html =  view('bedType.add', compact('data', 'bedType'))->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $save = $this->bedTypeRepository->saveBedType($request);
            if ($save) {
                return response()->json(['status' => 200, 'message' => 'Saved Successfully'], 200);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $save = $this->bedTypeRepository->removeBedType();
            if ($save) {
                return response()->json(['status' => 200, 'message' => 'Removed Successfully', 'redirect' => route('bedType')], 200);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }
}
