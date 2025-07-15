<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\FrontControllers\PaymentController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\HotelReportController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BedTypeController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\FrontControllers\FrontController;
use App\Http\Controllers\RatePlanController;
use App\Http\Controllers\RoomCategoryController;
use App\Http\Controllers\SmtpSettingController;
use App\Http\Controllers\CampaignsController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\CustomerReviewController;
use App\Http\Controllers\FrontControllers\BookingController;
use App\Http\Controllers\RoomAvailabilityController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\BookingController as AdminBookingController;
use App\Http\Controllers\EmailHandlerController;
use App\Http\Controllers\GooglePlaceSearch;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LeadVendorController;
use App\Http\Controllers\RazorpayWebhookController;
use App\Http\Controllers\SEOAndRouteController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\HotelReviewController;
use App\Http\Controllers\SecretPageController;
use App\Http\Controllers\ServerKeyController;
use App\Http\Controllers\TaxCalculatorController;
use App\Http\Controllers\GmailCredentialController;


Route::get('/', [FrontController::class, 'index'])->name('home')->middleware('check_referral_booking');

route::get('email-view', function () {
    $booking = App\Models\Booking::with([
        'bookingContact',
        'transactions' => function ($query) {
            $query->where('status', 'captured');
        },
    ])->where('booking_id', 'BKG0000013')->first();

    return view('email.hottel.booking-pending', compact('booking'));
});

Route::post('/webhook/razorpay', [RazorpayWebhookController::class, 'handleWebhook']);

Route::get('auth/google', [AuthenticatedSessionController::class, 'signInwithGoogle'])->name('google.login');
Route::get('auth/google/callback', [AuthenticatedSessionController::class, 'callbackToGoogle']);
Route::get('/google-places-search', [GooglePlaceSearch::class, 'searchAjax'])->name('google-places.search-ajax');



Route::get('/send-email', [GmailCredentialController::class, 'showEmailForm'])->name('gmail.form');
Route::post('/send-email', [GmailCredentialController::class, 'sendEmail'])->name('gmail.send');
Route::get('/google/credentials', [GmailCredentialController::class, 'showForm'])->name('google.credentials.form');
Route::post('/google/credentials', [GmailCredentialController::class, 'saveCredentials'])->name('google.credentials.save');
Route::get('/google/callback', [GmailCredentialController::class, 'handleCallback']);

// Auth Routes
Route::middleware(['auth', 'restrict_user'])->group(function () {

    Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('superAdmin.dashboard');
    // Route::get('/reports', [SuperAdminController::class, 'index'])->name('superAdmin.dashboard');
    Route::match(['get', 'post'], '/dashboard/{section}', [SuperAdminController::class, 'dashboardSection'])->name('dashboard.section');

    // Feedback routes
    Route::prefix('feedback')->as('feedback.')->group(function () {
        Route::get('/review-form/{bookingId}', [FeedbackController::class, 'reviewForm'])->name('form');
        Route::post('/save', [FeedbackController::class, 'reviewFormStore'])->name('save');
    });

    Route::prefix('tax-calculator')->as('tax-calculator.')->group(function () {
        Route::get('/', [TaxCalculatorController::class, 'index'])->name('index');
        Route::get('/show/{id}', [TaxCalculatorController::class, 'show'])->name('show');
        Route::post('/save', [TaxCalculatorController::class, 'store'])->name('store');
        Route::delete('/delete/{id}', [TaxCalculatorController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('hotels')->group(function () {
        Route::get('/', [HotelController::class, 'index'])->name('hotel')->middleware('permission:Hotel-View');
        Route::get('/unique', [HotelController::class, 'uniqueHotel'])->name('hotel.unique');
        Route::post('/save', [HotelController::class, 'save'])->name('hotel.save');
        Route::post('/near-by-places', [HotelController::class, 'nearByPlaces'])->name('hotel.near_by_places');
        Route::post('/change/status', [HotelController::class, 'changeStatus'])->name('hotel.status.update');
        Route::post('/change/papular', [HotelController::class, 'changePapular'])->name('hotel.papular.update');
        Route::post('/change/recommended', [HotelController::class, 'changeRecommended'])->name('hotel.recommended.update');
        Route::post('/update-soldOut', [HotelController::class, 'updateSoldOut'])->name('hotel.updateSoldOut');

        Route::get('/details/{id}', [HotelController::class, 'viewDetails'])->name('hotel.view.details');
        Route::get('/image/add/form', [HotelController::class, 'addImageForm'])->name('hotel.add.image.form');
        Route::get('/add/image/{id}', [HotelController::class, 'addImage'])->name('hotel.add.image');
        Route::delete('/remove/{id}', [HotelController::class, 'removeHotel'])->name('hotel.remove');
        Route::any('/add/{id?}', [HotelController::class, 'create'])->name('hotel.add');

        Route::prefix('rooms')->group(function () {
            // hotel rooms route 
            Route::get('add/{hotelId}/{roomId?}', [RoomController::class, 'create'])->name('rooms.add');
            Route::post('save', [RoomController::class, 'save'])->name('room.save')->middleware('permission:Rooms-Add');
            Route::delete('delete/{id}', [RoomController::class, 'deleteRoom'])->name('delete.room')->middleware('permission:Rooms-Delete');
            Route::post('/update-status', [RoomController::class, 'updateStatus'])->name('rooms.updateStatus');
            Route::post('/update-soldout', [RoomController::class, 'updatesoldout'])->name('rooms.updateSoldout');

            // Hotel Availability
            Route::get('availability/{roomId}/{ratePlanId?}/', [RoomAvailabilityController::class, 'create'])->name('rooms.availability.create');
            Route::post('availability/save', [RoomAvailabilityController::class, 'store'])->name('rooms.availability.save');
            Route::get('{hotelId}', [RoomController::class, 'index'])->name('rooms')->middleware('permission:Rooms-View');
        });

        Route::prefix('review')->group(function () {
            Route::get('add/{hotelId?}/{hotelReviewId?}', [HotelReviewController::class, 'create'])->name('create.hotelReview');
            Route::post('save', [HotelReviewController::class, 'store'])->name('save.hotelReview');
            Route::delete('delete/{id?}', [HotelReviewController::class, 'deleteHotelReview'])->name('delete.review');
            Route::get('{hotelId?}', [HotelReviewController::class, 'index'])->name('hotelReview');
        });
        //Api key create url
        Route::get('/serverKey', [ServerKeyController::class, 'serverKey'])->name('serverkey.index');
        Route::post('/serverKey-save', [ServerKeyController::class, 'serverKeyStore'])->name('serverKey.store');
        Route::delete('/serverKey-delete/{id}', [ServerKeyController::class, 'delete'])->name('serverKey.delete');
    });

    Route::prefix('rooms')->group(function () {
        Route::post('/save', [RoomController::class, 'save'])->name('rooms.save')->middleware('permission:Rooms-Edit');
        route::post('/upload', [RoomController::class, 'upload'])->name('rooms.upload')->middleware('permission:Rooms-View');
        Route::post('/modify-room-availability', [RoomController::class, 'changeAvailability'])->name('modify.room.availability');
        Route::get('/modify-room/{id}', [RoomController::class, 'modifyRoom'])->name('modify.room');
        Route::delete('delete-image/{imageId?}', [RoomController::class, 'deleteImage'])->name('delete.roomImage');
        Route::get('delete-bed', [RoomController::class, 'deleteBed'])->name('delete.roomBed');
        Route::get('/room-type/unique', [RoomController::class, 'uniqueRoomType']);
    });

    Route::get('/unique/email', [HotelController::class, 'uniqueEmail'])->name('email.unique');

    Route::prefix('bed-type')->group(function () {
        Route::get('/', [BedTypeController::class, 'index'])->name('bedType');
        Route::get('/add/{id?}', [BedTypeController::class, 'create'])->name('add.bedType');
        Route::post('/save', [BedTypeController::class, 'store'])->name('save.bedType');
        Route::delete('/remove/{id}', [BedTypeController::class, 'destroy'])->name('bedType.destroy');
    });


    Route::prefix('amenities')->group(function () {
        Route::get('/', [AmenitiesController::class, 'listAmenities'])->name('list.amenities');
        Route::get('/save/{id?}', [AmenitiesController::class, 'save'])->name('amenities.save');
        Route::post('/add', [AmenitiesController::class, 'create'])->name('amenities.add');
        Route::delete('delete-amenity/{id}', [AmenitiesController::class, 'deleteAmenity'])->name('delete.amenity');
    });
    Route::prefix('hotelmanager')->group(function () {
        Route::get('/manager-dashboard', [ManagerController::class, 'dashboard'])->name('hotelmanager.dashboard');
        Route::get('/manager-index', [ManagerController::class, 'index'])->name('hotelmanager.index');
        Route::get('/details', [ManagerController::class, 'details'])->name('hotelmanager.details');
        Route::get('/edit', [ManagerController::class, 'edit'])->name('hotelmanager.edit');
        // Route to fetch data for the DataTable
        Route::get('managers/data', [ManagerController::class, 'data'])->name('managers.data');
        Route::get('managers/add_room', [ManagerController::class, 'add_room'])->name('hotelmanager.add_room');
    });

    Route::any('hotelroom/add/{id?}', [RoomController::class, 'hotelroom'])->name('hotelroom.add');

    Route::any('/hotel_report/index', [HotelReportController::class, 'index'])->name('hotel_report.index');

    Route::get('/customer-review/index', [CustomerReviewController::class, 'index'])->name('customer-review.index');

    Route::get('reservations/index', [ReservationController::class, 'index'])->name('reservations.index');
    Route::any('reservations/add/{id?}', [ReservationController::class, 'create'])->name('reservations.add');
    Route::any('reservations/details', [ReservationController::class, 'details'])->name('reservations.details');
    Route::post('reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::delete('reservations/cancel/{id}', [ReservationController::class, 'cancel'])->name('reservations.cancel');
    Route::get('reservations/update_payment_status/{type?}', [ReservationController::class, 'update_payment_status'])->name('reservations.update_payment_status');

    Route::prefix('promotion')->group(function () {
        Route::get('/', [PromotionController::class, 'index'])->name('promotion.index');
        Route::get('basic_deal/{type?}', [PromotionController::class, 'basic_deal'])->name('promotion.basic_deal');
        Route::post('save', [PromotionController::class, 'store'])->name('promotion.save');
        Route::post('promotion/pause/{id}', [PromotionController::class, 'pause'])->name('promotion.pause');
        Route::post('promotion/delete/{id}', [PromotionController::class, 'delete'])->name('promotion.delete');
    });

    Route::prefix('rate-plan')->group(function () {

        Route::get('index', [RatePlanController::class, 'index'])->name('ratePlan.index');
        Route::get('create/{hotelId?}/{roomType?}', [RatePlanController::class, 'create'])->name('ratePlan.create');
        Route::post('store', [RatePlanController::class, 'store'])->name('ratePlan.store');
        Route::post('change/status', [RatePlanController::class, 'updateStatus'])->name('ratePlan.changeStatus');
        Route::get('margin/{ratePlan}', [RatePlanController::class, 'margin'])->name('ratePlan.margin');
        Route::post('update/margin', [RatePlanController::class, 'updateMargin'])->name('ratePlan.update.margin');
        Route::delete('remove/{id}', [RatePlanController::class, 'destroy'])->name('ratePlan.remove');
        Route::post('room-type', [RatePlanController::class, 'roomType'])->name('get.room.type');
        Route::post('calendar-events', [RatePlanController::class, 'calendarEvents'])->name('ratePlan.calendar.events');
        Route::post('edit/{ratePlan?}', [RatePlanController::class, 'edit'])->name('ratePlan.edit');
        Route::post('update/{ratePlan?}', [RatePlanController::class, 'update'])->name('ratePlan.update');
        Route::get('extra-bed/{hotelId?}/{roomType?}', [RatePlanController::class, 'extraBed'])->name('extra.bed');
        Route::post('update-extra-bed-price', [RatePlanController::class, 'extraBedPriceUpdate'])->name('extraBedPrice.update');

        Route::get('show-extra-bed/{planId?}', [RatePlanController::class, 'showExtraBed'])->name('show.extra.bed');
        Route::post('update-single-extra-bed-price', [RatePlanController::class, 'singleExtraBedPriceUpdate'])->name('singleExtraBedPrice.update');
    });


    Route::prefix('sitemap')->group(function () {
        Route::get('index', [HotelController::class, 'sitemap'])->name('site.map');
        Route::get('generate', [HotelController::class, 'generateSitemap'])->name('generate.sitemap');
    });

    // leads routes
    Route::prefix('leads')->group(function () {
        // lead guest route
        Route::prefix('guest')->group(function () {
            Route::get('datatable/{bookingId}', [GuestController::class, 'guestDatatable'])->name('lead.guest.datatable');
            Route::get('index/{bookingId}/{guest?}', [GuestController::class, 'guestForm'])->name('lead.guest');
            Route::post('save', [GuestController::class, 'saveGuest'])->name('lead.guest.save');
        });

        // lead contact info route
        Route::prefix('contact-info')->group(function () {
            Route::get('index/{bookingId}/{contact?}', [GuestController::class, 'contactForm'])->name('lead.contact');
            Route::post('save', [GuestController::class, 'saveContact'])->name('lead.contact.save');
        });

        // leads transactions route
        Route::prefix('transactions')->group(function () {
            Route::get('datatable/{bookingId}', [TransactionsController::class, 'transactionsDatatable'])->name('lead.transactions.datatable');
            Route::get('index/{bookingId}/{payment?}', [TransactionsController::class, 'transactionsForm'])->name('lead.transactions');
            Route::post('save', [TransactionsController::class, 'saveTransaction'])->name('lead.transactions.save');
            Route::get('markup/{bookingId}', [TransactionsController::class, 'bookingMarkup'])->name('lead.transactions.markup');
            Route::delete('remove/{id}', [TransactionsController::class, 'destroy'])->name('lead.transaction.destroy');
            Route::get('capture-payment/{paymentId}', [TransactionsController::class, 'capturePayment'])->name('lead.transaction.capture');

            // vendor transactions
            Route::get('vendor/datatable/{bookingId}', [TransactionsController::class, 'vendorTransactionsDatatable'])->name('lead.vendor.transactions.datatable');
            Route::get('vendor/{bookingId}/{payment?}', [TransactionsController::class, 'vendorTransactionsForm'])->name('lead.vendor.transactions');
            Route::post('vendor/save', [TransactionsController::class, 'vendorTransactionsSave'])->name('lead.vendor.transactions.save');
        });

        //leads change hotel 
        Route::prefix('change')->group(function () {
            Route::get('hotel/{bookingId?}', [LeadController::class, 'changeHotel'])->name('leads.change.hotel');
            Route::get('hotel/rooms/{bookingId}/{selectedHotel?}', [LeadController::class, 'hotelRooms'])->name('leads.change.hotel.rooms');
            Route::get('rate-plan/{bookingId}', [LeadController::class, 'getRatePlans'])->name('leads.change.rate.plan');
            Route::get('recommend/hotel/{bookingId?}', [LeadController::class, 'recommendHotel'])->name('leads.recommend.hotel');
            Route::post('save/recommend/hotel', [LeadController::class, 'savedRecommendHotel'])->name('save.recommend.hotel');
        });

        // followup resource route
        Route::prefix('followup')->as('followup.')->group(function () {
            Route::get('create/{bookingId}/{followup?}', [FollowUpController::class, 'create'])->name('create');
            Route::delete('{followUp}', [FollowUpController::class, 'destroy'])->name('destroy');
            Route::post('/', [FollowUpController::class, 'store'])->name('store');
            Route::get('{bookingId}', [FollowUpController::class, 'index'])->name('index');
        });

        Route::get('/', [LeadController::class, 'index'])->name('lead.index')->middleware('permission:Lead-index');
        Route::get('search', [LeadController::class, 'search'])->name('lead.search');
        Route::delete('delete/{id}', [LeadController::class, 'delete'])->name('lead.delete');
        Route::delete('abandon/{id}', [LeadController::class, 'abandon'])->name('lead.abandon');
        Route::post('save-remarks', [LeadController::class, 'saveRemarks'])->name('save.remarks');
        Route::get('employee/{bookingId}', [LeadController::class, 'leadEmployee'])->name('lead.employee');
        Route::get('current-assigned', [LeadController::class, 'currentAssignedLeads'])->name('leads.current.assigned');
        Route::get('vendor/mail/{bookingId}', [LeadVendorController::class, 'vendorMail'])->name('lead.vendor.mail');
        Route::get('vendor/status/{bookingId}', [LeadVendorController::class, 'vendorStatus'])->name('lead.vendor.status');
        Route::get('details/{bookingId?}', [LeadController::class, 'leadDetail'])->name('lead.detail')->middleware('permission:Lead-view');
        Route::get('remarks/{bookingId}/{userId}', [LeadController::class, 'leadRemarks'])->name('lead.remarks');
    });

    Route::get('/email-preview/{bookingId}/{option}/', [EmailHandlerController::class, 'emailPreview'])->name('email.preview');
    Route::post('/email-send', [EmailHandlerController::class, 'emailSend'])->name('email.send');

    //lead models
    // Route::get('cancel/booking/status/{$bookingId}',[LeadController::class,'cancelBooking'])->name('cancel.booking');
    Route::get('cancel/{booking}/booking', [LeadController::class, 'cancelBooking'])->name('cancel.booking');
    Route::post('booking/cancel/save', [LeadController::class, 'cancelBookingSave'])->name('cancel.booking.save');
    Route::get('change-booking-date/{bookingId?}', [LeadController::class, 'changeBookingDate'])->name('change.booking.date');
    Route::get('change-booking-status/{bookingId}', [LeadController::class, 'changeBookingStatus'])->name('change.booking.status');
    Route::post('save-booking-status', [LeadController::class, 'saveBookingStatus'])->name('save.booking.status');
    Route::post('update-booking-date', [LeadController::class, 'updateBookingDate'])->name('update.booking.date');
    Route::post('change-room-hotel', [LeadController::class, 'changeRoomHotel'])->name('save.change.room.hotel');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('settings')->group(function () {
        Route::get('index', [SettingController::class, 'settingsIndex'])->name('settings.index')->middleware('permission:Settings');
        Route::get('general', [SettingController::class, 'settingsGeneral'])->name('settings.general');
        Route::post('general', [SettingController::class, 'updateProfileInfo'])->name('settings.general.store');
        Route::post('remove-file ', [SettingController::class, 'remove_avatar'])->name('settings.remove.avatar');
        Route::post('change-password', [SettingController::class, 'changePassword'])->name('settings.change_password');
        // business settings 
        Route::get('financial-info', [SettingController::class, 'financialInfo'])->name('settings.financial-info');
        Route::post('financial-info-update', [SettingController::class, 'financialInfoUpdate'])->name('settings.financial-info-update');
        Route::post('address', [SettingController::class, 'updateBusinessAddress'])->name('settings.updateBusinessAddress');
        Route::post('bank-details', [SettingController::class, 'updateBankDetails'])->name('settings.bank_details');
        // Company settings Created by Arpit
        Route::get('company-settings', [SettingController::class, 'CompanyInfo'])->name('settings.company-setting');
        Route::get('add-company/{id?}', [SettingController::class, 'addCompany'])->name('settings.add-company');
        Route::post('add-company/{id?}', [SettingController::class, 'apiSettingStore'])->name('settings.api-settings-save');
        Route::post('api/generate', [SettingController::class, 'generateApi'])->name('settings.api-generate');
        // Invoice Settings
        Route::get('invoice', [SettingController::class, 'invoiceSettings'])->name('settings.invoice');
        Route::post('invoice-layout', [SettingController::class, 'invoiceLayout'])->name('settings.invoice.layout');
        Route::post('invoice-tax', [SettingController::class, 'addOrUpdateTax'])->name('settings.invoice.tax');
        Route::get('getTaxes', [SettingController::class, 'getTaxes'])->name('settings.invoice.getTaxes');
        Route::delete('deleteTaxes', [SettingController::class, 'deleteTaxes'])->name('settings.invoice.deleteTaxes');
        Route::post('currency', [SettingController::class, 'update_currency'])->name('settings.invoice.currency');
        // Payment Gateways
        Route::get('payment-gateways', [SettingController::class, 'payment_gateways'])->name('settings.payment-gateways');
        Route::post('payment-gateways/store', [SettingController::class, 'updateGateway'])->name('settings.payment-gateway');
        Route::post('payment/paypal', [SettingController::class, 'updatePaypal'])->name('settings.gateway.paypal');
        Route::post('payment/stripe', [SettingController::class, 'updateStipe'])->name('settings.invoice.stripe');
        Route::post('payment/razorpay', [SettingController::class, 'updateRazorpay'])->name('settings.invoice.razorpay');
        // Email Settings
        Route::get('email', [SettingController::class, 'emailSettings'])->name('settings.emails');
        Route::post('email/update', [SettingController::class, 'updateEmails'])->name('settings.emails.update');

        Route::get('smtp', [SmtpSettingController::class, 'smtpSettings'])->name('settings.smtp');
        Route::post('smtp/update', [SmtpSettingController::class, 'updateSmtp'])->name('settings.updateSmtp');

        Route::post('/aws/update', [SmtpSettingController::class, 'updateAws'])->name('settings.updateAws');
        Route::get('google/login', [SettingController::class, 'googleLogin'])->name('google.login.form');
        Route::post('google/login', [SettingController::class, 'googleLoginSave'])->name('save.google.login');


        //user
        Route::resource('roles', RoleController::class);

        Route::get('city', [CityController::class, 'city'])->name('list.city');
        Route::get('save/{id?}', [CityController::class, 'save'])->name('add.city');
        Route::post('add', [CityController::class, 'create'])->name('save.city');
        Route::delete('delete-city/{id}', [CityController::class, 'deleteCity'])->name('delete.city');
        Route::post('/update-status', [CityController::class, 'updateStatus'])->name('update.city.status');


        Route::get('room-category', [RoomCategoryController::class, 'roomCategory'])->name('list.room_category');
        Route::get('save-room-category/{id?}', [RoomCategoryController::class, 'saveRoomCategory'])->name('add.room_category');
        Route::post('add-room-category', [RoomCategoryController::class, 'createRoomCategory'])->name('save.room_category');
        Route::post('room/category/status', [RoomCategoryController::class, 'changeStatus'])->name('room.category.changeStatus');

        Route::delete('delete-room-category/{id}', [RoomCategoryController::class, 'deleteRoomCategory'])->name('delete.room_category');

        Route::get('campaigns/index', [CampaignsController::class, 'index'])->name('campaigns.index');
        Route::get('campaigns/basic_deal', [CampaignsController::class, 'basic_deal'])->name('campaigns.basic_deal');
        Route::get('campaigns/pause/{id}', [CampaignsController::class, 'pause'])->name('campaigns.pause');
        Route::post('campaigns/delete/{id}', [CampaignsController::class, 'delete'])->name('campaigns.delete');
    });

    Route::prefix('users')->group(function () {
        Route::get('index', [UserController::class, 'index'])->name('users.index')->middleware('permission:User-View');
        Route::get('create', [UserController::class, 'create'])->name('users.create');
        Route::post('store', [UserController::class, 'store'])->name('users.store');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::put('update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::post('update-status', [UserController::class, 'updateStatus'])->name('users.updateStatus');
        Route::get('status', [SettingController::class, 'index'])->name('status.index');
        Route::get('status/create', [SettingController::class, 'create'])->name('status.create');
        Route::post('status', [SettingController::class, 'store'])->name('status.store');
        Route::get('status/{id}/edit', [SettingController::class, 'edit'])->name('status.edit');
        Route::post('update/{id}', [SettingController::class, 'update'])->name('status.update');
        Route::delete('status/{id}', [SettingController::class, 'destroy'])->name('status.destroy');
    });

    Route::get('/banks', [BankController::class, 'index'])->name('banks.index');
    Route::get('/add/{id?}', [BankController::class, 'create'])->name('banks.add');
    Route::post('/banks', [BankController::class, 'store'])->name('banks.store');
    Route::put('/banks/{id}', [BankController::class, 'update'])->name('banks.update');
    Route::delete('/banks/{id}', [BankController::class, 'destroy'])->name('banks.destroy');

    //update status
    Route::post('change/status/{id}', [SettingController::class, 'changeStatus'])->name('ChangeStatus');

    Route::prefix('booking')->group(function () {
        Route::get('index', [AdminBookingController::class, 'index'])->name('booking.index');
    });

    Route::prefix('transactions')->group(function () {
        Route::get('/client', [TransactionsController::class, 'clientTransactions'])->name('transactions.index')->middleware('permission:Client-Transaction-View');
        Route::post('/client/datatable', [TransactionsController::class, 'clientTransactionsDataTable'])->name('transactions.datatable')->middleware('permission:Client-Transaction-View');
        Route::get('/vendor', [TransactionsController::class, 'vendorTransactions'])->name('transactions.vendor')->middleware('permission:Vendor-Transaction-View');
        Route::post('/vendor/total-paid', [TransactionsController::class, 'vendorTotalPaid'])->name('transactions.vendor.total_paid');
    });

    // Coupon Routes
    Route::prefix('coupons')->as('coupons.')->group(function () {
        Route::get('/', [CouponsController::class, 'index'])->name('index')->middleware('permission:Coupon-View');
        Route::get('/create', [CouponsController::class, 'create'])->name('create')->middleware('permission:Coupon-Add');
        Route::post('/', [CouponsController::class, 'store'])->name('store')->middleware('permission:Coupon-Add');
        Route::get('/{coupons}/edit', [CouponsController::class, 'edit'])->name('edit')->middleware('permission:Coupon-Edit');
        Route::put('/{coupons}', [CouponsController::class, 'update'])->name('update')->middleware('permission:Coupon-Edit');
        Route::delete('/delete/{coupons}', [CouponsController::class, 'destroy'])->name('destroy')->middleware('permission:Coupon-Delete');
        Route::post('check-duplicate', [CouponsController::class, 'check_duplicate'])->name('check');
        Route::post('get-options', [CouponsController::class, 'getOptions'])->name('get_options');
    });

    // SEO & Routes
    route::prefix('seo-and-routes-settings')->group(function () {
        Route::get('/', [SEOAndRouteController::class, 'index'])->name('seo.routes.index')->middleware('permission:SEO-View');
        Route::get('/{id}/form', [SEOAndRouteController::class, 'form'])->name('seo.routes.form')->middleware('permission:SEO-Add');
        Route::post('/store', [SEOAndRouteController::class, 'store'])->name('seo.routes.store')->middleware('permission:SEO-Add');
        Route::delete('/delete/{id}', [SEOAndRouteController::class, 'delete'])->name('seo.routes.delete')->middleware('permission:SEO-Delete');
    });

    require __DIR__ . '/referral.php';

    Route::get('/download-tax-invoice/{bookingId}', [BookingController::class, 'downloadTaxInvoice'])->name('download.tax.invoice');
});
// end auth routes

Route::middleware('auth')->group(function () {
    // frontend routes
    Route::get('manage-booking/{bookingId?}', [BookingController::class, 'manageBooking'])->name('manage.booking');
    Route::get('/download-invoice/{bookingId?}', [BookingController::class, 'downloadInvoice'])->name('download.invoice');

    // frontend profile route
    Route::get('user-profile', [ProfileController::class, 'userProfile'])->name('user.profile');
    Route::post('update-profile', [ProfileController::class, 'UpdateProfile'])->name('update.profile');
    Route::post('update-password', [ProfileController::class, 'updatePassword'])->name('update.password');

    Route::get('delete-coTraveler/{id?}', [ProfileController::class, 'deleteCoTraveler'])->name('delete.cotraveler');
    Route::get('traveler-details/{id?}', [ProfileController::class, 'travelerDetails'])->name('traveler.details');
    // end frontend route
});

Route::get('terms-and-conditions/', [FrontController::class, 'termsAndCondition'])->name('terms-and-conditions');
Route::get('cancellation-policy/', [FrontController::class, 'cancellingAndRefund'])->name('cancellation-policy');
Route::get('privacy-policy/', [FrontController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('contact-us/', [FrontController::class, 'contactUs'])->name('contact-us');
Route::get('consult-now/', [FrontController::class, 'consultNow'])->name('consult-now');
Route::get('faq/', [FrontController::class, 'faq'])->name('faq');

Route::get('search-room', [FrontController::class, 'searchRoom'])->name('search.room');
Route::get('hotel-list-consult-now', [frontController::class, 'hotelListForConsultNow'])->name('hotel.list.consult.now');

Route::get('add-details/{hotelId?}/{roomId?}/{roomTypeId?}/{searchId?}', [FrontController::class, 'addDetails'])->name('hotel.addDetails')->middleware('check_referral_booking');

Route::match(['get', 'post'], 'add-details-multiple-room', [FrontController::class, 'addBookingMultiple'])->name('add_booking_multiple');

Route::post('add-booking', [BookingController::class, 'addBookingDetails'])->name('add_booking.details');

Route::post('add-booking-multiple', [BookingController::class, 'addBookingMultipleDetails'])->name('add_booking_multiple.details');
Route::post('add-consult-now', [BookingController::class, 'addConsultNow'])->name('add_consult_now.details');

Route::get('make-payment/{bookingId?}', [BookingController::class, 'makePayment'])->name('add.paymentPage');
Route::post('apply-coupon', [BookingController::class, 'applyCoupon'])->name('apply.coupon');
Route::post('order-create', [PaymentController::class, 'orderCreate'])->name('order.create');

Route::post('payment-callback', [PaymentController::class, 'paymentCallBack'])->name('payment.callback');

Route::get('hotel-details/{slug}/{searchId?}', [FrontController::class, 'hotelDetails'])->name('hotel.details')->middleware('check_referral_booking');
require __DIR__ . '/auth.php';

Route::get('/hotel-data/{id?}', [SecretPageController::class, 'index'])->name('secret.page');

Route::get('hotel-data-list', [SecretPageController::class, 'dataList'])->name('secret.page.list');

Route::post('/save/hotel-data', [SecretPageController::class, 'store'])->name('secret.page.store');
Route::get('/page/unlock', [SecretPageController::class, 'unlock'])->name('secret.page.unlock');
Route::post('/page/unlock', [SecretPageController::class, 'unlockPage'])->name('page.unlock');
Route::get('external-hotels', [SecretPageController::class, 'hotels'])->name('external.hotels');
Route::delete('remove-external-hotels/{id}', [SecretPageController::class, 'delete'])->name('remove.external.hotels');


Route::match(['get', 'post'], 'hotels-in-{city?}/', [FrontController::class, 'searchResult'])->name('searchResultCity')->middleware('check_referral_booking');
Route::match(['get', 'post'], '{rating?}-star-hotels-in-{city?}/', [FrontController::class, 'searchResult'])->name('searchResult')->middleware('check_referral_booking');
