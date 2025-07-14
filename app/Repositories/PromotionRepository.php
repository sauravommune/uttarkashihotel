<?php

namespace App\Repositories;

use App\Models\Promotion;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromotionRepository extends BaseRepository
{
    public function __construct(private Promotion $promotion)
    {
        $this->promotion = request('id') ? Promotion::find(request('id')) : new Promotion();
    }

    public function savePromotions(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'discount_percent' => 'required',
            'campaign_name' => 'required',
            'discount_up_to' => 'required',
            'offer_start_end_date' => 'required',
            'check_in' => 'required',
            'seen_by' => 'required',
            'applied_on' => 'required',
        ]);
        if ($validate->fails()) {
            throw new HttpResponseException(response()->json([
                'errors' => $validate->errors()
            ], 422));
        }

        $offerDate = explode('to', $request->offer_start_end_date);
        $checkDate = explode('to', $request->check_in);
        $this->promotion->title = $request->campaign_name;
        $this->promotion->promotion_type = $request->type;
        $this->promotion->discount_percent = $request->discount_percent;
        $this->promotion->discount_min_price = $request->discount_up_to;
        $this->promotion->offer_start_date = $offerDate[0];
        $this->promotion->offer_end_date = $offerDate[1];
        $this->promotion->check_in_date = $checkDate[0];
        $this->promotion->check_out_date = $checkDate[1];
        $this->promotion->seen_by = $request->seen_by;
        $this->promotion->applied_on = $request->applied_on;
        $this->promotion->created_by = auth()->id();
        $this->promotion->save();
    }
}
