<?php

namespace App\Jobs;

use App\Services\GmailService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendGmailEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $to;
    protected $subject;
    protected $body;
    protected $options;
    protected $attempts = 3;

    /**
     * Create a new job instance.
     */
    public function __construct(string $to, string $subject, string $body, array $options = [])
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->body = $body;
        $this->options = $options;
    }

    /**
     * Execute the job.
     */
    public function handle(GmailService $gmailService): void
    {
        try {
            $success = $gmailService->sendEmail(
                $this->to,
                $this->subject,
                $this->body,
                $this->options
            );
            
            if (!$success) {
                Log::error('Failed to send email via Gmail API');
                $this->fail('Failed to send email via Gmail API');
            }
        } catch (\Exception $e) {
            Log::error('Exception while sending email: ' . $e->getMessage());
            $this->fail($e);
        }
    }
}