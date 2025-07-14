<?php

namespace App\Traits;

use App\Models\SmtpSettings;
use Illuminate\Support\Facades\Log;

trait ConfiguresDynamicMailSettings
{
    /**
     * Configure mail settings dynamically from database
     */
    protected function configureDynamicMailSettings()
    {
        try {
            $mailConfig = SmtpSettings::first();
            if (!empty($mailConfig)) {
                switch ($mailConfig->driver) {
                    case 'ses':
                        config([
                            'mail.default' => 'ses',
                            'services.ses.key' => $mailConfig->awsAccessKey,
                            'services.ses.secret' => $mailConfig->awsSecretKey,
                            'services.ses.region' => $mailConfig->awsDefaultRegion,
                            'mail.from.address' => $mailConfig->smtp_from_email,
                            'mail.from.name' => $mailConfig->smtp_from_name,

                            'mail.mailers.ses' => [
                                'transport' => 'ses',
                            ],
                        ]);
                        break;
                    case 'smtp':
                    default:
                        config([
                            'mail.default' => 'smtp',

                            'mail.mailers.smtp.transport' => 'smtp',
                            'mail.mailers.smtp.host' => $mailConfig->smtp_host,
                            'mail.mailers.smtp.port' => $mailConfig->smtp_port,
                            'mail.mailers.smtp.username' => $mailConfig->username,
                            'mail.mailers.smtp.password' => $mailConfig->smtp_pass,
                            'mail.mailers.smtp.encryption' => $mailConfig->encryption ?? 'tls',

                            'mail.from.address' => $mailConfig->smtp_from_email,
                            'mail.from.name' => $mailConfig->smtp_from_name,
                        ]);
                        break;
                }
            }
            config()->set('mail', config('mail'));
        } catch (\Exception $e) {
            Log::error('Dynamic Mail Configuration Error: ' . $e->getMessage());
            exit();
        }
    }
}