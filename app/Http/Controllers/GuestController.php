<?php

namespace App\Http\Controllers;

use App\DataTables\BookingGuestDataTable;
use App\Models\Booking;
use App\Models\ContactInformation;
use App\Models\TravellerDetails;
use App\Services\LeadRemarkLogger;
use Exception;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    //
    public function guestDatatable(BookingGuestDataTable $dataTable)
    {
        return $dataTable->render('lead.index');
    }

    public function guestForm($bookingId, $guestId = null)
    {
        $guestId = decode($guestId);
        $guest = TravellerDetails::findOrNew($guestId);
        $html = view('lead.guest.form', compact('bookingId', 'guest'))->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }

    public function saveGuest(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255',
            'gender'    => 'required|in:male,female',
            'dob'       => 'required|date',
        ]);
        try {
            $guestId = decode($request->id);
            $guest = TravellerDetails::findOrNew($guestId);

            $oldData = $guest->toArray();

            $guest->name = $request->name;
            $guest->email = $request->email;
            $guest->gender = $request->gender;
            $guest->dob = $request->dob;
            $guest->booking_id = $request->bookingId;
            $guest->save();

            $newData = $guest->toArray();
            $bookingId = Booking::where('booking_id', $request->bookingId)->first()->id;
            $remark = $guestId ? "Guest Updated" : "Guest Added";
            LeadRemarkLogger::logChanges($oldData, $newData, $bookingId, "remark", $remark);

            return response()->json(['status' => 200, 'message' => 'Guest save successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function contactForm($bookingId = '', $contactId = null)
    {
        $contactId = decode($contactId);
        $contact = ContactInformation::findOrNew($contactId);
        $html = view('lead.guest.contactForm', compact('bookingId', 'contact'))->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }
    public function saveContact(Request $request)
    {

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255',
            'mobile'    => 'required|integer',
        ]);

        try {
            $contactInfo  = ContactInformation::findOrFail($request->id);
            $oldData = $contactInfo->toArray();

            $contactInfo->name = $request->name;
            $contactInfo->email = $request->email;
            $contactInfo->mobile = $request->mobile;
            $contactInfo->save();
            $newData = $contactInfo->toArray();
            $url = $request->bookingId;

            $bookingId = Booking::where('booking_id', $request->bookingId)->first()->id;
            $remark = $request->id ? "Contact Info Updated" : "Contact Info Added";
            LeadRemarkLogger::logChanges($oldData, $newData, $bookingId, "remark", $remark);

            return response()->json(['status' => 200, 'message' => 'Contact Information Update Successfully', 'redirect' => $url]);
        } catch (Exception $e) {
            return response()->json(['status' => 400, 'message' => $e->getMessage()]);
        }
    }
}
