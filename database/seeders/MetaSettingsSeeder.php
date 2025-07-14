<?php

namespace Database\Seeders;

use App\Models\MetaSettings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetaSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $routeNames = array(
            array(
                'name'          => 'Home',
                'route_name'    => 'home',
                'meta_title'    => 'Find Top 10 Hotels in Popular Cities of India on Hottel.in',
                'meta_description'    => 'Explore the top 10 hotels in popular cities across India on Hottel.in. Book the best deals on luxury, budget, and family-friendly stays',
            ),
            array(
                'name'          => 'Consult Now',
                'route_name'    => 'consult-now',
                'meta_title'    => 'Free Hotel Consultation | Hottel.in',
                'meta_description'    => 'Explore the top 10 hotels in popular cities across India on Hottel.in. Book the best deals on luxury, budget, and family-friendly stays',
            ),
            array(
                'name'          => 'Terms & Conditions',
                'route_name'    => 'terms-and-conditions',
                'meta_title'    => 'Terms & Conditions | Hottel.in',
                'meta_description'    => 'Explore the top 10 hotels in popular cities across India on Hottel.in. Book the best deals on luxury, budget, and family-friendly stays',
            ),
            array(
                'name'          => 'Privacy Policy',
                'route_name'    => 'privacy-policy',
                'meta_title'    => 'Privacy Policy | Hottel.in',
                'meta_description'    => 'Explore the top 10 hotels in popular cities across India on Hottel.in. Book the best deals on luxury, budget, and family-friendly stays',
            ),
            array(
                'name'          => 'FAQs',
                'route_name'    => 'faq',
                'meta_title'    => 'Frequently Asked Questions | Hottel.in',
                'meta_description'    => 'Explore the top 10 hotels in popular cities across India on Hottel.in. Book the best deals on luxury, budget, and family-friendly stays',
            ),
        );

        foreach ($routeNames as $routeName) {
            $metaSettings = MetaSettings::where('route_name', $routeName['route_name'])->first();
            if( empty($metaSettings) ){
                $metaSettings = new MetaSettings();
                $metaSettings->name = $routeName['name'];
                $metaSettings->route_name = $routeName['route_name'];
                $metaSettings->meta_title = $routeName['meta_title'];
                $metaSettings->meta_description = $routeName['meta_description'];
                $metaSettings->save();
            }
        }
    }
}