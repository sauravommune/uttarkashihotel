<?php

namespace App\Http\Controllers;

use App\Jobs\GoogleReviewJob;
use App\Models\Booking;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function reviewForm($bookingId)
    {
        $bookingId = decode($bookingId);
        $booking = Booking::select('id')->findOrFail($bookingId);
        $feedback = Feedback::where('booking_id', $bookingId)->first() ?? new Feedback();
        $html =  view('SuperAdmin.feedback.google-feedback', compact('feedback', 'booking'))->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }

    public function reviewFormStore(Request $request)
    {
        $request->validate([
            'is_interested' => 'required',
            'feedback_comment' => 'required',
        ]);
        $bookingId = decode($request->booking_id);
        $booking = Booking::select('id')->findOrFail($bookingId);
        $feedback = Feedback::where('booking_id', $bookingId)->first() ?? new Feedback();

        $feedback->booking_id       = $booking?->id;
        $feedback->is_interested    = $request->is_interested;
        $feedback->feedback_comment = $request->feedback_comment;
        $feedback->feedback_status  = $request->is_interested ? 'interested' : 'not Interested';
        $feedback->employee_id      = auth()->user()?->id;
        $feedback->save();

        if (isset($request->send_email) && $request->send_email == 1) {
            GoogleReviewJob::dispatch($booking?->id, auth()->user()?->id);
        }

        return response()->json(['status' => 200, 'message' => 'Feedback Submitted Successfully.']);
    }
}
