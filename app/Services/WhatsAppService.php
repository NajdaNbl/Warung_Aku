<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    public static function send(string $phone, string $message): bool
    {
        $apiKey = Setting::getValue('wa_api_key', '');
        $apiUrl = Setting::getValue('wa_api_url', 'https://api.fonnte.com/send');

        if (empty($apiKey)) {
            Log::info('WA Notification (no API key): ' . $phone . ' - ' . $message);
            return false;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $apiKey,
            ])->post($apiUrl, [
                'target' => $phone,
                'message' => $message,
                'countryCode' => '62',
            ]);

            return $response->successful();
        } catch (\Exception $e) {
            Log::error('WA send failed: ' . $e->getMessage());
            return false;
        }
    }

    public static function notifyAdmin(string $message): bool
    {
        $adminPhone = Setting::getValue('wa_number', '');
        if (empty($adminPhone)) {
            return false;
        }
        return static::send($adminPhone, $message);
    }
}
