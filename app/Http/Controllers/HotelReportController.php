<?php

namespace App\Http\Controllers;

class HotelReportController extends Controller
{
    public function index()
    {
        $data['title'] = 'Hotel Report';
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        return view('front.hotel_report.index',  $data);
    }
}
