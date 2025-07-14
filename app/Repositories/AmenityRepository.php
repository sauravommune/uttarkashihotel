<?php

namespace App\Repositories;

use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AmenityRepository extends BaseRepository
{

   public function saveAmenity(Request $request)
    {
        $validatedData = $request->validate([
            'amenity_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('amenities', 'name')->ignore($request->id),
            ],
            'type' => 'required|in:room,hotel',
            'amenity_type' => 'required|string|max:255',
        ]);

        $addAmenity = $request->id ? Amenity::findOrFail($request->id) : new Amenity();
        $addAmenity->name = $request->amenity_name;
        $addAmenity->type = $request->type;
        $addAmenity->amenity_type = $request->amenity_type;
        $addAmenity->icode = $request->icode;
        $addAmenity->save();
    }
}