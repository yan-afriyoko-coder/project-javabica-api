<?php

namespace App\Services\Midtrans;

use App\Models\Order;
use App\Services\Midtrans\Midtrans;
use App\Services\OrderCalculationService;
use Midtrans\Notification;

class CallBackService extends Midtrans
{
    protected $notification;
    protected $order;
    protected $serverKey;
   

    public function __construct()
    {
        parent::__construct();

        $this->serverKey = config('midtrans.server_key');
        $this->_handleNotification();
       
    }

    public function isSignatureKeyVerified()
    {
            return  $this->_createLocalSignatureKey();
         // return ($this->_createLocalSignatureKey() == $this->notification->signature_key);
    }

    public function isSuccess()
    {
        $statusCode          = $this->notification->status_code;
        $transactionStatus   = $this->notification->transaction_status;
        $fraudStatus         = !empty($this->notification->fraud_status) ? ($this->notification->fraud_status == 'accept') : true;

        return ($statusCode == 200 && $fraudStatus && ($transactionStatus == 'capture' || $transactionStatus == 'settlement'));
    }

    public function isExpire()
    {
        return ($this->notification->transaction_status == 'expire');
    }

    public function isCancelled()
    {
        return ($this->notification->transaction_status == 'cancel');
    }
    public function isPending()
    {
        return ($this->notification->transaction_status == 'pending');
    }

    public function getNotification()
    {
        return $this->notification;
    }

    public function getOrder()
    {
        return $this->order;
    }

    protected function _createLocalSignatureKey()
    {
        $getCalculate  = new OrderCalculationService;
        $getData = $getCalculate->orderCalculation($this->order->id);
        
        $orderId         = $this->order->order_number;
        $statusCode      = $this->notification->status_code;
        $grossAmount     = ''.$getData['arrayResponse']['grand_total'].'.00';
        $serverKey       = $this->serverKey;
        $input = $orderId.$statusCode.$grossAmount.$serverKey;
        $signature = openssl_digest($input, 'sha512');
       

        return $signature;
    }

    protected function _handleNotification()
    {
        $notification = new Notification();

        $orderNumber = $notification->order_id;
        $order = Order::where('order_number', $orderNumber)->first();

        $this->notification = $notification;
        $this->order = $order;
    }
}
