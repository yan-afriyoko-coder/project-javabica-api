<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ $invoice->name }}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <style type="text/css" media="screen">
            html {
                font-family: sans-serif;
                line-height: 1.15;
                margin: 0;
            }

            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                font-weight: 400;
                line-height: 1.5;
                color: #212529;
                text-align: left;
                background-color: #fff;
                font-size: 10px;
                margin: 36pt;
            }

            h4 {
                margin-top: 0;
                margin-bottom: 0.5rem;
            }

            p {
                margin-top: 0;
                margin-bottom: 0.3rem;
            }

            strong {
                font-weight: bolder;
            }

            img {
                vertical-align: middle;
                border-style: none;
            }

            table {
                border-collapse: collapse;
            }

            th {
                text-align: inherit;
            }

            h4, .h4 {
                margin-bottom: 0.5rem;
                font-weight: 500;
                line-height: 1.2;
            }

            h4, .h4 {
                font-size: 1.5rem;
            }

            .table {
                width: 100%;
                margin-bottom: 1rem;
                color: #212529;
            }

            .table th,
            .table td {
                padding: 0.75rem;
                vertical-align: top;
            }

            .table.table-items td {
                border-top: 1px solid #dee2e6;
            }

            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #dee2e6;
            }

            .mt-5 {
                margin-top: 3rem !important;
            }
            .mt-2 {
                margin-top: 1rem !important;
            }

            /* .pr-0,
            .px-0 {
                padding-right: 0 !important;
            }

            .pl-0,
            .px-0 {
                padding-left: 0 !important;
            }

            .text-right {
                text-align: right !important;
            }

            .text-center {
                text-align: center !important;
            }

            .text-uppercase {
                text-transform: uppercase !important;
            }
            * {
                font-family: "DejaVu Sans";
            }
            body, h1, h2, h3, h4, h5, h6, table, th, tr, td, p, div {
                line-height: 1.1;
            }
            .party-header {
                font-size: 0.8rem;
                font-weight: 700;
            }
            .total-amount {
                font-size: 12px;
                font-weight: 700;
            }
            .border-0 {
                border: none !important;
            }
            .border-1 {
                border: 1px solid #000 !important;
            }
            .border-top-bottom {
                border-top:1px solid #000;
                  border-bottom:1px solid #000;
            }
            .cool-gray {
                color: #6B7280;
            } */
        </style>
    </head>

    <body>
        {{-- Header --}}
        @if($invoice->logo)
          
          
            <table class="table mt-3">
                <tbody class="border-0">
                    <tr>
                        <td  class="border-0 pl-0" width="20%">
                            <img src="{{ $invoice->getLogo() }}" alt="logo" class="p-0" height="40">
                        </td>
                        <td class="border-0">
                            <p style="font-weight:700;margin-bottom:0px">{{$invoice->companyDetail->coporate_name}}</p>
                            <p style="margin-bottom:1px">{{$invoice->companyDetail->address}}</p>
                            <p style="margin-bottom:0px">Telp:{{$invoice->companyDetail->phone}} | email:{{$invoice->companyDetail->email}} | website:{{$invoice->companyDetail->website}} </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif

        <table class="table mt-3">
            <tbody>
                <tr>
                    <td class="border-0 pl-0" width="70%">
                        <h4 class="text-uppercase text-center">
                            <strong>{{ $invoice->name }}</strong> 
                            
                        </h4>
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- Seller - Buyer --}}
        <table class="table">
            <thead>
                <tr>
                    <th class="border-top-bottom pl-0 party-header" >
                        {{ __('invoices::invoice.buyer') }}
                    </th>
                    <th class="border-0" width="1%"></th>
                    <th class="border-top-bottom pl-0 party-header" width="48.5%">     
                        {{ __('invoices::invoice.invoice_info') }}
                    </th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                   
                    <td class="px-0">
                        @if($invoice->buyer->name)
                            <p class="buyer-name">
                                {{ __('invoices::invoice.buyer_name') }}  <strong>{{ $invoice->buyer->name }}</strong>
                            
                            </p>
                            
                        @endif
                        @foreach($invoice->buyer->custom_fields as $key => $value)
                            <p class="buyer-custom-field">
                                {{ ucfirst($key) }}: {{ $value }}
                            </p>
                        @endforeach
                         
                        
                    </td>
                    <td class="px-0">
                       
                    <td  class="px-0">
                        <table class="table px-0" width="100%">
                          <thead>
                            <tr>
                                <td class="border-1 px-1" width="50%">
                                  Date (dd/mm/yyyy)<br/>
                                  <span style="font-weight:700">
                                    {{ $invoice->getDate() }}
                                </span>
                                </td>
                                <td class="border-1" >Invoice No
                                  <span style="font-weight:700">
                                    {{ $invoice->getSerialNumber() }}</span>  
                                </td>
                            </tr>
                            <tr>
                                <td class="border-1">Syarat Pembayaran
                                    <span style="font-weight:700">
                                    <br/>-
                                    </span>
                                </td>
                                <td class="border-1" >No PO
                                    <span style="font-weight:700">
                                    <br />-
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-1">
                                    <span>
                                        {!! DNS2D::getBarcodeHTML(''.$invoice->getSerialNumber().'', 'QRCODE',2,2) !!}
                                    </span>
                                </td>
                                <td class="border-1">
                                    Payment Status
                                    <br/><br/>
                                    @if( $invoice->status == 'SUCCESS')
                                    <span style="color:green;font-weight:700">
                                        {{ $invoice->status }}
                                    </span>
                                    @else 
                                    <span style="font-weight:700">
                                        {{ $invoice->status }}
                                    </span>
                                    @endif
                                </td>
                            </tr>
                          </thead>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- Table --}}
        <table class="table table-items">
            <thead>
                <tr>
                    <th scope="col" class="border-0 pl-0">Kode</th>
                    <th scope="col" class="border-0 pl-0">{{ __('invoices::invoice.description') }}</th>
                    @if($invoice->hasItemUnits)
                        <th scope="col" class="text-center border-0">{{ __('invoices::invoice.units') }}</th>
                    @endif
                    <th scope="col" class="text-center border-0">{{ __('invoices::invoice.quantity') }}</th>
                    <th scope="col" class="text-right border-0">{{ __('invoices::invoice.price') }}</th>
                    @if($invoice->hasItemDiscount)
                        <th scope="col" class="text-right border-0">{{ __('invoices::invoice.discount') }}</th>
                    @endif
                    @if($invoice->hasItemTax)
                        <th scope="col" class="text-right border-0">{{ __('invoices::invoice.tax') }}</th>
                    @endif
                    <th scope="col" class="text-right border-0 pr-0">{{ __('invoices::invoice.sub_total') }}</th>
                </tr>
            </thead>
            <tbody>
                {{-- Items --}}
                @foreach($invoice->items as $item)
                <tr>
                    <td width="20%">
                        {{$item->product_code}}
                    </td>
                    <td class="pl-2"width="30%">
                        {{ $item->title }}
                        @if($item->description)
                            <p class="cool-gray">{{ $item->description }}</p>
                        @endif
                        @if($item->note)
                        <p class="mt-2">catatan:</p>
                        <p class="cool-gray">{{ $item->note }}</p>
                      
                        @endif
                    </td>
                    @if($invoice->hasItemUnits)
                        <td class="text-center">{{ $item->units }}</td>
                    @endif
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">
                        {{ $invoice->formatCurrency($item->price_per_unit) }}
                    </td>
                    @if($invoice->hasItemDiscount)
                        <td class="text-right">
                            {{ $invoice->formatCurrency($item->discount) }}
                        </td>
                    @endif
                    @if($invoice->hasItemTax)
                        <td class="text-right">
                            {{ $invoice->formatCurrency($item->tax) }}
                        </td>
                    @endif

                    <td class="text-right pr-0">
                        {{ $invoice->formatCurrency($item->sub_total_price) }}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td style="border-bottom:1px solid #000;padding-bottom:1rem;padding-top:0.1rem" colspan="6"></td>
                </tr>
               
                {{-- Summary --}}
                <tr>
                    <td style="padding-top:0.2rem" colspan="6"></td>
                </tr>
                <tr >
                    <td class="border-0">
                        Terbilang :
                    </td>
                    <td colspan="5" style="border:1px solid #000;" class="px-2 ">
                        {!!Terbilang::make($invoice->total_amount,' rupiah', 'seniai '); !!}
                    </td>
                </tr>
                @if($invoice->hasItemOrInvoiceDiscount())
                 
                    <tr>
                          </td>
                        <td colspan="{{ $invoice->table_columns - 1 }}" class="border-0"></td>
                        <td class="text-right pl-0">{{ __('invoices::invoice.total_discount') }}</td>
                        <td class="text-right pr-0">
                            {{ $invoice->formatCurrency($invoice->total_discount) }}
                        </td>
                    </tr>
                @endif
                @if($invoice->taxable_amount)
                    <tr>
                        <td colspan="{{ $invoice->table_columns - 1 }}" class="border-0"></td>
                        <td class="text-right pl-0">{{ __('invoices::invoice.taxable_amount') }}</td>
                        <td class="text-right pr-0">
                            {{ $invoice->formatCurrency($invoice->taxable_amount) }}
                        </td>
                    </tr>
                @endif
                @if($invoice->tax_rate)
                    <tr>
                        <td colspan="{{ $invoice->table_columns - 1 }}" class="border-0"></td>
                        <td class="text-right pl-0">{{ __('invoices::invoice.tax_rate') }}</td>
                        <td class="text-right pr-0">
                            {{ $invoice->tax_rate }}%
                        </td>
                    </tr>
                @endif
                @if($invoice->hasItemOrInvoiceTax())
                    <tr>
                        <td colspan="{{ $invoice->table_columns - 1 }}" class="border-0"></td>
                        <td class="text-right pl-0">{{ __('invoices::invoice.total_taxes') }}</td>
                        <td class="text-right pr-0">
                            {{ $invoice->formatCurrency($invoice->total_taxes) }}
                        </td>
                    </tr>
                @endif
                @if($invoice->shipping_amount)
                    <tr>
                        <td colspan="{{ $invoice->table_columns - 1 }}" class="border-0"></td>
                        <td class="text-right pl-0" width="20%">{{ __('invoices::invoice.shipping') }}</td>
                        <td class="text-right pr-0">
                            {{ $invoice->formatCurrency($invoice->shipping_amount) }}
                        </td>
                    </tr>
                @endif
                    <tr>
                        <td colspan="{{ $invoice->table_columns - 1 }}" class="border-0">
                        
                        </span>
                        </td>
                        <td class="text-right pl-0" style="font-weight:700">{{ __('invoices::invoice.total_amount') }}</td>
                        <td class="text-right pr-0 total-amount">
                            {{ $invoice->formatCurrency($invoice->total_amount) }}
                        </td>
                    </tr>
            </tbody>
        </table>
                 
        @if($invoice->notes)
        <table class="table " width="100%">
            <tr  width="80%">
                <td  class="border-1">
                    {{ trans('invoices::invoice.notes') }}: {!! $invoice->notes !!}
                </td>
                <td width="40%" ></td>
            </tr>
        </table>
         
        @endif
        {{-- @if($invoice->notes)
            <p>
                {{ trans('invoices::invoice.notes') }}: {!! $invoice->notes !!}
            </p>
        @endif --}}

        {{-- <p>
            {{ trans('invoices::invoice.amount_in_words') }}: {{ $invoice->getTotalAmountInWords() }}
        </p>
        <p>
            {{ trans('invoices::invoice.pay_until') }}: {{ $invoice->getPayUntilDate() }}
        </p> --}}

        <script type="text/php">
            if (isset($pdf) && $PAGE_COUNT > 1) {
                $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
                $size = 10;
                $font = $fontMetrics->getFont("Verdana");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width);
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size);
            }
        </script>
    </body>
</html>
