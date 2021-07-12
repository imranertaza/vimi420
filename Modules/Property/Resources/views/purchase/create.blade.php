<!-- Main content -->
<section class="content">
	<style>
		.select2 {
			width: 100% !important;
		}
	</style>
	<!-- Page level currency setting -->
	<input type="hidden" id="p_code" value="{{$currency_details->code}}">
	<input type="hidden" id="p_symbol" value="{{$currency_details->symbol}}">
	<input type="hidden" id="p_thousand" value="{{$currency_details->thousand_separator}}">
	<input type="hidden" id="p_decimal" value="{{$currency_details->decimal_separator}}">

	@include('layouts.partials.error')

	{!! Form::open(['url' => action('\Modules\Property\Http\Controllers\PurchaseController@store'), 'method' => 'post', 'id' => 'add_purchase_form',
	'files' => true ]) !!}
	@component('components.widget', ['class' => 'box-primary'])
	<div class="row">
		<div class="@if(!empty($default_purchase_status)) col-sm-4 @else col-sm-3 @endif">
			<div class="form-group">
				{!! Form::label('purchase_no', __('property::lang.property_purchase_no').':') !!}
				{!! Form::text('invoice_no', !empty($purchase_no) ? $purchase_no : 1, ['class' => 'form-control',
				'readonly'] ); !!}
			</div>
		</div>

		<div class="col-sm-3">
			<div class="form-group">
				{!! Form::label('location_id', __('purchase.business_location').':*') !!}
				@show_tooltip(__('tooltip.purchase_location'))
				{!! Form::select('location_id', $business_locations, null, ['class' => 'form-control
				select2 business_location_id', 'placeholder' => __('messages.please_select'), 'required', 'id' =>
				'location_id_add',
				'data-default_accounts' => '']); !!}
			</div>
		</div>


		<div class="@if(!empty($default_purchase_status)) col-sm-4 @else col-sm-3 @endif">
			<div class="form-group">
				{!! Form::label('contact_id', __('property::lang.property_seller') . ':*') !!}
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-user"></i>
					</span>
					{!! Form::select('contact_id', [], null,
					['class' => 'form-control select2', 'placeholder' =>
					__('messages.please_select'), 'required', 'id' => 'contact_id']); !!}
					<span class="input-group-btn">
						<button type="button" class="btn btn-default bg-white btn-flat add_new_supplier" data-name=""><i
								class="fa fa-plus-circle text-primary fa-lg"></i></button>
					</span>
				</div>
			</div>
		</div>
		<div class="@if(!empty($default_purchase_status)) col-sm-4 @else col-sm-3 @endif">
			<div class="form-group">
				{!! Form::label('deed_date', __('property::lang.deed_date').':') !!}
				{!! Form::text('deed_date', null, ['class' =>
				'form-control deed_date', 'placeholder' => __('property::lang.deed_date')]); !!}
			</div>
		</div>
		<div class="@if(!empty($default_purchase_status)) col-sm-4 @else col-sm-3 @endif">
			<div class="form-group">
				{!! Form::label('deed_no', __('property::lang.deed_no').':') !!}
				{!! Form::text('deed_no', null, ['class' =>
				'form-control', 'placeholder' => __('property::lang.deed_no')]); !!}
			</div>
		</div>

		<div class="col-sm-3 @if(!empty($default_purchase_status)) hide @endif">
			<div class="form-group">
				{!! Form::label('status', __('purchase.purchase_status') . ':*') !!}
				@show_tooltip(__('tooltip.order_status'))
				{!! Form::select('status', $orderStatuses, $default_purchase_status, ['class' => 'form-control
				select2',
				'placeholder' => __('messages.please_select'), 'required']); !!}
			</div>
		</div>

		<div class="col-sm-3">
			<div class="form-group">
				{!! Form::label('property_name', __('property::lang.property_name').':*') !!}
				{!! Form::text('property_name', null, ['class' =>
				'form-control', 'placeholder' => __('property::lang.property_name'), 'required']); !!}
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				{!! Form::label('property_extent', __('property::lang.property_extent').':*') !!}
				{!! Form::text('property_extent', null, ['class' =>
				'form-control', 'placeholder' => __('property::lang.property_extent')]); !!}
			</div>
		</div>

		<div class="col-sm-3 @if(!empty($default_purchase_status)) hide @endif">
			<div class="form-group">
				{!! Form::label('unit_id', __('property::lang.units') . ':*') !!}
				{!! Form::select('unit_id', $units, null, ['class' => 'form-control
				select2',
				'placeholder' => __('messages.please_select'), 'required']); !!}
			</div>
		</div>

		<div class="col-sm-3">
			<div class="form-group">
				{!! Form::label('amount', __('property::lang.property_amount').':*') !!}
				{!! Form::text('final_total', null, ['class' =>
				'form-control', 'placeholder' => __('property::lang.property_amount'), 'id' => 'final_total']); !!}
			</div>
		</div>
		<!-- Currency Exchange Rate -->
		<div class="col-sm-3 @if(!$currency_details->purchase_in_diff_currency) hide @endif">
			<div class="form-group">
				{!! Form::label('exchange_rate', __('purchase.p_exchange_rate') . ':*') !!}
				@show_tooltip(__('tooltip.currency_exchange_factor'))
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-info"></i>
					</span>
					{!! Form::number('exchange_rate',
					!empty($temp_data->exchange_rate)?$temp_data->exchange_rate:$currency_details->p_exchange_rate,
					['class' => 'form-control',
					'required', 'step' => 0.001]); !!}
				</div>
				<span class="help-block text-danger">
					@lang('purchase.diff_purchase_currency_help', ['currency' => $currency_details->name])
				</span>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				<div class="multi-input">
					{!! Form::label('pay_term_number', __('contact.pay_term') . ':') !!}
					@show_tooltip(__('tooltip.pay_term'))
					<br />
					{!! Form::number('pay_term_number', !empty($temp_data->pay_term_number)?$temp_data->pay_term_number:
					null, ['class' => 'form-control width-40 pull-left',
					'placeholder' => __('contact.pay_term')]); !!}

					{!! Form::select('pay_term_type',
					['months' => __('lang_v1.months'),
					'days' => __('lang_v1.days')],
					!empty($temp_data->pay_term_type)?$temp_data->pay_term_type: null,
					['class' => 'form-control width-60 pull-left','placeholder' => __('messages.please_select'), 'id' =>
					'pay_term_type']); !!}
				</div>
			</div>
		</div>

		<div class="col-sm-3">
			<div class="form-group">
				{!! Form::label('document', __('purchase.attach_document') . ':') !!}
				{!! Form::file('document', ['id' => 'upload_document', 'multiple']); !!}
				<p class="help-block">@lang('purchase.max_file_size', ['size' =>
					(config('constants.document_size_limit') / 1000000)])</p>
			</div>
		</div>
	</div>
	@endcomponent
	

	@component('components.widget', ['class' => 'box-primary', 'title' => __('purchase.add_payment')])
	<div class="box-body payment_row" data-row_id="0">
		<div id="payment_rows_div">
			@if (!empty($temp_data->payment))
			@include('sale_pos.partials.payment_row_form', ['row_index' => 0, 'payment' => $temp_data->payment[0]])
			@else
			@include('sale_pos.partials.payment_row_form', ['row_index' => 0])
			@endif
			<hr>
		</div>

		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-primary btn-block"
					id="add-payment-row">@lang('sale.add_payment_row')</button>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="pull-right"><strong>@lang('purchase.payment_due'):</strong> <span
						id="payment_due">0.00</span>
				</div>

			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-12">
				<button type="button" id="submit_purchase_form"
					class="btn btn-primary pull-right btn-flat">@lang('messages.save')</button>
			</div>
		</div>
	</div>
	@endcomponent

	{!! Form::close() !!}
</section>
