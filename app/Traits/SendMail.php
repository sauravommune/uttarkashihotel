<?php
namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

trait SendMail {
    public static function mailSend(
        string $toEmail,
        string $subject, 
        string $view, 
        array $data = [], 
        string $attachmentPath = null, 
        
    ) {
        try {
            Mail::send($view, $data, function ($message) use ($toEmail, $subject, $attachmentPath) {
                $message->to($toEmail)
                        ->subject($subject);
                if ($attachmentPath) {
                    $message->attach($attachmentPath);
                }
            });
    
            if (Mail::failures()) {
                Log::error('Email sending failed');
                return false;
            }
    
            return true;
        } catch (\Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage());
            return false;
        }
    }
    
}