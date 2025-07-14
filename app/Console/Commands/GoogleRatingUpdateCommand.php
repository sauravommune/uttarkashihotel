<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Hotel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\HotelReview;

class GoogleRatingUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:google-rating-update-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $hotels = Hotel::where('status', 'active')
                    ->whereNotNull('google_place_id')
                    ->get();
        foreach ($hotels as $hotel) {
            $url = 'https://maps.googleapis.com/maps/api/place/details/json';
            $response = Http::get($url, [
                'place_id' => $hotel->google_place_id,
                'fields' => 'rating,user_ratings_total',
                'key' => env('GOOGLE_PLACES_API_KEY'),
            ]);

            if ($response->successful()) {
                $google_rating = $response->json('result.rating');
                $google_rating_total = $response->json('result.user_ratings_total');
                $hotel->update(['google_rating' => $google_rating, 'google_rating_total' => $google_rating_total]);
            } else {
                Log::error('Error fetching place details for '. $hotel->google_place_id, ['response' => $response->body()]);
            }
        }
    }
}
