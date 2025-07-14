<?php

namespace App\Jobs;

use App\Models\Hotel;
use App\Models\City;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class GenerateSitemapJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        try {
            $sitemap = Sitemap::create()
                ->add(Url::create(self::addSlash(url('/')))->setLastModificationDate(now())->setPriority(1.0))
                ->add(Url::create(self::addSlash(url('/about')))->setLastModificationDate(now())->setPriority(0.8))
                ->add(Url::create(self::addSlash(url('/contact-us')))->setLastModificationDate(now())->setPriority(0.8))
                ->add(Url::create(self::addSlash(url('/consult-now')))->setLastModificationDate(now())->setPriority(0.7))
                ->add(Url::create(self::addSlash(url('/cancellation-policy')))->setLastModificationDate(now())->setPriority(0.6))
                ->add(Url::create(self::addSlash(url('/privacy-policy')))->setLastModificationDate(now())->setPriority(0.6))
                ->add(Url::create(self::addSlash(url('/faq')))->setLastModificationDate(now())->setPriority(0.5));

            // Add hotel detail pages

            $uniqueCityIds = DB::table('hotels')->select('city')->groupBy('city')->pluck('city');
             foreach ($uniqueCityIds as $city) {

                $city = City::where('id',$city)->first();

                $cityUrl = self::addSlash(url('/hotels-in-' . strtolower($city->name)));
                $sitemap->add(Url::create($cityUrl)->setLastModificationDate($city->updated_at ?? now())->setPriority(0.9));
            }

            $hotels = Hotel::all();
            foreach ($hotels as $hotel) {

                $hotelUrl = self::addSlash(url('/hotel-details/' . $hotel->slug));
                $sitemap->add(Url::create($hotelUrl)->setLastModificationDate($hotel->updated_at ?? now())->setPriority(0.9));
            }

            $sitemap->writeToFile(public_path('sitemap.xml'));
            Log::info('Sitemap created successfully.');
        } catch (\Exception $e) {
            Log::warning('Sitemap generation failed: ' . $e->getMessage());
        }
    }

    // Ensure the URL ends with a single trailing slash
    public static function addSlash(string $url): string
    {
        return rtrim($url, '/') . '/';
    }
} 
