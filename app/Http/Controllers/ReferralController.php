<?php

namespace App\Http\Controllers;

use App\DataTables\PayoutDataTable;
use App\DataTables\PayoutTransactionDataTable;
use App\DataTables\ReferralDataTable;
use App\DataTables\ReferralReportDataTable;
use App\Models\Booking;
use App\Models\Payout;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class ReferralController extends Controller
{
    public function index(ReferralDataTable $dataTable, PayoutTransactionDataTable $payoutTransactionDataTable)
    {
        addVendors(['datatable', 'flatpickr']);
        if (auth()->user()->hasRole('Affiliate')) {

            $start_date = request()->input('start_date');
            $end_date = request()->input('end_date');


            $query = Booking::where('referred_by', auth()->id());
            if ($start_date) {
                $query->whereDate('created_at', '>=', $start_date);
            }

            if ($end_date) {
                $query->whereDate('created_at', '<=', $end_date);
            }

            $data['total_leads'] = $query->count();


            $completed_leads_query = Booking::withSum(['transactions as total_markup' => function ($query) {
                $query->whereIn('status', ['captured', 'authorized']);
            }], 'markup')
                // ->where('referred_by',$query?->id)
                ->where('status', config('referral.lead_status.completed'));


            if ($start_date) {
                $completed_leads_query->whereDate('created_at', '>=', $start_date);
            }

            if ($end_date) {
                $completed_leads_query->whereDate('created_at', '<=', $end_date);
            }

            $completed_leads = $completed_leads_query->get();

            $data['total_markup'] = $completed_leads?->sum('total_markup');

            $data['completed_leads_count'] = $completed_leads?->count() ?? 0;
            $profit_share = auth()->user()?->profit_share;
            $data['earnings'] = round(($data['total_markup'] * $profit_share) / 100);


            $payouts_query = Payout::where('user_id', auth()->id());

            if ($start_date) {
                $payouts_query->whereDate('created_at', '>=', $start_date);
            }

            if ($end_date) {
                $payouts_query->whereDate('created_at', '<=', $end_date);
            }

            $data['total_payouts'] = $payouts_query->sum('amount');


            if (request()->ajax()) {
                return response()->json(['status' => 200, 'data' => $data], 200);
            }

            return $payoutTransactionDataTable->render('referral.user-referral', $data);
        }
        return $dataTable->render('referral.index');
    }

    public function register($id = null)
    {
        addVendors(['select', 'jquery-validate']);
        $user = !empty($id) ? User::find($id) : new User();
        $referral_code =  $user->affiliate_code  ? $user->affiliate_code : generateReferralCode();
        return view('referral.register', compact('referral_code', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'company_name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'phone' => 'required',
            'password' => 'required_if:id,' . !$request->id,
            'password_confirmation' => 'required_if:id,' . !$request->id . '|same:password',
            // 'referral_code' => 'required',
            'bank_name' => 'required',
            'account_number' => 'required',
            'ifsc_code' => 'required',
            // 'neft_code' => 'required',
            'account_type' => 'required',
            'profit_share' => 'required',

        ]);

        $modelClass = config('referral.referral_models', 'App\Models\User');
        $modelRef = app($modelClass);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->id ?: $request->password,
            'phone' => $request->phone,
            'status' => 1,
            'affiliate_code' => $request->referral_code,
            'profit_share' => $request->profit_share,
            'bank_details' => [

                'bank_name' => $request->bank_name,
                'branch_name' => $request->branch_name,
                'account_number' => $request->account_number,
                'ifsc_code' => $request->ifsc_code,
                'neft_code' => $request->neft_code,
                'account_type' => $request->account_type,
                'company_name' => $request->company_name,
            ]
        ];
        try {
            $newUser = $modelRef->updateOrCreate(
                ['id' => $request->id],
                $data
            );

            if (! $request->id) {
                $newUser->assignRole('Affiliate');
            }

            return response()->json(['status' => 200, 'message' => 'Saved Successfully', 'redirect' => route('referral.index')]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage(), 'redirect' => route('referral.index')]);
        }
    }
    public function reports(ReferralReportDataTable $dataTable)
    {
        addVendors(['datatable', 'flatpickr', 'select2']);
        $ref_table = config('referral.referral_table', 'users');
        $users = DB::table($ref_table)->get();
        return $dataTable->render('referral.reports', compact('users'));
    }
    public function payouts(PayoutDataTable $dataTable, PayoutTransactionDataTable $payoutTransactionDataTable)
    {
        addVendors(['datatable', 'flatpickr', 'select', 'jquery-validate']);
        $ref_table = config('referral.referral_table', 'users');
        $users = DB::table($ref_table)->get();
        return $dataTable->render('referral.payouts', compact('users'));
        // return $payoutTransactionDataTable->render('referral.user-payout');
    }

    public function payoutTransaction(PayoutTransactionDataTable $dataTable)
    {
        addVendors(['datatable', 'flatpickr']);
        return $dataTable->render('referral.payout-transactions');
    }

    public function payoutForm($user_id)
    {
        $ref_table = config('referral.referral_table', 'users');
        $user = DB::table($ref_table)->where('id', $user_id)->first();
        return view('referral.payout-form', compact('user'));
    }
    public function savePayout(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'amount' => 'required|numeric',
            'transaction_id' => 'required',
            'payment_date' => 'required',
        ]);
        $ref_table = config('referral.referral_table', 'users');
        $user = DB::table($ref_table)->where('id', $request->user_id)->first();
        $data = [
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'paid_on' => $request->payment_date,
            'transaction_id' => $request->transaction_id,
        ];
        Payout::create($data);
        return response()->json(['status' => 200, 'message' => 'Saved Successfully', 'redirect' => route('referral.payouts')]);
    }

    public function checkDomain(Request $request)
    {
        $request->validate([
            'url' => 'required',
        ]);
        $referer = $request->url;
        $url = $referer . "?ref=" . auth()->user()->affiliate_code;
        $expectedDomain = 'hotel.test';
        if (strpos($referer, $expectedDomain) !== false) {
            return response()->json(['status' => 200, 'success' => true, 'message' => 'Valid Domain', 'text' => $url]);
        } else {
            return response()->json(['status' => 500, 'success' => false, 'message' => 'Invalid Domain'], 500);
        }
    }
}
