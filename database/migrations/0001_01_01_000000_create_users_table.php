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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
                $table->string('name');
                $table->string('username')->nullable();
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->dateTime('last_login_at')->nullable();
                $table->string('password')->nullable();
                $table->text('avatar')->nullable();

                $table->string('business_name')->nullable();
                $table->text('business_logo')->nullable();
                $table->text('stemp_image')->nullable();
                $table->text('business_site')->nullable();
                $table->string('phone')->nullable();

                $table->text('address_1')->nullable();
                $table->text('address_2')->nullable();
                $table->string('city')->nullable();
                $table->string('postcode')->nullable();
                $table->string('state')->nullable();
                $table->string('country')->default('IN');

                $table->date('business_registration_date')->nullable();
                $table->text('business_description')->nullable();
                $table->string('business_category')->nullable();

                $table->bigInteger('aadhar_number')->nullable();
                $table->string('user_aadharcard_file')->nullable();

                //todo: make json for all these numbers
                $table->string('pan_number')->nullable();
                $table->string('user_pancard_file')->nullable();
                $table->string('user_client_mast_report_file')->nullable();
                $table->text('moa')->nullable();
                $table->text('aoa')->nullable();
                $table->string('other_pancard')->nullable();
                $table->string('user_business_pancard_file')->nullable();

                $table->string('gst_number')->nullable();
                $table->string('sac_code')->nullable();
                $table->string('cin_number')->nullable();
                $table->string('gst_text')->default('GST Number')->nullable();
                $table->string('pan_text')->default('PAN Number')->nullable();
                $table->string('sac_text')->default('SAC Code')->nullable();
                $table->string('cin_text')->default('CIN Number')->nullable();
                $table->boolean('show_gst')->default(false);
                $table->boolean('show_pan')->default(false);
                $table->boolean('show_sac')->default(false);
                $table->boolean('show_cin')->default(false);

                $table->json('invoice_settings')->nullable();// layout, taxes, currency.
                $table->json('payment_gateways')->nullable(); // gateway api keys etc
                $table->json('email_settings')->nullable();  // templates, smtp details (in future)

                $table->string('reference')->default('hottel.in');

                $table->boolean('registration_complete')->default(false);

                $table->json('bank_details')->nullable();
                $table->string('timezone')->default('Asia/Calcutta');

                $table->boolean('status')->default(true);
                $table->boolean('is_admin')->default(false);
                $table->integer('admin_verified')->default(0);
                $table->dateTime('notification_video')->nullable();
                $table->string('register_ip')->nullable();
                $table->string('registeration_country')->nullable();
                $table->integer('wrong_document')->default(0);
                $table->integer('partner_portal_id')->nullable();
                $table->text('broker_profile')->nullable();
                $table->text('broker_crm_document')->nullable();
                $table->text('broker_pancard_document')->nullable();
                $table->text('broker_agreement')->nullable();
                $table->text('broker_cancelled_cheque')->nullable();
                $table->string('broker_business')->nullable();
                $table->text('broker_upload_certificate_copy')->nullable();
                $table->string('broker_gst_compliant')->nullable();
                $table->string('broker_affiliate_code')->nullable();
                $table->text('broker_upload_declaration')->nullable();
                $table->integer('client_id')->nullable();
                $table->boolean('office_location')->default(true);

                $table->rememberToken();
                $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
