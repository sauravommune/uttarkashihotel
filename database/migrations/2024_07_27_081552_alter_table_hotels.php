<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->string('parking_available')->default('no');
            $table->string('parking_comment')->nullable();
            $table->string('check_in_time')->nullable();
            $table->string('check_out_time')->nullable();
            $table->string('cancellation_before')->nullable();
            $table->string('google_embed_url')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('owner_contact_no')->nullable();
            $table->string('owner_email')->nullable();
            $table->string('post_code')->nullable();
            $table->json('near_by_place')->nullable();
            $table->json('near_by_distance')->nullable();
            $table->string('early_check_in_check_out')->nullable();
            $table->string('country')->nullable();
            $table->string('invoice_name')->nullable();
            $table->string('reservation_required')->nullable();
            $table->string('parking_location')->nullable();
            $table->string('parking_type')->nullable();
            $table->string('breakfast_served')->nullable();
            $table->double('enter_amount', 7, 2)->nullable();
            $table->string('cuisine')->nullable();
            $table->string('children_allowed')->nullable();
            $table->string('pets_allowed')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->string('gst_no')->nullable();
            $table->string('hotel_imgs')->nullable();
            $table->string('status', 50)->default('active')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            if (Schema::hasColumn('hotels', 'parking_available')) {
                $table->dropColumn('parking_available');
            }
            if (Schema::hasColumn('hotels', 'parking_comment')) {
                $table->dropColumn('parking_comment');
            }
            if (Schema::hasColumn('hotels', 'check_in_time')) {
                $table->dropColumn('check_in_time');
            }
            if (Schema::hasColumn('hotels', 'check_out_time')) {
                $table->dropColumn('check_out_time');
            }
            if (Schema::hasColumn('hotels', 'cancellation_before')) {
                $table->dropColumn('cancellation_before');
            }
            if (Schema::hasColumn('hotels', 'google_embed_url')) {
                $table->dropColumn('google_embed_url');
            }
            if (Schema::hasColumn('hotels', 'owner_name')) {
                $table->dropColumn('owner_name');
            }
            if (Schema::hasColumn('hotels', 'owner_contact_no')) {
                $table->dropColumn('owner_contact_no');
            }
            if (Schema::hasColumn('hotels', 'owner_email')) {
                $table->dropColumn('owner_email');
            }
            if (Schema::hasColumn('hotels', 'post_code')) {
                $table->dropColumn('post_code');
            }
            if (Schema::hasColumn('hotels', 'near_by_place')) {
                $table->dropColumn('near_by_place');
            }
            if (Schema::hasColumn('hotels', 'near_by_distance')) {
                $table->dropColumn('near_by_distance');
            }
            if (Schema::hasColumn('hotels', 'early_check_in_check_out')) {
                $table->dropColumn('early_check_in_check_out');
            }
            if (Schema::hasColumn('hotels', 'country')) {
                $table->dropColumn('country');
            }
            if (Schema::hasColumn('hotels', 'invoice_name')) {
                $table->dropColumn('invoice_name');
            }
            if (Schema::hasColumn('hotels', 'reservation_required')) {
                $table->dropColumn('reservation_required');
            }
            if (Schema::hasColumn('hotels', 'parking_location')) {
                $table->dropColumn('parking_location');
            }
            if (Schema::hasColumn('hotels', 'parking_type')) {
                $table->dropColumn('parking_type');
            }
            if (Schema::hasColumn('hotels', 'breakfast_served')) {
                $table->dropColumn('breakfast_served');
            }
            if (Schema::hasColumn('hotels', 'enter_amount')) {
                $table->dropColumn('enter_amount');
            }
            if (Schema::hasColumn('hotels', 'cuisine')) {
                $table->dropColumn('cuisine');
            }
            if (Schema::hasColumn('hotels', 'children_allowed')) {
                $table->dropColumn('children_allowed');
            }
            if (Schema::hasColumn('hotels', 'pets_allowed')) {
                $table->dropColumn('pets_allowed');
            }
            if (Schema::hasColumn('hotels', 'pan_no')) {
                $table->dropColumn('pan_no');
            }
            if (Schema::hasColumn('hotels', 'aadhar_no')) {
                $table->dropColumn('aadhar_no');
            }
            if (Schema::hasColumn('hotels', 'gst_no')) {
                $table->dropColumn('gst_no');
            }
            if (Schema::hasColumn('hotels', 'hotel_imgs')) {
                $table->dropColumn('hotel_imgs');
            }
            if (Schema::hasColumn('hotels', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
