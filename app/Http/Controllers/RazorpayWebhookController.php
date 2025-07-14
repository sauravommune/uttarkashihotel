<?php

namespace App\Http\Controllers;

use App\Models\AdminSettings;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Exception;

class RazorpayWebhookController extends Controller
{

    public function handleWebhook(Request $request)
    {
        // Razorpay Webhook Signature verification
        $webhookSecret = env('RAZORPAY_WEBHOOK_SECRET');
        $signature = $request->header('X-Razorpay-Signature');
        $payload = $request->getContent();

        try {
            $razorpayConfig = AdminSettings::select('id', 'payment_gateways')->first();
            if (isset($razorpayConfig->payment_gateways['razorpay'])) {
                $razorpayConfig = $razorpayConfig->payment_gateways['razorpay'];
            } else {
                throw new Exception('Razorpay config not found');
            }
            
            $api = new Api($razorpayConfig['key_id'], $razorpayConfig['key_secret']);
            $api->utility->verifyWebhookSignature($payload, $signature, $webhookSecret);
        } catch (SignatureVerificationError $e) {
            Log::error('Razorpay Webhook signature verification failed: ' . $e->getMessage());
            return response()->json(['message' => 'Invalid signature'], 200);
        }

        $event = json_decode($payload, true);
        Log::info('Razorpay Webhook event received: ', $event);

        // Handle different types of events
        switch ($event['event']) {
            case 'payment_link.paid':
                $this->handlePaymentLinkPaid($event['payload']);
                break;
            case 'payment_link.cancelled':
                $this->handlePaymentLinkCancelled($event['payload']);
                break;
            case 'payment_link.expired':
                $this->handlePaymentLinkExpired($event['payload']);
                break;
            case 'payment.authorized':
                $this->handlePaymentAuthorized($event['payload']);
                break;
            case 'payment.captured':
                $this->handlePaymentCaptured($event['payload']);
                break;
            case 'payment.failed':
                $this->handlePaymentFailed($event['payload']);
                break;
            case 'refund.created':
                $this->handleRefundCreated($event['payload']);
                break;
            case 'refund.processed':
                $this->handleRefundProcessed($event['payload']);
                break;
            case 'refund.failed':
                $this->handleRefundFailed($event['payload']);
                break;
            case 'refund.speed_changed':
                $this->handleRefundSpeedChanged($event['payload']);
                break;
            default:
                Log::warning('Unhandled event type: ' . $event['event']);
                Log::warning($event);
                break;
        }

        return response()->json(['message' => 'Webhook handled successfully']);
    }

    private function handlePaymentLinkPaid($payload)
    {
        try {
            $paymentId = $payload['payment']['entity']['id'];
            $bookingId = $payload['payment_link']['entity']['notes']['booking_id'];
            $merchantOrderId = $payload['payment_link']['entity']['notes']['merchant_order_id'];

            $transaction = Payment::where('booking_id', $bookingId)->where('merchant_order_id', $merchantOrderId)->first();

            if (isset($transaction?->id)) {
                $gateway_fee = !empty($payload['payment']['entity']['fee']) ? $payload['payment']['entity']['fee'] / 100 : 0;
                $transaction->order_id          = $payload['order']['entity']['id'];
                $transaction->payment_method    = $payload['payment']['entity']['method'];
                $transaction->payment_id        = $paymentId;
                $transaction->gateway_fee       = $gateway_fee;
                $transaction->gateway_tax       = !empty($payload['payment']['entity']['tax']) ? $payload['payment']['entity']['tax'] / 100 : 0;
                $transaction->status            = $payload['payment']['entity']['status'] ?? 'pending';
                $transaction->save();
            } else {
                throw new Exception('Transaction not found');
            }
        } catch (Exception $e) {
            Log::info("method: RazorpayWebhookController::handlePaymentLinkPaid");
            Log::error($e->getMessage());
        }
    }

    private function handlePaymentLinkCancelled($payload)
    {
        try {
            $bookingId = $payload['payment_link']['entity']['notes']['booking_id'];
            $merchantOrderId = $payload['payment_link']['entity']['notes']['merchant_order_id'];

            $transaction = Payment::where('booking_id', $bookingId)->where('merchant_order_id', $merchantOrderId)->first();

            if (isset($transaction?->id)) {
                $transaction->status        = $payload['payment_link']['entity']['status'] ?? 'cancelled';
                $transaction->save();
            } else {
                throw new Exception('Transaction not found');
            }
        } catch (Exception $e) {
            Log::info("method: RazorpayWebhookController::handlePaymentLinkExpired");
            Log::error($e->getMessage());
        }
    }

    private function handlePaymentLinkExpired($payload)
    {
        try {
            $bookingId = $payload['payment_link']['entity']['notes']['booking_id'];
            $merchantOrderId = $payload['payment_link']['entity']['notes']['merchant_order_id'];

            $transaction = Payment::where('booking_id', $bookingId)->where('merchant_order_id', $merchantOrderId)->first();

            if (isset($transaction?->id)) {
                $transaction->status        = $payload['payment_link']['entity']['status'] ?? 'expired';
                $transaction->save();
            } else {
                throw new Exception('Transaction not found');
            }
        } catch (Exception $e) {
            Log::info("method: RazorpayWebhookController::handlePaymentLinkExpired");
            Log::error($e->getMessage());
        }
    }

    private function handlePaymentAuthorized($payload)
    {
        try {
            $paymentId = $payload['payment']['entity']['id'];
            $bookingId = $payload['payment']['entity']['notes']['booking_id'];
            $merchantOrderId = $payload['payment']['entity']['notes']['merchant_order_id'];

            $transaction = Payment::where('booking_id', $bookingId)->where('merchant_order_id', $merchantOrderId)->first();

            if (!in_array($transaction->status, ['authorized', 'captured', 'refunded', 'failed', 'expired'])) {

                if (isset($transaction?->id)) {
                    $transaction->payment_id    = $paymentId;
                    $transaction->gateway_fee   = !empty($payload['payment']['entity']['fee']) ? $payload['payment']['entity']['fee'] / 100 : 0;
                    $transaction->gateway_tax   = !empty($payload['payment']['entity']['tax']) ? $payload['payment']['entity']['tax'] / 100 : 0;
                    $transaction->status        = $payload['payment']['entity']['status'] ?? 'authorized';
                    $transaction->save();
                } else {
                    throw new Exception('Transaction not found');
                }
            } else {
                throw new Exception('Authorized status not saved by webhook. Current Payment status : ' . $transaction->status . ', Payment Id: ' . $paymentId);
            }
        } catch (Exception $e) {
            Log::info("method: RazorpayWebhookController::handlePaymentAuthorized");
            Log::info($e->getMessage());
        }
    }

    private function handlePaymentCaptured($payload)
    {
        try {
            $paymentId = $payload['payment']['entity']['id'];
            $bookingId = $payload['payment']['entity']['notes']['booking_id'];
            $merchantOrderId = $payload['payment']['entity']['notes']['merchant_order_id'];

            $transaction = Payment::where('booking_id', $bookingId)->where('merchant_order_id', $merchantOrderId)->first();

            if ($transaction->status == "captured") {
                throw new Exception('Transaction Already Captured! Payment Id: ' . $transaction->payment_id);
            }

            if (isset($transaction?->id)) {
                if (!empty($transaction->payment_link)) {
                    exit();
                }

                $transaction->payment_id    = $paymentId;
                $transaction->gateway_fee   = !empty($payload['payment']['entity']['fee']) ? $payload['payment']['entity']['fee'] / 100 : 0;
                $transaction->gateway_tax   = !empty($payload['payment']['entity']['tax']) ? $payload['payment']['entity']['tax'] / 100 : 0;
                $transaction->status        = $payload['payment']['entity']['status'] ?? 'captured';
                $transaction->save();
            } else {
                throw new Exception('Transaction not found');
            }
        } catch (Exception $e) {
            Log::info("method: RazorpayWebhookController::handlePaymentCaptured");
            Log::info($e->getMessage());
        }
    }

    private function handlePaymentFailed($payload)
    {
        try {
            $paymentId = $payload['payment']['entity']['id'];
            $bookingId = $payload['payment']['entity']['notes']['booking_id'];
            $merchantOrderId = $payload['payment']['entity']['notes']['merchant_order_id'];

            $transaction = Payment::where('booking_id', $bookingId)->where('merchant_order_id', $merchantOrderId)->first();

            if (isset($transaction?->id) && !in_array($transaction->status, ['authorized', 'captured', 'refunded'])) {
                $transaction->payment_id    = $paymentId;
                $transaction->status        = $payload['payment']['entity']['status'] ?? 'failed';
                $transaction->save();
            } else {
                throw new Exception('Transaction not found');
            }
        } catch (Exception $e) {
            Log::info("method: RazorpayWebhookController::handlePaymentFailed");
            Log::info($e->getMessage());
        }
    }

    private function handleRefundCreated($payload)
    {
        try {
            $bookingId = $payload['payment']['entity']['notes']['booking_id'];
            $merchantOrderId = $payload['payment']['entity']['notes']['merchant_order_id'];

            $transaction = Payment::where('booking_id', $bookingId)->where('merchant_order_id', $merchantOrderId)->first();

            if (isset($transaction?->id)) {
                $transaction->refund_amount = $payload['refund']['entity']['amount'] / 100;
                $transaction->refund_status = $payload['refund']['entity']['status'] ?? 'processed';
                $transaction->status        = 'refunded';
                $transaction->save();
            } else {
                throw new Exception('Transaction not found');
            }
        } catch (Exception $e) {
            Log::info("method: RazorpayWebhookController::handleRefundCreated");
            Log::info($e->getMessage());
        }
    }

    private function handleRefundProcessed($payload)
    {
        try {
            $bookingId = $payload['payment']['entity']['notes']['booking_id'];
            $merchantOrderId = $payload['payment']['entity']['notes']['merchant_order_id'];

            $transaction = Payment::where('booking_id', $bookingId)->where('merchant_order_id', $merchantOrderId)->first();

            if (isset($transaction?->id)) {
                $transaction->refund_amount = $payload['refund']['entity']['amount'] / 100;
                $transaction->refund_status = $payload['refund']['entity']['status'] ?? 'refunded';
                $transaction->status        = 'refunded';
                $transaction->save();
            } else {
                throw new Exception('Transaction not found');
            }
        } catch (Exception $e) {
            Log::info("method: RazorpayWebhookController::handleRefundProcessed");
            Log::info($e->getMessage());
        }
    }

    private function handleRefundFailed($payload)
    {
        try {
            $bookingId = $payload['payment']['entity']['notes']['booking_id'];
            $merchantOrderId = $payload['payment']['entity']['notes']['merchant_order_id'];

            $transaction = Payment::where('booking_id', $bookingId)->where('merchant_order_id', $merchantOrderId)->first();

            if (isset($transaction?->id)) {
                $transaction->refund_status = $payload['refund']['entity']['status'] ?? 'failed';
                $transaction->save();
            } else {
                throw new Exception('Transaction not found');
            }
        } catch (Exception $e) {
            Log::info("method: RazorpayWebhookController::handleRefundFailed");
            Log::info($e->getMessage());
        }
    }

    private function handleRefundSpeedChanged($payload)
    {
        try {
            $bookingId = $payload['payment']['entity']['notes']['booking_id'];
            $merchantOrderId = $payload['payment']['entity']['notes']['merchant_order_id'];

            $transaction = Payment::where('booking_id', $bookingId)->where('merchant_order_id', $merchantOrderId)->first();

            if (isset($transaction?->id)) {
                $transaction->refund_amount = $payload['refund']['entity']['amount'] / 100;
                $transaction->refund_status = $payload['refund']['entity']['status'] ?? 'refunded';
                $transaction->save();
            } else {
                throw new Exception('Transaction not found');
            }
        } catch (Exception $e) {
            Log::info("method: RazorpayWebhookController::handleRefundSpeedChanged");
            Log::info($e->getMessage());
        }
    }
}
