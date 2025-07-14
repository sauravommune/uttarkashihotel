<?php

namespace App\Repositories;

use App\Models\SmtpSettings;
use Illuminate\Http\Request;

class SmtpRepository extends BaseRepository
{

    public function saveSmtp(Request $request)
    {
        $request->validate([
            'driver' => 'required',
            'username' => 'required',
            'smtp_port' => 'required',
            'encryption' => 'required',
            'smtp_host' => 'required',
            'smtp_from_email' => 'required|email',
            'smtp_from_name' => 'required',
            'smtp_pass' => 'required',
        ]);

        $SMTPDetail = SmtpSettings::first();
        if (empty($SMTPDetail)) {
            $SMTPDetails = new SmtpSettings();
        } else {
            $SMTPDetails = SmtpSettings::find($SMTPDetail->id);
        }

        $SMTPDetails->username = $request->username;
        $SMTPDetails->smtp_host = $request->smtp_host;
        $SMTPDetails->smtp_port = $request->smtp_port;
        $SMTPDetails->smtp_from_email = $request->smtp_from_email;
        $SMTPDetails->smtp_from_name = $request->smtp_from_name;
        $SMTPDetails->smtp_pass = $request->smtp_pass;
        $SMTPDetails->driver = $request->driver;
        $SMTPDetails->encryption = $request->encryption;
        $SMTPDetails->save();
    }


    public function saveAws(Request $request)
    {
        $request->validate([
            'awsdriver' => 'required',
            'awsAccessKey' => 'required',
            'awsSecretKey' => 'required',
            'awsDefaultRegion' => 'required',
            'awsBucket' => 'required',
            'from_email' => 'required|email',
            'form_name' => 'required',
        ]);

        $SMTPDetail = SmtpSettings::first();
        if (empty($SMTPDetail)) {
            $SMTPDetails = new SmtpSettings();
        } else {
            $SMTPDetails = SmtpSettings::find($SMTPDetail->id);
        }
        $SMTPDetails->awsAccessKey = $request->awsAccessKey;
        $SMTPDetails->awsSecretKey = $request->awsSecretKey;
        $SMTPDetails->awsDefaultRegion = $request->awsDefaultRegion;
        $SMTPDetails->awsBucket = $request->awsBucket;
        $SMTPDetails->awsPathStyle = $request->awsPathStyle;
        $SMTPDetails->smtp_from_email = $request->from_email;
        $SMTPDetails->smtp_from_name = $request->form_name;
        $SMTPDetails->driver = $request->awsdriver;
        $SMTPDetails->save();
    }
}
