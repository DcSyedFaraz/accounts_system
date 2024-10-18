@php
    $settings_data = \App\Models\Utility::settingsById($proposal->created_by);

@endphp
<!DOCTYPE html>
<html lang="en" dir="{{ $settings_data['SITE_RTL'] == 'on' ? 'rtl' : '' }}">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">


    <style type="text/css">
        :root {
            --theme-color: {{ $color }};
            --white: #ffffff;
            --black: #000000;
        }

        body {
            font-family: 'Lato', sans-serif;
        }

        p,
        li,
        ul,
        ol {
            margin: 0;
            padding: 0;
            list-style: none;
            line-height: 1.5;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table tr th {
            padding: 0.75rem;
            text-align: left;
        }

        table tr td {
            padding: 0.75rem;
            text-align: left;
        }

        table th small {
            display: block;
            font-size: 12px;
        }

        .proposal-preview-main {
            max-width: 700px;
            width: 100%;
            margin: 0 auto;
            background: #ffff;
            box-shadow: 0 0 10px #ddd;
        }

        .proposal-logo {
            max-width: 200px;
            width: 100%;
        }

        .proposal-header table td {
            padding: 15px 30px;
        }

        .text-right {
            text-align: right;
        }

        .no-space tr td {
            padding: 0;
        }

        .vertical-align-top td {
            vertical-align: top;
        }

        .view-qrcode {
            max-width: 114px;
            height: 114px;
            margin-left: auto;
            margin-top: 15px;
            background: var(--white);
        }

        .view-qrcode img {
            width: 100%;
            height: 100%;
        }

        .proposal-body {
            padding: 30px 25px 0;
        }

        table.add-border tr {
            border-top: 1px solid var(--theme-color);
        }

        tfoot tr:first-of-type {
            border-bottom: 1px solid var(--theme-color);
        }

        .total-table tr:first-of-type td {
            padding-top: 0;
        }

        .total-table tr:first-of-type {
            border-top: 0;
        }

        .sub-total {
            padding-right: 0;
            padding-left: 0;
        }

        .border-0 {
            border: none !important;
        }

        .proposal-summary td,
        .proposal-summary th {
            font-size: 13px;
            font-weight: 600;
        }

        .total-table td:last-of-type {
            width: 146px;
        }

        .proposal-footer {
            padding: 15px 20px;
        }

        .itm-description td {
            padding-top: 0;
        }

        html[dir="rtl"] table tr td,
        html[dir="rtl"] table tr th {
            text-align: right;
        }

        html[dir="rtl"] .text-right {
            text-align: left;
        }

        html[dir="rtl"] .view-qrcode {
            margin-left: 0;
            margin-right: auto;
        }

        p:not(:last-of-type) {
            margin-bottom: 15px;
        }

        .proposal-summary p {
            margin-bottom: 0;
        }

        .proposal-footer h6 {
            font-size: 45px;
            line-height: 1.2em;
            font-weight: 400;
            margin-top: 15px;
            color: var(--theme-color);
        }
    </style>

    @if (env('SITE_RTL') == 'on')
        <link rel="stylesheet" href="{{ asset('css/bootstrap-rtl.css') }}">
    @endif
</head>

<body>

    <div class="proposal-preview-main" id="boxes" style="border-right:40px solid var(--theme-color);">
        <div class="proposal-header">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <h3
                                style="text-transform: uppercase; font-size: 40px; font-weight: bold; color: var(--theme-color); margin-bottom: 10px;">
                                {{ __('PROPOSAL') }}</h3>
                            <table class="no-space" style="width: 70%;">
                                <tbody>
                                    <tr>
                                        <td>{{ __('Number') }}:</td>
                                        <td class="text-right">
                                            {{ Utility::proposalNumberFormat($settings, $proposal->proposal_id) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Issue Date') }}:</td>
                                        <td class="text-right">
                                            {{ Utility::dateFormat($settings, $proposal->issue_date) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Due Date') }}:</td>
                                        <td class="text-right">
                                            {{ Utility::dateFormat($settings, $proposal->issue_date) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td class="text-right">
                            <img class="proposal-logo" src="{{ $img }}" alt="">
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="vertical-align-top">
                <tbody>
                    <tr>
                        <td>
                            <p>
                                @if ($settings['company_name'])
                                    {{ $settings['company_name'] }}
                                @endif
                                <br>
                                @if ($settings['company_email'])
                                    {{ $settings['company_email'] }}
                                @endif
                                <br>
                                @if ($settings['company_telephone'])
                                    {{ $settings['company_telephone'] }}
                                @endif
                                <br>
                                @if ($settings['company_address'])
                                    {{ $settings['company_address'] }}
                                @endif
                                @if ($settings['company_city'])
                                    <br> {{ $settings['company_city'] }},
                                @endif
                                @if ($settings['company_state'])
                                    {{ $settings['company_state'] }}
                                @endif
                                @if ($settings['company_country'])
                                    <br>{{ $settings['company_country'] }}
                                @endif
                                @if ($settings['company_zipcode'])
                                    - {{ $settings['company_zipcode'] }}
                                @endif
                                <br>
                                @if (!empty($settings['registration_number']))
                                    {{ __('Registration Number') }} : {{ $settings['registration_number'] }}
                                @endif

                                @if (App\Models\Utility::getValByName('tax_number') == 'on')
                                    @if (!empty($settings['tax_type']) && !empty($settings['vat_number']))<br>
                                        {{ $settings['tax_type'] . ' ' . __('Number') }} : {{ $settings['vat_number'] }}
                                        <br>
                                    @endif
                                @endif
                            </p>
                        </td>
                        <td>
                            <table class="no-space">
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <div class="view-qrcode" style="margin-top: 0;">
                                                {!! DNS2D::getBarcodeHTML(route('pay.proposalpay', \Crypt::encrypt($proposal->proposal_id)), 'QRCODE', 2, 2) !!}
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                    <tr>
                        <td>
                            <strong style="margin-bottom: 10px; display:block;">{{ __('Bill To') }}:</strong>
                            <p>
                                {{ !empty($customer->billing_name) ? $customer->billing_name : '' }}<br>
                                {{ !empty($customer->billing_phone) ? $customer->billing_phone : '' }}<br>
                                {{ !empty($customer->billing_address) ? $customer->billing_address : '' }}<br>
                                {{ !empty($customer->billing_city) ? $customer->billing_city : '' . ', ' }},
                                {{ !empty($customer->billing_state) ? $customer->billing_state : ''. ', ' }},
                                {{ !empty($customer->billing_country) ? $customer->billing_country : '' }}<br>
                                {{ !empty($customer->billing_zip) ? $customer->billing_zip : '' }}<br>
                            </p>
                        </td>
                        @if ($settings['shipping_display'] == 'on')
                            <td class="text-right">
                                <strong style="margin-bottom: 10px; display:block;">{{ __('Ship To') }}:</strong>
                                <p>
                                    {{ !empty($customer->shipping_name) ? $customer->shipping_name : '' }}<br>
                                    {{ !empty($customer->shipping_phone) ? $customer->shipping_phone : '' }}<br>
                                    {{ !empty($customer->shipping_address) ? $customer->shipping_address : '' }}<br>
                                    {{ !empty($customer->shipping_city) ? $customer->shipping_city : '' . ', ' }},
                                    {{ !empty($customer->shipping_state) ? $customer->shipping_state : '' . ', ' }},
                                    {{ !empty($customer->shipping_country) ? $customer->shipping_country : '' }}<br>
                                    {{ !empty($customer->shipping_zip) ? $customer->shipping_zip : '' }}<br>
                                </p>
                            </td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="proposal-body" style="padding-right: 0;">
            <table class="add-border proposal-summary">
                <thead style="background-color: var(--theme-color);color: var(--white);">
                    <tr>
                        <th>{{ __('Item') }}</th>
                        <th>{{ __('Quantity') }}</th>
                        <th>{{ __('Rate') }}</th>
                        <th>{{ __('Discount') }}</th>
                        <th>{{ __('Tax') }} (%)</th>
                        <th>{{ __('Price') }} <small>after tax & discount</small></th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($proposal->itemData) && count($proposal->itemData) > 0)
                        @foreach ($proposal->itemData as $key => $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ Utility::priceFormat($settings, $item->price) }}</td>
                                <td>{{ $item->discount != 0 ? Utility::priceFormat($settings, $item->discount) : '-' }}</td>
                                <td>
                                    @if (!empty($item->itemTax))
                                        @php
                                            $itemtax = 0;
                                        @endphp
                                        @foreach ($item->itemTax as $taxes)
                                            @php
                                                $itemtax += $taxes['tax_price'];
                                            @endphp
                                            <p>{{ $taxes['name'] }} ({{ $taxes['rate'] }}) {{ $taxes['price'] }}</p>
                                        @endforeach
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                                <td>{{ Utility::priceFormat($settings, $item->price * $item->quantity - $item->discount + $itemtax) }}
                                </td>
                                @if (!empty($item->description))
                            <tr class="border-0 itm-description">
                                <td colspan="6" style="border-bottom:1px solid {{ $color }};">
                                    {{ $item->description }}</td>
                            </tr>
                        @endif
                        </tr>
                    @endforeach
                @else
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td>{{ __('Total') }}</td>
                        <td>{{ $proposal->totalQuantity }}</td>
                        <td>{{ Utility::priceFormat($settings, $proposal->totalRate) }}</td>
                        <td>{{ Utility::priceFormat($settings, $proposal->totalDiscount) }}</td>
                        <td>{{ Utility::priceFormat($settings, $proposal->totalTaxPrice) }}</td>
                        <td>{{ Utility::priceFormat($settings, $proposal->getSubTotal()) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="2" class="sub-total">
                            <table class="total-table">
                                <tr>
                                    <td>{{ __('Subtotal') }}:</td>
                                    <td>{{ Utility::priceFormat($settings, $proposal->getSubTotal()) }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Discount') }}:</td>
                                    <td>{{ Utility::priceFormat($settings, $proposal->getTotalDiscount()) }}</td>
                                </tr>
                                @if (!empty($proposal->taxesData))
                                    @foreach ($proposal->taxesData as $taxName => $taxPrice)
                                        <tr>
                                            <td>{{ $taxName }} :</td>
                                            <td>{{ Utility::priceFormat($settings, $taxPrice) }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr>
                                    <td>{{ __('Total') }}:</td>
                                    <td>{{ Utility::priceFormat($settings, $proposal->getSubTotal() - $proposal->getTotalDiscount() + $proposal->getTotalTax()) }}
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <div class="proposal-footer">
                <p>
                    {{ $settings['footer_title'] }} <br>
                    {{ $settings['footer_notes'] }}
                </p>
            </div>
        </div>
    </div>

    @if (!isset($preview))
        @include('proposal.script');
    @endif

</body>

</html>
