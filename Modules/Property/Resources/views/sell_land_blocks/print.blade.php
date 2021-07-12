@extends('layouts.property')
@section('title', __('property::lang.sell_land_blocks'))

@section('content')

<div class="col-md-12 ">
    <div class="col-md-8 col-sm-8 col-xs-8 text-center">
        <h2>{{$business->name}}</h2>
        <p>{{$location_details->landmark}}, {{$location_details->city}}, {{$location_details->state}},
            {{$location_details->zip_code}}, {{$location_details->country}}<br>
        </p>
        <br>
        <p> @lang('property::lang.tel'): {{$location_details->mobile }} &Tab; @lang('property::lang.email'):
            {{$location_details->email }}</p>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-4 text-left">
        <h4 style="margin-top: 25px;">@lang('property::lang.no'): {{$transaction->invoice_no}}</h4>
        <h4>@lang('property::lang.date'): {{@format_date($transaction->transaction_date)}}</h4>
        <h4>@lang('property::lang.reg_no'): {{$business->reg_no}}</h4>
    </div>
</div>
<div class="clearfix"></div>
<div class="row text-center">
    <h1>@lang('property::lang.invoice')</h1>
</div>
<div class="clearfix"></div>
<div class="col-md-6 col-sm-6 col-xs-6">
    <p>@lang('property::lang.customer'): <strong>{{$contact->name}}</strong><br>
        {{ $contact->address }} <br>
        {{ $contact->city }} <br>
        @lang('property::lang.customer_mobile'): {{$contact->mobile}} <br>
        @lang('property::lang.customer_nic_passport'): @if(!empty($contact->tax_number)){{$contact->tax_number}} @endif
    </p>
</div>
<div class="col-md-6 col-sm-6 col-xs-6">
    <p>
        @lang('property::lang.project_name'): {{$property->name}} <br>
        @lang('property::lang.block_no'): {{implode(',', $sold_block_nos)}} <br>
        @lang('property::lang.e_p_no'): <br>
        @lang('property::lang.tem_receipt_no'): <br>
    </p>
</div>
<div class="clearfix"></div>
<div class="col-md-12">
    <table class="table table-striped" id="payment_added_table">
        <thead>
            <tr>
                <th>{{ __('property::lang.index') }}</th>
                <th>{{ __('property::lang.on_account_of') }}</th>
                <th>{{ __('property::lang.amount') }}</th>
            </tr>
        </thead>

        <tbody>
            @php
            $i =1;
            @endphp
            @foreach ($payments as $payment)
            <tr>
                <td>{{$i}}</td>
                <td>{{$payment->on_account_of}}</td>
                <td>{{@num_format($payment->amount)}}</td>
            </tr>

            @php
            $i++;
            @endphp
            @endforeach
            <tr>
                <td class="text-right" colspan="2">@lang('property::lang.total')</td>
                <td>{{@num_format($payments->sum('amount'))}}</td>
            </tr>
        </tbody>
    </table>
    <table class="table table-striped" id="payment_added_table">
        <thead>
            <tr>
                <th>{{ __('property::lang.payment_method') }}</th>
                <th>{{ __('property::lang.cheque_no') }}</th>
                <th>{{ __('property::lang.bank') }}</th>
                <th>{{ __('property::lang.branch') }}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($payments as $item)
            <tr>
                <td>
                    @if($item->method == 'bank_transfer')
                    @lang('property::lang.bank')
                    @else
                    {{ucfirst($item->method)}}
                    @endif
                </td>
                <td>{{$item->cheque_number}}</td>
                <td>{{$payment->bank_name}}</td>
                <td>{{$payment->branch}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="clearfix"></div>
<div class="row text-center">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">
            .................... <br>
            @lang('property::lang.customer_signature')
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
            .................... <br>
            @lang('property::lang.cashier')
        </div>
    </div>

</div>
@endsection