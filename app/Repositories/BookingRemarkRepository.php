<?php

namespace App\Repositories;

use App\Models\BookingRemarks;
use Illuminate\Http\Request;
class BookingRemarkRepository extends BaseRepository
{
  
   public function saveRemarks(Request $request)
   {
      $bookingRemarks = new BookingRemarks();
      $bookingRemarks->description = $request->remark;
      $bookingRemarks->booking_id = decode($request->booking_id);
      $bookingRemarks->remark_type = $request->remark_type;
      $bookingRemarks->added_by = auth()->id();
      return $bookingRemarks->save();;
   }
}
