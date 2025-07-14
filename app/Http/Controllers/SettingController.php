<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\DataTables\StatusDataTable;
use App\Models\AdminSettings;
use App\Models\User;
use App\Models\CompanyMaster;
use App\Models\GoogleLoginSettings;
use App\Rules\Domain;
use App\Rules\GSTNumber;
use App\Modules\Payments\Paypal;
use App\Models\Status;

class SettingController extends Controller
{
    public function settingsIndex()
    {
        return view('settings.index');
    }

    public function settingsGeneral()
    {
        $data['user'] = User::find(Auth::user()->id);
        $data['countries'] = config('data.countries');
        addVendors(['jquery-validate']);
        return view('settings.general', $data);
    }

    public function updateProfileInfo(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'avatar' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:4096' //allow 4mb
        ]);

        $user = User::find(Auth::user()->id);

        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->country = $request->country;
        $user->state = $request->state;
        $user->address_1 = $request->address_1;
        $user->address_2 = $request->address_2;
        $user->city = $request->city;
        $user->postcode = $request->postcode;

        if ($request->hasFile('avatar')) {
            if (!empty($user->avatar) && is_file(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }
            $fileName = $user->name . '-avatar-' . time();
            $fileName = sanitize_filename($fileName) . '.' . $request->avatar->extension();
            $request->file('avatar')->storeAs('user_avatar', $fileName, 'public');
            $user->avatar = strtolower($fileName);
        }

        $user->timezone = $request->input('timezone');
        $user->save();

        return response()->json(['status' => '200', 'message' => 'Information saved successfully']);
    }

    public function getStates(Request $request, $id)
    {
        $states = config('data.states')[$id] ?? null;
        $options = '<option value="">Select an option</option>';
        if (!empty($states)) {
            foreach ($states as $state) {
                if (!empty($state)) {
                    $options .= '<option>' . $state . '</option>';
                }
            }
            echo $options;
        }
    }

    public function remove_avatar(Request $request)
    {
        $id = $request->id;
        $file_name = $request->file;
        $col_name = $request->col;
        $table_name = $request->table;
        if (str_contains($file_name, 'storage')) {
            if (is_file(public_path($file_name))) {
                unlink(public_path($file_name));
            }
        } else {
            if (is_file(public_storage_path($file_name))) {
                unlink(public_storage_path($file_name));
            }
        }

        $sql = "UPDATE $table_name SET $col_name = NULL WHERE id = :id";
        DB::statement($sql, ['id' => $id]);

        return response()->json(['status' => '200', 'message' => 'File removed successfully']);
    }

    public function changePassword(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'current_password' => 'required|min:8|string',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors(), 'msg' => array_values($validator->errors()->toArray())[0][0]], 422);
        }

        $user = User::find(Auth::user()->id);

        if (Hash::check($request->input('current_password'), $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['status' => '200', 'message' => 'Password changed successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Invalid current password. Please retry'], 403);
        }
    }

    public function financialInfo()
    {
        addVendors(['jquery-validate', 'settings', 'business-settings']);

        return view('settings.financial-info', [
            'title' => 'Business Settings',
            'user' => auth()->user(),
            'countries' => config('data.countries'),
        ]);
    }

    public function financialInfoUpdate(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'business_name' => 'required|string',
            'business_logo' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:4096', //allow 4mb
            'business_site' => ['nullable', new Domain],
            'gst_number' => ['nullable', new GSTNumber],
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors(), 'msg' => array_values($validator->errors()->toArray())[0][0]], 422);
        }

        $user = User::find(Auth::user()->id);

        $user->business_name = $request->business_name;
        $user->business_site = $request->business_site;
        $user->phone = $request->phone;

        if ($request->hasFile('business_logo')) {
            if (!empty($user->business_logo) && is_file(public_storage_path($user->business_logo))) {
                unlink(public_storage_path($user->business_logo));
            }
            $business_logo = $user->business_name . '-logo-' . time();
            $business_logo = sanitize_filename($business_logo) . '.' . $request->business_logo->extension();
            $business_logo_path = $request->file('business_logo')->storeAs('business-logos/' . $user->id, $business_logo, 'public');
            $user->business_logo = '/' . $business_logo_path;
        }

        $user->pan_number = $request->pan_number;
        $user->gst_number = $request->gst_number;
        $user->cin_number = $request->cin_number;


        $user->show_gst = $request->show_gst == 'on' ? 1 : 0;
        $user->show_pan = $request->show_pan == 'on' ? 1 : 0;
        $user->show_cin = $request->show_cin == 'on' ? 1 : 0;


        $user->gst_text = $request->gst_text;
        $user->pan_text = $request->pan_text;
        $user->cin_text = $request->cin_text;

        if (Auth::user()->role == 'broker') {
            $user->broker_business = $request->broker_business ?? null;
            $user->broker_gst_compliant = $request->broker_gst_compliant ?? null;

            if ($request->hasFile('broker_crm_document')) {
                if (!empty($user->broker_crm_document) && is_file(public_storage_path('/broker_crm_document/' . $user->broker_crm_document))) {
                    unlink(public_storage_path('/broker_crm_document/' . $user->broker_crm_document));
                }
                $broker_crm_document = $user->name . '-broker_crm_document-' . time();
                $broker_crm_document = sanitize_filename($broker_crm_document) . '.' . $request->broker_crm_document->extension();
                $broker_crm_document_path = $request->file('broker_crm_document')->storeAs('broker_crm_document', $broker_crm_document, 'public');
                $user->broker_crm_document = $broker_crm_document;
            }

            if ($request->hasFile('broker_pancard_document')) {
                if (!empty($user->broker_pancard_document) && is_file(public_storage_path('/broker_pancard_document/' . $user->broker_pancard_document))) {
                    unlink(public_storage_path('/broker_pancard_document/' . $user->broker_pancard_document));
                }
                $broker_pancard_document = $user->name . '-broker_pancard_document-' . time();
                $broker_pancard_document = sanitize_filename($broker_pancard_document) . '.' . $request->broker_pancard_document->extension();
                $broker_pancard_document_path = $request->file('broker_pancard_document')->storeAs('broker_pancard_document', $broker_pancard_document, 'public');
                $user->broker_pancard_document = $broker_pancard_document;
            }

            if ($request->hasFile('broker_cancelled_cheque')) {
                if (!empty($user->broker_cancelled_cheque) && is_file(public_storage_path('/broker_cancelled_cheque/' . $user->broker_cancelled_cheque))) {
                    unlink(public_storage_path('/broker_cancelled_cheque/' . $user->broker_cancelled_cheque));
                }
                $broker_cancelled_cheque = $user->name . '-broker_cancelled_cheque-' . time();
                $broker_cancelled_cheque = sanitize_filename($broker_cancelled_cheque) . '.' . $request->broker_cancelled_cheque->extension();
                $broker_cancelled_cheque_path = $request->file('broker_cancelled_cheque')->storeAs('broker_cancelled_cheque', $broker_cancelled_cheque, 'public');
                $user->broker_cancelled_cheque = $broker_cancelled_cheque;
            }

            if ($request->hasFile('broker_upload_certificate_copy')) {
                if (!empty($user->broker_upload_certificate_copy) && is_file(public_storage_path('/broker_cancelled_cheque/' . $user->broker_upload_certificate_copy))) {
                    unlink(public_storage_path('/broker_cancelled_cheque/' . $user->broker_upload_certificate_copy));
                }
                $broker_upload_certificate_copy = $user->name . '-broker_upload_certificate_copy-' . time();
                $broker_upload_certificate_copy = sanitize_filename($broker_upload_certificate_copy) . '.' . $request->broker_upload_certificate_copy->extension();
                $broker_upload_certificate_copy_path = $request->file('broker_upload_certificate_copy')->storeAs('broker_upload_certificate_copy', $broker_upload_certificate_copy, 'public');
                $user->broker_upload_certificate_copy = $broker_upload_certificate_copy;
            }

            if ($request->hasFile('broker_upload_declaration')) {
                if (!empty($user->broker_upload_declaration) && is_file(public_storage_path('/broker_cancelled_cheque/' . $user->broker_upload_declaration))) {
                    unlink(public_storage_path('/broker_cancelled_cheque/' . $user->broker_upload_declaration));
                }
                $broker_upload_declaration = $user->name . '-broker_upload_declaration-' . time();
                $broker_upload_declaration = sanitize_filename($broker_upload_declaration) . '.' . $request->broker_upload_declaration->extension();
                $broker_upload_declaration_path = $request->file('broker_upload_declaration')->storeAs('broker_upload_declaration', $broker_upload_declaration, 'public');
                $user->broker_upload_declaration = $broker_upload_declaration;
            }

            if ($request->hasFile('broker_stamp')) {
                if (!empty($user->broker_stamp) && is_file(public_storage_path('/broker_stamp/' . $user->broker_stamp))) {
                    unlink(public_storage_path('/broker_stamp/' . $user->broker_stamp));
                }
                $broker_stamp = $user->name . '-broker_stamp-' . time();
                $broker_stamp = sanitize_filename($broker_stamp) . '.' . $request->broker_stamp->extension();
                $broker_upload_broker_stamp_path = $request->file('broker_stamp')->storeAs('broker_stamp', $broker_stamp, 'public');
                $user->broker_stamp = $broker_stamp;
            }

            if ($request->hasFile('broker_agreement')) {
                if (!empty($user->broker_agreement) && is_file(public_storage_path($user->broker_agreement))) {
                    unlink(public_storage_path($user->broker_agreement));
                }
                $broker_agreement = $user->name . '-broker_agreement-' . time();
                $broker_agreement = sanitize_filename($broker_agreement) . '.' . $request->broker_agreement->extension();
                $broker_agreement_path = $request->file('broker_agreement')->storeAs('broker_agreement', $broker_agreement, 'public');
                $user->broker_agreement = $broker_agreement;
            }
        }

        $user->save();

        return response()->json(['status' => '200', 'message' => 'Information saved successfully']);
    }

    public function updateBusinessAddress(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'address_1' => 'required|string',
            'address_2' => 'required|string',
            'city' => 'required|string',
            'postcode' => 'required|integer',
            'state' => 'required|string',
            'country' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors(), 'msg' => array_values($validator->errors()->toArray())[0][0]], 422);
        }

        $user = User::find(Auth::user()->id);
        $user->address_1 = $request->address_1;
        $user->address_2 = $request->address_2;
        $user->city = $request->city;
        $user->postcode = $request->postcode;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->save();

        return response()->json(['status' => '200', 'message' => 'Information saved successfully']);
    }

    public function updateBankDetails(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $input = $request->all();
        if (!empty($input['show'])) {
            foreach ($input['show'] as $key => $value) {
                $input['show'][$key] = $value == 'on' ? true : false;
            }
        } else {
            $input['show'] = [];
        }

        $user->bank_details = $input;
        $user->save();

        return response()->json(['status' => '200', 'message' => 'Information saved successfully']);
    }

    public function invoiceSettings()
    {
        addVendors(['jquery-validate']);
        $adminsetting = AdminSettings::orderby('created_at', 'desc')->first();
        return view('settings.invoices', compact('adminsetting'));
    }

    public function invoiceLayout(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'invoice_number_format' => 'in:custom,random_number,random_string,monthly',
            'number_length' => 'nullable|integer|min:6|max:15',
            'str_length' => 'nullable|integer|min:6|max:15',
            'str_number_increment' => 'nullable|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors(), 'msg' => array_values($validator->errors()->toArray())[0][0]], 422);
        }

        $adminsetting = AdminSettings::orderBy('created_at', 'desc')->first();
        if (!$adminsetting) {
            $adminsetting = new AdminSettings();
        }
        $old_invoice_settings = $adminsetting->invoice_settings;

        switch ($request->invoice_number_format) {
            case 'custom':
                $request->validate([
                    'str_number_increment' => 'required',
                    'str_number' => 'required'
                ]);

                if (!preg_match("/\d+$/U", $request->input('str_number'), $result)) {
                    $error = \Illuminate\Validation\ValidationException::withMessages([
                        'str_number' => ['number not found at the end of str_number'],
                    ]);
                    throw $error;
                }
                break;
            case 'random_number':
                $request->validate([
                    'number_length' => 'required'
                ]);
                break;
            case 'random_string':
                $request->validate([
                    'str_length' => 'required'
                ]);
                break;
        }


        $old_invoice_settings['company_info_position'] = $request->company_info_position == 'on' ? 'right' : 'left';
        $old_invoice_settings['invoice_number_format'] = [
            'format' => $request->invoice_number_format,
            'number_length' => $request->number_length ?? $old_invoice_settings['invoice_number_format']['number_length'] ?? null, //for random number
            'str_length' => $request->str_length ??  $old_invoice_settings['invoice_number_format']['str_length'] ?? null,  // for random string
            'str_number' => $request->str_number ??  $old_invoice_settings['invoice_number_format']['str_number'] ?? null, // for string & number combination
            'str_number_increment' => $request->str_number_increment ??  $old_invoice_settings['invoice_number_format']['str_number_increment'] ?? null,  // for string & number combination
        ];

        $adminsetting->sac_code = $request->sac_code;
        $adminsetting->sac_text = $request->sac_text;
        $adminsetting->show_sac = $request->show_sac == 'on' ? 1 : 0;

        $adminsetting->invoice_settings = $old_invoice_settings;

        if ($request->hasFile('stemp_image')) {
            if (!empty($adminsetting->stemp_image) && is_file(public_storage_path('/stemp_image/' . auth()->user()->id . '/' . $adminsetting->stemp_image))) {
                unlink(public_storage_path('/stemp_image/' . auth()->user()->id . '/' . $adminsetting->stemp_image));
            }
            $stemp_image = '-stemp_image-' . time();
            $stemp_image = sanitize_filename($stemp_image) . '.' . $request->stemp_image->extension();
            $stemp_image_path = $request->file('stemp_image')->storeAs('stemp_image/' . auth()->user()->id, $stemp_image, 'public');
            $adminsetting->stemp_image = $stemp_image;
        }

        if (isset($request->logo_remove)) {
            $adminsetting->stemp_image = null;
        }
        $adminsetting->save();
        return response()->json(['status' => '200', 'message' => 'Information saved successfully']);
    }

    public function addOrUpdateTax(Request $request)
    {
        $request->validate([
            'tax_name' => 'required|string',
            'tax_percent' => 'required|numeric|min:0|max:100'
        ]);
        $adminsetting = AdminSettings::orderBy('created_at', 'desc')->first();
        $user = $adminsetting;
        $old_invoice_settings = $user->invoice_settings;


        $old_invoice_settings['taxes'][((int) $request->input('tax_order'))] = [
            'name' => $request->input('tax_name'),
            'percent' => $request->input('tax_percent')
        ];


        $user->invoice_settings = $old_invoice_settings;
        $user->save();

        return response()->json($old_invoice_settings['taxes']);
    }

    public function getTaxes()
    {
        $adminsetting = AdminSettings::orderBy('created_at', 'desc')->first();
        return response()->json($adminsetting->invoice_settings['taxes'] ?? null);
    }

    public function deleteTaxes(Request $request)
    {
        $user = AdminSettings::orderBy('created_at', 'desc')->first();;
        $invoice_settings = $user->invoice_settings;

        unset($invoice_settings['taxes'][(int) $request->input('id')]);
        $invoice_settings['taxes'] = array_values($invoice_settings['taxes']);

        $user->invoice_settings = $invoice_settings;
        $user->save();

        return response()->json($invoice_settings['taxes']);
    }

    public function update_currency(Request $request)
    {
        $request->validate([
            'currency' => Rule::in(array_keys(config('data.currencies')))
        ]);
        $adminsetting = AdminSettings::orderBy('created_at', 'desc')->first();

        $user = $adminsetting;
        $invoice_settings =  $user->invoice_settings;
        $invoice_settings['currency'] = $request->currency;
        $user->invoice_settings = $invoice_settings;
        $user->save();

        return response()->json(['status' => 200, 'message' => 'Currency updated successfully']);
    }

    public function payment_gateways()
    {
        addVendors(['jquery-validate']);
        $adminsetting = AdminSettings::latest()->first();
        return view('settings.payment_gateways', compact('adminsetting'));
    }

    public function updateGateway(Request $request)
    {
        $adminsetting = AdminSettings::orderBy('created_at', 'desc')->first() ?? new AdminSettings;
        $user =  $adminsetting;
        $payment_gateways = $user->payment_gateways;
        foreach (config('data.payment_gateways') as $gateway) {
            if ($request->$gateway  == 'on') {
                if (isset($payment_gateways[$gateway]['mode'])) {
                    //settings exist
                    $payment_gateways[$gateway]['enabled'] = true;
                } else {
                    $error = \Illuminate\Validation\ValidationException::withMessages([
                        '' . $gateway => ['Please enter keys for ' . $gateway . ' first.'],
                    ]);
                    throw $error;
                }
            } else {
                if (isset($user->payment_gateways[$gateway]['mode'])) {
                    //settings exist
                    $payment_gateways[$gateway]['enabled'] = false;
                }
            }
        }
        $user->payment_gateways = $payment_gateways;
        $user->save();

        return response()->json(['status' => 200, 'message' => 'Gateway updated successfully']);
    }

    public function updatePaypal(Request $request)
    {
        $request->validate([
            'mode' => 'in:sandbox,live',
            'username' => 'required',
            'password' => 'required',
            'api_signature_key' => 'required'
        ]);

        $adminsetting = AdminSettings::orderBy('created_at', 'desc')->first();

        if (request('mode') == 'sandbox') {
            $paypal_id = $request->input('username');
            $password = $request->input('password');
            $api_signature_key = $request->input('api_signature_key');
            $paypal_api_url = 'https://api-3t.sandbox.paypal.com/nvp';
            $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        } else {
            $paypal_id = $request->input('username');
            $password = $request->input('password');
            $api_signature_key = $request->input('api_signature_key');
            $paypal_api_url = 'https://api-3t.paypal.com/nvp';
            $paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
        }

        //create temporary transaction to test credentials
        $paypal = new Paypal($paypal_id, $password, $api_signature_key, $paypal_api_url); // Paypal listener for the Paypal
        $custom = serialize(array('user_id' => Auth::id()));
        $item = array(
            'METHOD' => 'SetExpressCheckout',
            'PAYMENTREQUEST_0_PAYMENTACTION' => 'SALE',
            'PAYMENTREQUEST_0_CUSTOM' => $custom,
            'PAYMENTREQUEST_CURRENCYCODE' => (isset($currency_arr[0]) && !empty($currency_arr[0])) ? $currency_arr[0] : 'USD',
            'PAYMENTREQUEST_0_CURRENCYCODE' => (isset($currency_arr[0]) && !empty($currency_arr[0])) ? $currency_arr[0] : 'USD',
            'PAYMENTREQUEST_0_AMT' => '4.00',
            'L_PAYMENTREQUEST_0_NAME0' => '24invoice_id',
            'L_PAYMENTREQUEST_0_AMT0' => '4.00',
            'RETURNURL' => 'http://invoice.work/return',
            'CANCELURL' => 'http://invoice.work/cancel',
            'BUTTONSOURCE' => 'BR_EC_EMPRESA',
            'NOSHIPPING' => 1,
        );
        $response = $paypal->SetExpressCheckout($item);

        if (is_array($response) && $response['ACK'] == 'Success') { //Request successful
            $user = $adminsetting;
            if (!is_array($user->payment_gateways)) {
                $user->payment_gateways = [];
            }
            $tmp_gateways = $user->payment_gateways;
            $tmp_gateways['paypal'] = [
                'mode' => $request->input('mode'),
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'api_signature_key' => $request->input('api_signature_key'),
                'enabled' => $user->payment_gateways['paypal']['enabled'] ?? false
            ];
            $user->payment_gateways = $tmp_gateways;
            $user->save();
            return response()->json(['status' => 200, 'message' => 'Gateway updated successfully']);
        } else if (is_array($response) && $response['ACK'] == 'Failure') {
            if ($response['L_SHORTMESSAGE0'] === 'Security error') {
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'paypal' => ['Invalid paypal credentials provided.'],
                ]);
            } else {
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'paypal' => [$response['L_LONGMESSAGE0']]
                ]);
            }
            throw $error;
        }
        return response()->json(['status' => 200, 'message' => 'Gateway updated successfully']);
    }

    public function updateStipe(Request $request)
    {
        $request->validate([
            'mode' => 'in:test,live',
            'publishable_key' => 'required',
            'secret_key' => 'required'
        ]);

        $stripe = new \Stripe\StripeClient($request->input('secret_key'));

        try {
            $webhooks = $stripe->webhookEndpoints->all();
        } catch (AuthenticationException $e) {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'secret_key' => ['Invalid Secret Key provided.'],
            ]);
            throw $error;
        }

        $user = $this->adminsetting;
        if (!is_array($user->payment_gateways)) {
            $user->payment_gateways = [];
        }
        $tmp_gateways = $user->payment_gateways;

        $tmp_gateways['stripe'] = [
            'secret_key' => $request->input('secret_key'),
            'publishable_key' => $request->input('publishable_key'),
            'mode' => $request->input('mode'),
            'enabled' => $user->payment_gateways['stripe']['enabled'] ?? false
        ];

        //find and delete old webhook
        foreach ($webhooks->getLastResponse()->json['data'] as $webhook) {
            if ($webhook['url'] == url('/stripe-webhook')) {
                $stripe->webhookEndpoints->delete(
                    $webhook['id'],
                    []
                );
            }
        }

        //create new webhook only if api keys are changed.
        $webhook = $stripe->webhookEndpoints->create([
            'url' => url('/stripe-webhook'),
            'enabled_events' => [
                'checkout.session.completed'
            ],
        ]);

        $tmp_gateways['stripe']['webhook_secret'] = $webhook->secret;

        // update old pending payments of last 24 hours with new keys
        $invoices = Invoice::where('user_id', $user->id)
            ->where(function ($query) {
                $query->where('status', 'pending')
                    ->orWhere('status', 'partially_paid')
                    ->orWhere('status', 'overdue');
            })
            ->where('created_at', '>', DB::raw('NOW() - INTERVAL 24 HOUR'))
            ->get();

        foreach ($invoices as $invoice) {
            $snapshot = $invoice->snapshot;
            if (isset($snapshot['payment_methods']['stripe'])) {
                $snapshot['payment_methods']['stripe'] = $tmp_gateways['stripe'];
                $invoice->snapshot = $snapshot;
                $invoice->save();
            }
        }

        $user->payment_gateways = $tmp_gateways;
        $user->save();
        return response('success');
    }

    public function emailSettings()
    {
        addVendors(['jquery-validate']);
        $adminsetting = AdminSettings::orderBy('created_at', 'desc')->first();
        return view('settings.email', compact('adminsetting'));
    }

    public function updateEmails(Request $request)
    {
        $request->validate([
            'type' => 'in:invoice_created,invoice_due',
            'subject' => 'string|required'
        ]);

        $adminsetting = AdminSettings::orderBy('created_at', 'desc')->first();

        $user = $adminsetting;
        $email_settings = $user->email_settings;
        $email_settings['mails'][$request->input('type')] = [
            'subject' => $request->input('subject'),
            'message' => $request->message
        ];

        $user->email_settings = $email_settings;
        $user->save();

        return response()->json(['status' => 200, 'message' => 'Email updated successfully']);
    }

    public function updateRazorpay(Request $request)
    {
        $request->validate([
            'mode' => 'in:test,live',
            'key_id' => 'required',
            'key_secret' => 'required'
        ]);

        // $api = new \Razorpay\Api\Api($request->input('key_id'), $request->input('key_secret'));

        // try {
        //     $api->order->all();
        // } catch (\Razorpay\Api\Errors\BadRequestError $e) {
        //     $error = \Illuminate\Validation\ValidationException::withMessages([
        //         'key_id' => [$e->getMessage()],
        //     ]);
        //     throw $error;
        // }

        $adminsetting = AdminSettings::orderBy('created_at', 'desc')->first() ?? new AdminSettings();
        $user = $adminsetting;
        if (!is_array($user->payment_gateways)) {
            $user->payment_gateways = [];
        }
        $tmp_gateways = $user->payment_gateways;
        $tmp_gateways['razorpay'] = [
            'key_id' => $request->input('key_id'),
            'key_secret' => $request->input('key_secret'),
            'mode' => $request->input('mode'),
            'enabled' => $user->payment_gateways['razorpay']['enabled'] ?? false
        ];
        $user->payment_gateways = $tmp_gateways;
        $user->save();
        return response()->json(['status' => 200, 'message' => 'Gateway updated successfully']);
    }


    public function index(StatusDataTable $dataTable)
    {
        // Render the DataTable view
        $data['title'] = 'Hotel Management';
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        return $dataTable->render('settings.status.index');
    }

    public function CompanyInfo()
    {
        $company = CompanyMaster::latest()->paginate(10);
        return view('settings.company', compact('company'));
    }

    public function addCompany()
    {
        return view('settings.add-company');
    }

    public function create()
    {
        $html = view('settings.status.create')->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'nullable|string|max:7',
            'background' => 'nullable|string|max:7',
        ]);

        Status::create([
            'name' => $request->name,
            'color' => $request->color,
            'background' => $request->background,
        ]);

        return response()->json(array('status' => 200, 'message' => "Status created successfully"));
        // return redirect()->route('settings.status.index')->with('success', 'Status created successfully.');

    }

    public function edit($id)
    {
        $status = Status::findOrFail($id);
        // return view('settings.status.edit', compact('status'));
        $html = view('settings.status.edit', compact('status'))->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }

    public function update(Request $request, $id)
    {

        $status = Status::findOrFail($id);
        $status->update($request->all());
        // return redirect()->route('settings.status.index')->with('success', 'Status updated successfully.');
        return response()->json(array('status' => 200, 'message' => "Status updated successfully"));
    }


    public function destroy($id)
    {
        try {
            // Find the status by ID and delete it
            $status = Status::findOrFail($id);
            $status->delete();

            // Return a JSON response indicating success and include a redirect URL
            return response()->json([
                'status' => 200,
                'message' => 'Status deleted successfully',
                'redirect' => route('status.index'), // Include the redirect URL here
            ]);
        } catch (\Exception $e) {
            // Return a JSON response indicating failure
            return response()->json([
                'status' => 500,
                'message' => 'Failed to delete status. Please try again.',
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function googleLogin()
    {
        addVendors(['jquery-validate']);
        $googleLogin = GoogleLoginSettings::first();
        return view('settings.googleSettings', compact('googleLogin'));
    }
    public function googleLoginSave(Request $request)
    {
        $googleLogin = GoogleLoginSettings::first() ?? new GoogleLoginSettings();
        $googleLogin->client_id = $request->client_id;
        $googleLogin->client_secrete = $request->client_secrete;
        $save = $googleLogin->save();
        if ($save) {
            return response()->json(['status' => 200, 'message' => 'Details Saved Successfully'], 200);
        } else {
            return response()->json(['status' => 500, 'message' => 'Details Saved Successfully'], 500);
        }
    }
}
