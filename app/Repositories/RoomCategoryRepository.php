<?php

namespace App\Repositories;

use App\Models\RoomCategory;
use Exception;

class RoomCategoryRepository extends BaseRepository
{

    public function __construct(public ?RoomCategory $roomCategory)
    {
        $this->roomCategory = request('id') ? $this->roomCategory->find(request('id')) : $this->roomCategory;
    }

    public function changeStatus()
    {
        try {
            $this->roomCategory->status = $this->roomCategory->status == 'active' ? 'inactive' : 'active';
            return $this->roomCategory->save();
        } catch (Exception $e) {
            throw new Exception();
        }
    }
}
