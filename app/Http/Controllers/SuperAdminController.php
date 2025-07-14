<?php

namespace App\Http\Controllers;

use App\DataTables\FeedbackReportDataTable;
use App\DataTables\FollowUpReportDataTable;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\SearchLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{

    public function index()
    {
        $title = 'Dashboard';
        addVendors(['datatable', 'jquery-validate']);
        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['Admin', 'Staff', 'Manager']);
        })->get();
        return view('SuperAdmin.dashboard', compact('title', 'users'));
    }

    public function dashboardSection(Request $request)
    {
        $dateRange = $this->getDateRange($request->date);
        switch ($request->section) {
            case 'analytics':
                return $this->analyticCount($dateRange);
                break;
            case 'followup':
                return $this->sectionFollowUp();
                break;
            case 'feedback':
                return $this->sectionFeedback();
                break;
            case 'todayCheckIn':
                break;
            default:
                abort(404);
                break;
        }
    }

    private function getDateRange($date_range)
    {
        $dateRange = [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()];
        if (!empty($date_range)) {
            $dateRange = explode('to', $date_range);
            $dateRange = [Carbon::parse($dateRange[0])->startOfDay(), Carbon::parse($dateRange[1])->endOfDay()];
        }
        return $dateRange;
    }

    private function analyticCount($dateRange)
    {
        $searchCount = SearchLog::whereBetween('created_at', $dateRange)->count();
        $hotelSelected = Booking::whereBetween('created_at', $dateRange)->count();
        $paymentCompleted = Payment::whereBetween('created_at', $dateRange)->where('status', 'captured')->count();
        $bookingCompleted = Booking::whereBetween('created_at', $dateRange)->whereIn('status', ['confirmed', 'refund_initiated', 'refunded'])->count();
        $bookingRefunded = Booking::whereBetween('created_at', $dateRange)->whereIn('status', ['refund_initiated', 'refunded'])->count();

        $bookingTimeReport = Booking::select(
            DB::raw('
                CASE 
                    WHEN TIME(created_at) BETWEEN "00:00:00" AND "04:59:59" THEN "12:00 AM - 5:00 AM"
                    WHEN TIME(created_at) BETWEEN "05:00:00" AND "08:59:59" THEN "5:00 AM - 9:00 AM"
                    WHEN TIME(created_at) BETWEEN "09:00:00" AND "11:59:59" THEN "9:00 AM - 12:00 PM"
                    WHEN TIME(created_at) BETWEEN "12:00:00" AND "15:59:59" THEN "12:00 PM - 4:00 PM"
                    WHEN TIME(created_at) BETWEEN "16:00:00" AND "19:59:59" THEN "4:00 PM - 8:00 PM"
                    ELSE "8:00 PM - 12:00 AM"
                END AS time_slot'),
            DB::raw('
                CASE 
                    WHEN TIME(created_at) BETWEEN "00:00:00" AND "04:59:59" THEN 1
                    WHEN TIME(created_at) BETWEEN "05:00:00" AND "08:59:59" THEN 2
                    WHEN TIME(created_at) BETWEEN "09:00:00" AND "11:59:59" THEN 3
                    WHEN TIME(created_at) BETWEEN "12:00:00" AND "15:59:59" THEN 4
                    WHEN TIME(created_at) BETWEEN "16:00:00" AND "19:59:59" THEN 5
                    ELSE 6
                END AS time_slot_order'),
            DB::raw("SUM(CASE WHEN status IN ('confirmed', 'refund_initiated', 'refunded') THEN 1 ELSE 0 END) AS booked"),
            DB::raw("SUM(CASE WHEN status NOT IN ('confirmed', 'refund_initiated', 'refunded') THEN 1 ELSE 0 END) AS pending")
        )
            ->whereBetween('created_at', $dateRange)
            ->groupBy('time_slot', 'time_slot_order')
            ->orderBy('time_slot_order')
            ->get();
        return response()->json([
            'status' => 200,
            'searchCount'       => $searchCount,
            'detailFilled'      => $hotelSelected,
            'paymentCompleted'  => $paymentCompleted,
            'bookingCompleted'  => $bookingCompleted,
            'bookingRefunded'   => $bookingRefunded,
            'bookingTimeReport' => $bookingTimeReport
        ]);
    }

    private function sectionFeedback()
    {
        $dataTable = new FeedbackReportDataTable();
        return $dataTable->render('SuperAdmin.dashboard');
    }

    private function sectionFollowUp()
    {
        $dataTable = new FollowUpReportDataTable();
        return $dataTable->render('SuperAdmin.dashboard');
    }
}
