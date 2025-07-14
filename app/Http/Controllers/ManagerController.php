<?php

namespace App\Http\Controllers;

use App\DataTables\ManagerDataTable;
use App\DataTables\HotelManagerDataTable;
use Illuminate\Http\Request;
use App\Repositories\ManagerRepository;


class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\DataTables\ManagerDataTable $datatable
     * @param \App\DataTables\HotelManagerDataTable $datatable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __construct(private ManagerRepository $managerRepository) {}

    public function dashboard(Request $request, ManagerDataTable $datatable)
    {
        $data['title'] = 'Hotel Managementds';
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        return $datatable->render('hotelmanager.dashboard', $data);
    }

    public function index(Request $request, HotelManagerDataTable $datatable)
    {
        $data['title'] = 'Hotel Managers';
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        return $datatable->render('hotelmanager.index', $data);
    }

    public function add_room(Request $request, HotelManagerDataTable $datatable)
    {
        $data['title'] = 'Standard AC Room';
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        return $datatable->render('hotelmanager.add_room', $data);
    }

    public function details(Request $request, ManagerDataTable $datatable)
    {
        $data['title'] = 'Hotel Management';
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        return $datatable->render('hotelmanager.details', $data);
    }

    public function edit(Request $request, ManagerDataTable $datatable)
    {
        $data['title'] = 'Hotel Details';
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        return $datatable->render('hotelmanager.edit', $data);
    }
}
