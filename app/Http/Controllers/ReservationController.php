<?php

namespace App\Http\Controllers;

use App\DataTables\ReservationDataTable;
use App\DataTables\PaymentDataTable;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Reservations;
use App\Models\Payment;
use App\Models\RoomCategory;
use Spatie\Permission\Models\Role;

class ReservationController extends Controller
{
    public function index(ReservationDataTable $datatable)
    {
        $data['title'] = 'Reservation';
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        return $datatable->render('reservations.index', $data);
    }

    public function create()
    {
        $data['title'] = 'New Booking';
        return view('reservations.create', $data);
    }

    public function details(PaymentDataTable $datatable)
    {
        $data['title'] = 'Booking Details';
        $data['id'] = rand(100000000, 999999999); // Generate a random 9-digit number
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        return $datatable->render('reservations.details', $data);
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'Cancelled'; // Update status or perform the cancellation logic
        $booking->save();

        return response()->json(['success' => 'Booking cancelled successfully.']);
    }



    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'Booking_ID' => 'required|string|max:255|unique:reservations,Booking_ID',
            'Guest_name' => 'required|string|max:255',
            'room_type' => 'required|string|max:255',
            'room' => 'required|string|max:255',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after_or_equal:check_in',
            'Stay_nights' => 'required|integer|min:1',
            'Booked_on' => 'required|date',
            'Booked_status' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        // Create a new reservation using the validated data
        $reservation = Reservations::create($validatedData);

        return response()->json(['status' => 200, 'message' => "Reservation created successfully"], 200);
    }

    public function update_payment_status(Request $request, $id)
    {
        // Fetch the payment record
        $payment = Payment::findOrFail($id);

        // Update the payment status based on your logic
        $payment->status = 'Updated'; // Update as needed
        $payment->save();

        // Fetch data for the view
        $roles = Role::all();
        $room_types = RoomCategory::all();
        $offerType = request('type'); // Adjust based on your needs

        // Render the view and pass the data
        $html = view('reservations.update_payment_status', compact('room_types', 'roles', 'offerType'))->render();

        // Return the JSON response with success status and HTML content
        return response()->json(['success' => 200, 'message' => 'Payment status updated successfully.', 'html' => $html]);
    }
}
