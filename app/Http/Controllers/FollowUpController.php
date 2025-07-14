<?php

namespace App\Http\Controllers;

use App\DataTables\FollowUpDataTable;
use App\Models\Booking;
use App\Models\FollowUp;
use Illuminate\Http\Request;

class FollowUpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FollowUpDataTable $dataTable)
    {
        return $dataTable->render('lead.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($booking, $followup = null)
    {
        $bookingId = decode($booking);
        $followUpId = decode($followup);
        $booking = Booking::findOrFail($bookingId);
        if (!empty($followUpId)) {
            $followUp = FollowUp::findOrFail($followUpId);
        } else {
            $followUp = new FollowUp();
        }
        $html =  view('lead.model.follow-up-form', compact('booking', 'followUp'))->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'follow_up_date'    => 'required|date',
            'status'            => 'required|in:Open,Closed',
            'remarks'            => 'required',
        ]);
        $followUpId = decode($request->follow_up);

        $followUp = FollowUp::firstOrNew(['id' => $followUpId]);

        $followUp->booking_id       = decode($request->booking_id);
        $followUp->remarks          = $request->remarks;
        $followUp->follow_up_date   = $request->follow_up_date;
        $followUp->follow_up_by     = auth()->user()?->id;
        $followUp->status           = $request->status;
        $followUp->save();
        return response()->json(['status' => 200, 'message' => 'Follow Up Details Saved Successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(FollowUp $followUp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FollowUp $followUp)
    {
        $followUp->delete();
        return response()->json(['status' => 200, 'message' => 'Follow Up Details Deleted Successfully.']);
    }
}
