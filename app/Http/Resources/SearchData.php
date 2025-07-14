<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchData extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {

        return [
                'id' => $this->id,
                'checkin_date' => $this->checkin_date,
                'checkout_date' => $this->checkout_date,
                'roomCount' => $this->roomCount,
                'adultCount' => $this->adultCount,
                'childCount' => $this->childCount,
                'child_ages' => $this->child_ages,
        ];
    }
}