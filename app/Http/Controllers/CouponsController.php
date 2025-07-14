<?php

namespace App\Http\Controllers;

use App\Models\Coupons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\DataTables\CouponDataTable;
use Carbon\Carbon;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CouponDataTable $dataTable)
    {
        $title = 'Coupon Management';
        addVendors(['datatable', 'flatpicker', 'sweet_alert', 'jquery-validate']);
        return $dataTable->render('coupon.index', compact('title'));
    }

    public function create()
    {
        $row = new Coupons();
        addVendors(['flatpicker', 'sweet_alert', 'choices', 'datatable', 'tinyMCE', 'jquery-validate']);
        $active_coupons = Coupons::where('is_active', true)->get();
        return view('coupon.form', compact('row', 'active_coupons'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code|max:100',
            'value' => 'required|integer',
            'date' => 'required',
            'usage_limit' => 'required|integer',
        ]);
        if ($request->amount && $request->amount == 'percent' && $request->value > 100) {
            return response()->json(['status' => 422, 'message' => 'Percentage should be 100 or less then 100!'], 422);
        }

        $date = explode('to', $request->date);
        if (count($date) != 2) {
            return response()->json(['status' => 422, 'message' => 'Select proper date range!'], 422);
        }
        DB::beginTransaction();
        try {
            $master                     = new Coupons();
            $master->code               = $request->code;
            $master->title              = $request->title;
            $master->description        = $request->description;
            $master->type               = $request->type;
            $master->value              = $request->value;
            $master->start_date         = Carbon::parse(trim($date[0]))->format('Y-m-d');
            $master->expiration_date    = Carbon::parse(trim(end($date)))->format('Y-m-d');
            $master->usage_limit        = $request->usage_limit;
            $master->ticket_type        = $request->ticket_type;
            $master->is_active          = !empty($request->status) ? 1 : 0;
            $master->auto_apply         = !empty($request->auto_apply) ? 1 : 0;
            $master->is_visible         = !empty($request->is_visible) ? 1 : 0;
            $master->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 422, 'message' => 'Failed to create coupon!'], 422);
        }
        // set flash message
        session()->flash('success', 'Coupon created successfully.');
        return response()->json(['status' => 200, 'message' => 'Coupon created successfully.', 'redirect' => route('coupons.index')], 200);
    }

    public function edit(String $id)
    {
        addVendors(['flatpicker', 'sweet_alert', 'choices', 'datatable', 'tinyMCE', 'jquery-validate']);
        $row = Coupons::findOrFail(decode($id));
        $active_coupons = Coupons::where('is_active', true)->get();
        return view('coupon.form', compact('row', 'active_coupons'));
    }

    public function update(Request $request, String $id)
    {
        $request->validate([
            'code' => [
                'required',
                Rule::unique('coupons')->ignore(decode($id)),
            ],
            'value' => 'required|integer',
            'date' => 'required',
            'usage_limit' => 'required|integer',
        ]);
        if ($request->amount && $request->amount == 'percent' && $request->value > 100) {
            return response()->json(['status' => 422, 'message' => 'Percentage should be 100 or less then 100!'], 422);
        }

        $date = explode('to', $request->date);
        if (count($date) != 2) {
            return response()->json(['status' => 422, 'message' => 'Select proper date range!'], 422);
        }

        DB::beginTransaction();
        try {
            $master                     = Coupons::findOrFail(decode($id));
            $master->code               = $request->code;
            $master->title              = $request->title;
            $master->description        = $request->description;
            $master->type               = $request->type;
            $master->value              = $request->value;
            $master->start_date         = Carbon::parse(trim($date[0]))->format('Y-m-d');
            $master->expiration_date    = Carbon::parse(trim(end($date)))->format('Y-m-d');
            $master->usage_limit        = $request->usage_limit;
            $master->ticket_type        = $request->ticket_type;
            $master->is_active          = !empty($request->status) ? 1 : 0;
            $master->auto_apply         = !empty($request->auto_apply) ? 1 : 0;
            $master->is_visible         = !empty($request->is_visible) ? 1 : 0;
            $master->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 422, 'message' => 'Failed to create coupon!'], 422);
        }
        session()->flash('success', 'Coupon updated successfully.');
        return response()->json(['status' => 200, 'message' => 'Coupon updated successfully.', 'redirect' => route('coupons.index')], 200);
    }

    public function destroy(String $id)
    {
        Coupons::find(decode($id))->delete();
        return response()->json(['status' => 200, 'message' => 'Coupon Deleted Successfully.', 'redirect' => route('coupons.index')],);
    }

    public function check_duplicate(Request $request)
    {
        if (Coupons::where('code', $request->code)->first()) {
            echo 'This coupon code already exists!';
        } else {
            echo '';
        }
    }
}
