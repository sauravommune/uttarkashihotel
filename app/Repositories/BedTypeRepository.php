<?php

namespace App\Repositories;

use App\Models\Amenity;
use App\Models\BedType;
use Illuminate\Http\Request;


class BedTypeRepository extends BaseRepository
{
    public $id = null;
    public function __construct(private BedType $bedType){
        $id =request('id');
        $this->bedType = request('id') ? BedType::find($id) : new BedType();
    }
    public function saveBedType(Request $request)
    {

        $request->validate([
            'bed_type' => 'required|string|max:255|unique:bed_types,bed_type,'.$request->id,
            
        ]);
        $this->bedType->bed_type = $request->bed_type;
        return $this->bedType->save();
    }

    public function removeBedType()
    {
        return $this->bedType->delete();
    }
    public function getBedType()
    {
        return $this->bedType;
    }
}
