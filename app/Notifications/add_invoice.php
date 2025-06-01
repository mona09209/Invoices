<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class add_invoice extends Notification
{
    use Queueable;

    private $invoice_id;

    public function __construct($invoice_id)
    {
        $this->invoice_id = $invoice_id;
    }

    // تحديد القنوات التي سيتم إرسال الإشعار عبرها
    public function via(object $notifiable): array
    {
        return ['mail', 'database']; // الإرسال عبر البريد الإلكتروني وقاعدة البيانات
    }

    // إرسال الإشعار عبر البريد الإلكتروني
    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/Invoices/Invoices_details/' . $this->invoice_id); // استخدام URL ديناميكي

        return (new MailMessage)
            ->subject('إضافة فاتورة جديدة')
            ->line('تمت إضافة فاتورة جديدة.')
            ->action('عرض الفاتورة', $url)
            ->line('شكراً لاستخدامك منى سوفت لإدارة الفواتير!');
    }

    // إرسال الإشعار إلى قاعدة البيانات
    public function toDatabase($notifiable)
    {
        return [
            'invoice_id' => $this->invoice_id, // حفظ رقم الفاتورة في البيانات
            'title' => 'تم إضافة فاتورة جديدة بواسطة:',
            'user' => Auth::user()->name,
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}
