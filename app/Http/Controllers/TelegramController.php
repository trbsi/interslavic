<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;

class TelegramController
{
    public function setWebHook()
    {
        $bot_api_key = env('TELEGRAM_API_KEY');
        $bot_username = env('TELEGRAM_BOT_NAME');
        $hook_url = route('telegram.webhook');

        try {
            // Create Telegram API object
            $telegram = new Telegram($bot_api_key, $bot_username);

            // Set webhook
            $result = $telegram->setWebhook($hook_url);
            if ($result->isOk()) {
                echo $result->getDescription();
            }
        } catch (TelegramException $e) {
            dd($e->getMessage());
        }
    }

    public function webhook(Request $request)
    {
        $bot_api_key = env('TELEGRAM_API_KEY');
        $bot_username = env('TELEGRAM_BOT_NAME');

        try {
            // Create Telegram API object
            $telegram = new Telegram($bot_api_key, $bot_username);

            // Handle telegram webhook request
            $telegram->handle();
            Log::info('Telegram', $request->all());
        } catch (TelegramException $e) {
            // Silence is golden!
            // log telegram errors
            // echo $e->getMessage();
        }
    }
}
