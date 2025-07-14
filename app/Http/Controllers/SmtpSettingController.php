<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SmtpSettings;
use Exception;
use App\Repositories\SmtpRepository;


class SmtpSettingController extends Controller
{
    public function smtpSettings()
    {
        $smtpSetting = SmtpSettings::first();
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        $title = 'E-mail Settings';
        return view('settings.smtp', compact('smtpSetting', 'title'));
    }

    public function updateSmtp(Request $request,  SmtpRepository $smtpRepository)
    {
        try {
            $smtpRepository->saveSmtp($request);
            return response()->json(['status' => 200, 'message' => 'Smtp Details Saved Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateAws(Request $request,  SmtpRepository $smtpRepository)
    {
        try {
            $smtpRepository->saveAws($request);
            return response()->json(['status' => 200, 'message' => 'Aws Details Saved Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }
}
