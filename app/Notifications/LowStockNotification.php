<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class LowStockNotification extends Notification
{
    use Queueable;

    protected $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function via($notifiable)
    {
        return ['telegram']; // យើងនឹងហៅប្រើតាមរយៈ Custom Logic
    }

    public function toTelegram($notifiable)
    {
        $token = env('8341019948:AAEo3gMBTCNCYSA7Ej9BKpDuB_BZpfIsPnM');
        $chatId = env('7309869072');
        $message = "⚠️ *ការជូនដំណឹងពីស្តុកទំនិញ*\n\n"
                 . "📦 ទំនិញ៖ *" . $this->product->name . "*\n"
                 . "📉 ចំនួននៅសល់៖ *" . $this->product->qty . "គ្រឿង*\n"
                 . "📢 សូមពិនិត្យ និងកម្មង់បន្ថែម!";

        return Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'Markdown'
        ]);
    }
}