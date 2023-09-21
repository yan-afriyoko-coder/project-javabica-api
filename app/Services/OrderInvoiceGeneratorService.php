<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;

/**
 * Class OrderInvoiceGeneratorService
 * @package App\Services
 */
class OrderInvoiceGeneratorService
{
    public function generate($dataCollection)
    {
        $companyDetail = new Party([
            'coporate_name'        => ''.config('javabica.corporate_name').'',
            'address'              => ''.config('javabica.address').'',
            'phone'                => ''.config('javabica.phone').'',
            'email'                => ''.config('javabica.email').'',
            'website'              => ''.config('javabica.website').'',
            
        ]);

        $customer = new Party([
            'name'          => $dataCollection->billing_first_name . ' ' . $dataCollection->billing_last_name,
            'custom_fields' => [
                'Alamat' => $dataCollection->billing_address . ', ' . $dataCollection->billing_city . ', ' . $dataCollection->billing_province . ', ' . $dataCollection->billing_postal_code . ', ' . $dataCollection->billing_country . '.',
                'Telp' => $dataCollection->contact_billing_phone,
                // 'email' => $dataCollection->contact_email,
            ],
        ]);

        $items = [];
     
        foreach ($dataCollection->product_order as $cart) {
            $listCart =   (new InvoiceItem())
                ->title($cart->product_name)
                ->description(''.$cart->variant_description.'')
                ->quantity($cart->qty);
                $listCart->product_code = $cart->sku;
                $listCart->note         = $cart->note;

   
            if ($cart->discount_price != null || $cart->discount_price > 0) {

                $listCart->sub_total_price = $cart->qty*$cart->discount_price;
                $reformat                  =  $cart->qty*($cart->acctual_price-$cart->discount_price);
                $listCart                  = $listCart->pricePerUnit($cart->acctual_price);
                $listCart                  = $listCart->discount($reformat);
            }

            else
            {
                $listCart=$listCart->pricePerUnit($cart->purchase_price);
            }

            array_push($items, $listCart);
        }

        $notes = [
            '',
            '',
            '' . $dataCollection->invoice_note . '',

        ];
        $notes = implode("<br>", $notes);

        $invoice = Invoice::make('Invoice')
            ->template('invoice')
            ->status($dataCollection->payment_status)
            ->serialNumberFormat($dataCollection->order_number)
            ->buyer($customer)
            ->date(Carbon::parse($dataCollection->created_at))
            ->dateFormat('d/m/Y')
            ->currencySymbol('Rp')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename($customer->name.'_'.$dataCollection->order_number)
            ->addItems($items)
            ->notes($notes)
            ->logo(public_path('brand/logo_blue.png'));
            // You can additionally save generated invoice to configured disk
            //  ->save('public');
            //  $link = $invoice->url();
      
            $invoice->shipping_amount =  $dataCollection->courier_cost;
            $invoice->companyDetail   =  $companyDetail;
         
            dd($invoice->stream());
            // And return invoice itself to browser or have a different view
            return $invoice->stream();
    }
}
