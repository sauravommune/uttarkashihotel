<?php

namespace App\Services;

use App\Models\GoogleCredential;
use Google\Client as Google_Client;
use Google\Service\Gmail;
use Google\Service\Gmail\Message;
use Illuminate\Support\Facades\Log;

class GmailService
{
    protected $client;
    protected $service;
    
    /**
     * Create a new Gmail client instance.
     */
    public function __construct()
    {
        $this->initClient();
    }
    
    /**
     * Initialize the Google client with credentials
     */
    private function initClient(): void
    {
        try {
            $creds = GoogleCredential::where('name', 'gmail_api')->first();
            
            if (!$creds) {
                Log::warning('Gmail API credentials not found in database');
                return;
            }
            
            $this->client = new Google_Client();
            $this->client->setApplicationName("Hottel");
            $this->client->setClientId($creds->client_id);
            $this->client->setClientSecret($creds->client_secret);
            $this->client->setRedirectUri($creds->redirect_uri);
            $this->client->setAccessType('offline');
            $this->client->setPrompt('consent');
            $this->client->setIncludeGrantedScopes(true);
            $this->client->addScope(Gmail::GMAIL_SEND);
            
            
            $this->loadAccessToken();
        } catch (\Exception $e) {
            Log::error('Gmail service initialization failed: ' . $e->getMessage());
        }
    }
    
    /**
     * Load the access token from storage
     */
    private function loadAccessToken(): void
    {
        $tokenPath = storage_path('app/credentials/token.json');
        
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $this->client->setAccessToken($accessToken);
            
            
            if ($this->client->isAccessTokenExpired()) {
                $this->refreshToken();
            }
        }
    }
    
    /**
     * Refresh the access token using refresh token
     */
    private function refreshToken(): bool
    {
        try {
            if ($this->client && $this->client->getRefreshToken()) {
                $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
                $this->saveAccessToken($this->client->getAccessToken());
                return true;
            }
            return false;
        } catch (\Exception $e) {
            Log::error('Token refresh failed: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Save the access token to storage
     */
    private function saveAccessToken(array $accessToken): void
    {
        $directory = dirname(storage_path('app/credentials/token.json'));
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
        file_put_contents(storage_path('app/credentials/token.json'), json_encode($accessToken));
    }
    
    /**
     * Get Google Client instance
     */
    public function getClient(): ?Google_Client
    {
        return $this->client;
    }
    
    /**
     * Get Gmail service instance
     */
    public function getService(): ?Gmail
    {
        if (!$this->service && $this->client) {
            $this->service = new Gmail($this->client);
        }
        return $this->service;
    }
    
    /**
     * Generate authorization URL
     */
    public function getAuthUrl(): string
    {
        if (!$this->client) {
            throw new \Exception('Google Client not initialized');
        }
        return $this->client->createAuthUrl();
    }
    
    /**
     * Exchange authorization code for access token
     */
    public function fetchAccessToken(string $code): array
    {
        if (!$this->client) {
            throw new \Exception('Google Client not initialized');
        }
        
        $accessToken = $this->client->fetchAccessTokenWithAuthCode($code);
        $this->saveAccessToken($accessToken);
        return $accessToken;
    }
    
    /**
     * Check if client is authenticated
     */
    public function isAuthenticated(): bool
    {
        try {
            if (!$this->client) {
                return false;
            }
            
            $tokenPath = storage_path('app/credentials/token.json');
            if (!file_exists($tokenPath)) {
                return false;
            }
            
            $tokenData = json_decode(file_get_contents($tokenPath), true);
            
            if (!isset($tokenData['access_token'])) {
                return false;
            }
            
            if ($this->client->isAccessTokenExpired()) {
                if (!isset($tokenData['refresh_token'])) {
                    return false;
                }
                
                $refreshSuccess = $this->refreshToken();
                if (!$refreshSuccess) {
                    return false;
                }
            }
            
            return true;
        } catch (\Exception $e) {
            Log::error('Error checking authentication status: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Send an email
     */
    public function sendEmail(string $to, string $subject, string $body, array $options = []): bool
    {
        try {
            if (!$this->isAuthenticated()) {
                throw new \Exception('Gmail API not authenticated');
            }
            
            $service = $this->getService();
            
            // Email format options
            $from = $options['from'] ?? 'me';
            $isHtml = $options['is_html'] ?? false;
            $cc = $options['cc'] ?? null;
            $bcc = $options['bcc'] ?? null;
            $attachments = $options['attachments'] ?? [];
            
            // Create MIME message
            $boundary = uniqid(rand(), true);
            $email = '';
            
            // Email headers
            $email .= "From: <{$from}>\r\n";
            $email .= "To: <{$to}>\r\n";
            
            if ($cc) {
                $email .= "Cc: <{$cc}>\r\n";
            }
            
            if ($bcc) {
                $email .= "Bcc: <{$bcc}>\r\n";
            }
            
            $email .= "Subject: {$subject}\r\n";
            
            // For multi-part messages
            $email .= "MIME-Version: 1.0\r\n";
            
            // If we have attachments, make it multi-part
            if (!empty($attachments)) {
                $email .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\r\n\r\n";
                $email .= "--{$boundary}\r\n";
                
                if ($isHtml) {
                    $email .= "Content-Type: text/html; charset=UTF-8\r\n\r\n";
                } else {
                    $email .= "Content-Type: text/plain; charset=UTF-8\r\n\r\n";
                }
                
                $email .= $body . "\r\n\r\n";
                
                // Add attachments
                foreach ($attachments as $attachment) {
                    $filename = $attachment['name'];
                    $content = base64_encode(file_get_contents($attachment['path']));
                    $mimetype = $attachment['type'] ?? 'application/octet-stream';
                    
                    $email .= "--{$boundary}\r\n";
                    $email .= "Content-Type: {$mimetype}; name=\"{$filename}\"\r\n";
                    $email .= "Content-Disposition: attachment; filename=\"{$filename}\"\r\n";
                    $email .= "Content-Transfer-Encoding: base64\r\n\r\n";
                    $email .= chunk_split($content) . "\r\n\r\n";
                }
                
                $email .= "--{$boundary}--";
            } else {
                // Simple email without attachments
                if ($isHtml) {
                    $email .= "Content-Type: text/html; charset=UTF-8\r\n\r\n";
                } else {
                    $email .= "Content-Type: text/plain; charset=UTF-8\r\n\r\n";
                }
                
                $email .= $body;
            }
            
            // Encode the email for Gmail API
            $mime = rtrim(strtr(base64_encode($email), '+/', '-_'), '=');
            $message = new Message();
            $message->setRaw($mime);
            
            try {
                // Send the email
                $service->users_messages->send('me', $message);
                return true;
            } catch (\Exception $e) {
                // If we get an authentication error when actually sending,
                // we should log it and reflect the authentication state
                Log::error('Gmail API sending error: ' . $e->getMessage());
                return false;
            }
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
            return false;
        }
    }
}