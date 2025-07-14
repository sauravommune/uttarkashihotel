<?php

namespace App\Http\Controllers;

use App\DataTables\TaxCalculatorDataTable;
use App\Models\TaxCalculator;
use Illuminate\Http\Request;

class TaxCalculatorController extends Controller
{

    public function index(TaxCalculatorDataTable $dataTable)
    {
        $title = 'Tax Calculator';
        addVendors(['datatable', 'jquery-validate']);
        return $dataTable->render('tax-calculator.index', compact('title'));
    }

    public function show($id)
    {
        $id = decode($id);
        $taxCalculator = TaxCalculator::findOrFail($id);
        return response()->json(['status' => 200, 'data' => $taxCalculator]);
    }

    public function store(Request $request)
    {
        request()->validate([
            'calc_client_payment'   => 'required|numeric|gt:0',
            'calc_vendor_payment'  => 'required|numeric|gt:0',
        ]);

        $clientPayment = $request->calc_client_payment;
        $vendorPayment = $request->calc_vendor_payment;
        $markup = $clientPayment - $vendorPayment;
        $markupGST = $markup - ($markup * (100 / 118));
        $grossProfit = $markup - $markupGST;
        $incomeTax = $grossProfit - ($grossProfit * (100 / 125));
        $netProfit = $grossProfit - $incomeTax;

        $taxCalculator = TaxCalculator::firstOrNew(['id' => $request->id]);
        $taxCalculator->client_payment = $clientPayment;
        $taxCalculator->vendor_payment = $vendorPayment;
        $taxCalculator->markup = $markup;
        $taxCalculator->markup_gst = $markupGST;
        $taxCalculator->gross_profit = $grossProfit;
        $taxCalculator->income_tax = $incomeTax;
        $taxCalculator->net_profit = $netProfit;
        $taxCalculator->created_by = auth()->user()?->id;
        $taxCalculator->save();
        return response()->json([
            'status' => 200,
            'message' => 'Tax Calculator Saved Successfully!'
        ]);
    }

    public function destroy($id)
    {
        $id = decode($id);
        $taxCalculator = TaxCalculator::findOrFail($id);

        $taxCalculator->deleted_by = auth()->id();
        $taxCalculator->save();

        // Perform the soft delete
        $taxCalculator->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Tax Calculator Deleted Successfully!'
        ]);
    }
}
