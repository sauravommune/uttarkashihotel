<?php

namespace App\Http\Controllers;

use App\DataTables\BookingDataTable;

class BookingController extends Controller
{
    public function index(BookingDataTable $dataTable)
    {
        $data['title'] = 'Booking Management';
        // $data['hotelId'] = $hotelId;
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        return $dataTable->render('booking.index', $data);
    }
}
