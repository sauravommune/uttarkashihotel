<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class CustomerReviewController extends Controller
{
    public function index()
    {
        $data['title'] = 'Customer Reviews';
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        return view('customerReview.index',  $data);
    }
}
