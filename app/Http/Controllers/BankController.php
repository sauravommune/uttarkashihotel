<?php

namespace App\Http\Controllers;

use App\DataTables\BanksDataTable;
use App\Repositories\BankRepository;
use Illuminate\Http\Request;
use Exception;

class BankController extends Controller
{
    public function __construct(private BankRepository $BankRepository) {}

    public function index(BanksDataTable $dataTable)
    {
        addVendors(['datatable', 'jquery-validate']);
        return $dataTable->render('banks.index');
    }
    public function create()
    {
        $data['title'] = request('id') ? 'Edit' : 'Add';
        $banks = $this->BankRepository->getBank();
        $html =  view('banks.add', compact('data', 'banks'))->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }


    public function store(Request $request)
    {
        try {
            $save = $this->BankRepository->saveBank($request);
            if ($save) {
                return response()->json(['status' => 200, 'message' => 'Saved Successfully', 'redirect' => route('banks.index')], 200);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $save = $this->BankRepository->removeBank();
            if ($save) {
                return response()->json(['status' => 200, 'message' => 'Removed Successfully', 'redirect' => route('banks.index')], 200);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }
}
