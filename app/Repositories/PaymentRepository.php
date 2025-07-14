<?php

namespace App\Repositories;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use App\Models\BookedRoomDetails;
use Illuminate\Support\Facades\Log;

class PaymentRepository extends BaseRepository
{

	public function addBookingId($data)
	{
		$payment = Payment::where('booking_id', $data['booking_id'])->where('is_initial', 1)->firstOrNew();

		$payment->user_id			= Auth::user()->id;
		$payment->order_id			= $data['order_id'];
		$payment->merchant_order_id	= $data['merchant_order_id'];
		$payment->booking_id		= $data['booking_id'];
		$payment->amount			= $data['payableAmount'];
		$payment->cost				= $data['vendorCost'];
		$payment->markup			= $data['markup'];
		$payment->status			= 'pending';
		$payment->mode				= 'razorpay';
		$payment->payment_method	= $data['paymentMethod'];
		$payment->coupon			= $data['couponAmount'];
		$payment->remarks			= 'Initial Payment';
		$payment->is_initial		= 1;
		$payment->save();
	}

	public function updateAmount($booking_id)
	{
		try {
			// Fetch booking data
			$bookingData = BookedRoomDetails::where('booking_id', $booking_id)->get();

			// Calculate vendor cost
			$vendorCost = $bookingData->sum('vendor_cost');

			// Calculate paid amount for the booking
			$paidAmount = Payment::where('booking_id', $booking_id)
				->whereIn('status', ['captured', 'authorized'])
				->sum('amount');

			// Calculate markup
			$markup = $paidAmount - $vendorCost;

			Payment::where('booking_id', $booking_id)->update([
				'markup' => 0
			]);

			// Update the initial payment record
			Payment::where('booking_id', $booking_id)
				->where('is_initial', 1)
				->update([
					'cost' => $vendorCost,
					'markup' => $markup,
				]);

			return response()->json([
				'status' => 200,
				'message' => 'Amount updated successfully.',
			]);
		} catch (\Exception $e) {
			Log::error('Error updating amount: ' . $e->getMessage());

			return response()->json([
				'status' => 500,
				'message' => 'Failed to update the amount.',
			]);
		}
	}
}
