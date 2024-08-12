<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\invoices;
use Illuminate\Support\Facades\Auth;
class AddInvoiceNew extends Notification
{
    use Queueable;
    private $invoices;

    public function __construct( $invoices)//invoices
    {
        $this->invoices = $invoices;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }
    public function toArray(object $notifiable): array
    {
        return [

            'data' => $this->invoices['body'],
            // 'data' => $this->invoices->toArray($notifiable),
            'id'=> $this->invoices->id,
            'title'=>'تم اضافة فاتورة جديد بواسطة :',
            'user'=> Auth::user()->name,

        ];
    }
}
