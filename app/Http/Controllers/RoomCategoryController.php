<?php

namespace App\Http\Controllers;

use App\Models\RoomCategory;
use App\Repositories\RoomCategoryRepository;
use Illuminate\Http\Request;
use App\DataTables\RoomCategoryDataTable;
use Exception;


class RoomCategoryController extends Controller
{

    public function __construct(private RoomCategoryRepository $roomCategoryRepository) {}
    
    public function changeStatus()
    {
        try {
            $this->roomCategoryRepository->changeStatus();
            return response()->json(['status' => 200, 'message' => 'Updated Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }


    public function saveRoomCategory($id = null)
    {
        addVendors(['jquery-validate']);
        if ($id) {
            $RoomCategory = RoomCategory::find(decode($id));
            $data['title'] = "Edit Category";
        } else {
            $RoomCategory = new RoomCategory();
            $data['title'] = "Add Category";
        }
        return view('roomcategory.add', ['data' => $data, 'room_category' => $RoomCategory]);
    }

    public function createRoomCategory(Request $request)
    {


        $validatedData = $request->validate([
            'category_name' => 'required|string',
        ]);
        try {
            $existingCategory = RoomCategory::where('name', $request->category_name)->when($request->id, function ($query) use ($request) {
                $query->where('id', '!=', $request->id);
            })->first();

            if ($existingCategory) {
                return response()->json(['status' => 409, 'message' => 'Room category already exists'], 500);
            }
            $category = $request->id ? RoomCategory::find($request->id) : new RoomCategory();
            $category->name = $request->category_name;
            $category->save();

            return response()->json(['status' => 200, 'message' => 'Room Category Saved Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteRoomCategory($id = null)
    {


        $checkCategory = RoomCategory::find(decode($id));
        try {
            $checkCategory->delete();
            return response()->json(['status' => 200, 'message' => 'City delete successfully', 'redirect' => 'room-category'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }
    public function roomCategory(RoomCategoryDataTable $dataTable)
    {

        $data['title'] = "Room Category";
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        return $dataTable->render('roomcategory.index', $data);
    }
}
