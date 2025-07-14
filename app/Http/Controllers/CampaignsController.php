<?php

namespace App\Http\Controllers;

use App\DataTables\CampaignDataTable;
use App\Models\Campaign;
use App\Models\Promotion;

class CampaignsController extends Controller
{
    public function index(CampaignDataTable $datatable)
    {
        $data['title'] = 'Campaign List';
        addVendors(['datatable', 'tinyMCE', 'jquery-validate', 'sweetalert']);
        return $datatable->render('campaigns.index', $data);
    }

    /**
     * Show the form for creating a new promotion.
     */
    public function basic_deal()
    {
        $html = view('campaigns.basic_deal')->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }

    public function pause($id)
    {
        // Find the promotion by ID
        $campaign = Campaign::find($id);

        // Check if the promotion exists
        if (!$campaign) {
            return response()->json([
                'success' => false,
                'message' => 'Promotion not found.',
            ], 404);
        }

        // Pause the campaign (implement your logic here)
        $campaign->status = 'paused'; // Example status update
        $campaign->save();

        // Return a JSON response with a success message
        return response()->json([
            'success' => true,
            'message' => 'Campaign paused successfully.',
        ], 200);
    }

    /**
     * Delete the specified promotion.
     */
    public function delete($id)
    {
        try {
            // Find the promotion by ID
            $promotion = Promotion::find($id);

            // Delete the promotion
            $promotion->delete();

            // Return a JSON response indicating success and include a redirect URL
            return response()->json([
                'status' => 200,
                'message' => 'Campaign deleted successfully',
                'redirect' => route('campaigns.index'),
            ]);
        } catch (\Exception $e) {
            // Return a JSON response indicating failure with error details
            return response()->json([
                'status' => 500,
                'message' => 'Failed to delete campaign Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
