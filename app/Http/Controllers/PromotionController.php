<?php

namespace App\Http\Controllers;

use App\DataTables\PromotionsDataTable;
use App\Models\RoomCategory;
use App\Repositories\PromotionRepository;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Exception;

class PromotionController extends Controller
{
    /**
     * Display the list of promotions.
     */
    public function __construct(private PromotionRepository $promotionRepository) {}

    public function index(PromotionsDataTable $datatable)
    {
        $data['title'] = 'Promotions';
        addVendors(['datatable', 'tinyMCE', 'jquery-validate', 'sweetalert']);
        return $datatable->render('promotion.index', $data);
    }

    public function basic_deal($type = null)
    {
        $roles = Role::all();
        $room_types = RoomCategory::all();
        $offerType = request('type');
        $html = view('promotion.basic_deal', compact('room_types', 'roles', 'offerType', ''))->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }

    public function store(Request $request)
    {
        try {
            $this->promotionRepository->savePromotions($request);
            return response()->json(['status' => 200, 'message' => 'Details Saved Successfully'], 200);
        } catch (Exception $e) {

            if ($e instanceof HttpResponseException) {

                $response = $e->getResponse();
                $errorDetails = json_decode($response->getContent(), true);
                $errors = $errorDetails['errors'];
                return response()->json(['status' => 500, 'errors' => $errors], 500);
            } else {
                return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
            }
        }
    }
}
