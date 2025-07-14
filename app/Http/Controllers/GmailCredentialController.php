<?php

namespace App\Http\Controllers;

use App\Facades\Gmail;
use App\Jobs\SendGmailEmail;
use App\Models\GoogleCredential;
use Illuminate\Http\Request;
use App\Services\GmailService;
use Illuminate\Support\Facades\Log;

class GmailCredentialController extends Controller
{
    public function showForm()
    {
        $creds = GoogleCredential::where('name', 'gmail_api')->first();
        return view('settings.gmailauth', compact('creds'));
    }
    
    public function saveCredentials(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'client_secret' => 'required',
            'redirect_uri' => 'required|url',
        ]);
        
        GoogleCredential::updateOrInsert(
            ['name' => 'gmail_api'],
            $request->only(['client_id', 'client_secret', 'redirect_uri']) + ['name' => 'gmail_api']
        );
        
        $authUrl = Gmail::getAuthUrl();
        Log::info('Gmail auth URL: ' . $authUrl);
        return redirect($authUrl);
    }
    
    public function handleCallback(Request $request)
    {
        $code = $request->input('code');
        Gmail::fetchAccessToken($code);

        
        return redirect('/send-email')->with('success', 'Authorized successfully. You can now send emails.');
    }
    
    public function showEmailForm()
    {
        $isAuthenticated = Gmail::isAuthenticated();
        return view('settings.send-email', compact('isAuthenticated'));
    }
    
    public function sendEmail(Request $request)
    {
        $request->validate([
            'to' => 'required|email',
            'subject' => 'required|string',
            'body' => 'required|string',
            'queue' => 'nullable|boolean',
            'is_html' => 'nullable|boolean',
        ]);
        
        if (!Gmail::isAuthenticated()) {
            return back()->with('error', 'Not authenticated with Gmail API. Please authenticate first.');
        }
        
        $options = [
            'is_html' => $request->input('is_html', false),
        ];
        
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $options['attachments'][] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $file->getPathname(),
                    'type' => $file->getMimeType(),
                ];
            }
        }
        
        // Check if we should queue the email
        if ($request->input('queue', false)) {
            SendGmailEmail::dispatch(
                $request->input('to'),
                $request->input('subject'),
                $request->input('body'),
                $options
            );
            
            return back()->with('success', 'Email queued for sending!');
        } else {
            // Send immediately
            $success = Gmail::sendEmail(
                $request->input('to'),
                $request->input('subject'),
                $request->input('body'),
                $options
            );
            
            if ($success) {
                return back()->with('success', 'Email sent successfully!');
            } else {
                return back()->with('error', 'Failed to send email. Please try again.');
            }
        }
    }

    public function debugAuth()
    {

        $tokenPath = storage_path('app/credentials/token.json');
        $exists = file_exists($tokenPath);
        $content = $exists ? json_decode(file_get_contents($tokenPath), true) : null;
        
        $debug = [
            'token_file_exists' => $exists,
            'token_file_path' => $tokenPath,
            'token_structure' => $content ? array_keys($content) : null,
            'has_access_token' => $content && isset($content['access_token']),
            'has_refresh_token' => $content && isset($content['refresh_token']),
            'client_initialized' => app('gmail')->getClient() !== null,
            'is_authenticated' => app('gmail')->isAuthenticated(),
        ];
        
        return response()->json($debug);
    }


}
