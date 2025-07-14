<?php

namespace App\Jobs;

use App\Mail\UserCreateMail;
use App\Traits\ConfiguresDynamicMailSettings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserRegistered implements ShouldQueue
{
    use Queueable, ConfiguresDynamicMailSettings;

    public $user;
    public $password;
    /**
     * Create a new job instance.
     */
    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try{
            $this->configureDynamicMailSettings();
            Mail::to($this->user->email)
                ->send(new UserCreateMail($this->user, $this->password));
        }catch(\Exception $e){
            Log::error("UserRegistered Failed for {$this->user->email}: " . $e->getMessage(), ['exception' => $e]);
        }
    }
}
