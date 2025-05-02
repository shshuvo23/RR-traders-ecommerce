<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $orderItems;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $orderItems)
    {
        $this->order = $order;
        $this->orderItems = $orderItems;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order Confirmation - '.'Order ID:#'. $this->order->order_number)
                    ->markdown('emails.order_confirmation')
                    ->with([
                        'order' => $this->order,
                        'orderItems' => $this->orderItems,
                    ]);
    }
}
