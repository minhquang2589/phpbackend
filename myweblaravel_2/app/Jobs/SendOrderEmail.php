<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\EmailController;


class SendOrderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $orderDate;
    protected $element;
    protected $orderNumber;
    protected $cart;
    protected $DETACheckout;
    /**
     * Create a new job instance.
     */
    public function __construct($orderDate, $element, $orderNumber, $cart, $DETACheckout)
    {
        $this->orderDate = $orderDate;
        $this->element = $element;
        $this->orderNumber = $orderNumber;
        $this->cart = $cart;
        $this->DETACheckout = $DETACheckout;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $emailController = new EmailController();
        $emailController->sendMail(
            $this->orderDate,
            $this->element,
            $this->orderNumber,
            $this->cart,
            $this->DETACheckout
        );
    }
}
