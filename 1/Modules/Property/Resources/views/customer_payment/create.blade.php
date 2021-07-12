@extends('layouts.'.$layout)
@section('content')
<style>
  #key_pad input {
    border: none
  }

  #key_pad button {
    height: 70px;
    width: 70px;
    font-size: 30px;
    margin: 2px 1px;
    border: none !important;
    /* padding: 50px 50px; */
    color: #fff;
  }

  :focus {
    outline: 0 !important
  }

  #key_pad .screen {
    width: 100px;
    height: 36px;
    border-radius: 3px;
    padding: 10px;
    margin: 2px 24px;
    font-size: 15px;
    font-weight: 700;
    background: #8e9eab
  }

  #key_pad .small {
    color: #fff;
    font-weight: 700
  }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h2 style="margin-top:0px;margin-bottom:0px; ">{{ __('property::lang.customer_poayment_dashboard') }}
  </h2>
</section>
<section class="content no-print">
  <form name="calculator">
    <div class="container">
      <div class="clearfix"></div>
      <br>
      <div class="row">
        <div class="col-md-12 col-lg-12 ">
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                {!! Form::label('customer_id', __('property::lang.customer').':*') !!}
                {!! Form::select('customer_id', $customers, null, ['class' => 'form-control reset
                select2 customer_id', 'placeholder' => __('messages.please_select'), 'required', 'id' =>
                'customer_id']); !!}
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                {!! Form::label('property_id', __('property::lang.property').':*') !!}
                {!! Form::select('property_id', $land_and_blocks, null, ['class' => 'form-control reset
                select2 property_id', 'placeholder' => __('messages.please_select'), 'required', 'id' =>
                'property_id']); !!}
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                {!! Form::label('installment', __('property::lang.original_amount').':*') !!}
                {!! Form::text('original_amount', null, ['class' => 'form-control reset
                original_amount', 'required', 'id' =>
                'original_amount']); !!}
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                {!! Form::label('installment', __('property::lang.installment').':*') !!}
                {!! Form::text('installment', null, ['class' => 'form-control reset
                installment', 'required', 'id' =>
                'installment']); !!}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <br>
      <br>
      <br>
      <div class="row">
        <div class="col-md-12 col-lg-12">
          <div class="col-md-4 col-lg-4 ">
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('overdue_amount', __('property::lang.overdue_amount').':*') !!}
              </div>
              <div class="col-md-6">
                {!! Form::text('overdue_amount', null, ['class' => 'form-control reset
                overdue_amount', 'placeholder' => __('property::lang.overdue_amount'), 'required', 'id' =>
                'overdue_amount']); !!}
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('penalty_amount', __('property::lang.penalty_amount').':*') !!}
              </div>
              <div class="col-md-6">
                {!! Form::text('penalty_amount', null, ['class' => 'form-control reset
                penalty_amount', 'placeholder' => __('property::lang.penalty_amount'), 'required', 'id' =>
                'penalty_amount']); !!}
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('total_overdue', __('property::lang.total_overdue').':*') !!}
              </div>
              <div class="col-md-6">
                {!! Form::text('total_overdue', null, ['class' => 'form-control reset
                total_overdue', 'placeholder' => __('property::lang.total_overdue'), 'required', 'id' =>
                'total_overdue']); !!}
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('total_due', __('property::lang.total_due').':*') !!}
              </div>
              <div class="col-md-6">
                {!! Form::text('total_due', null, ['class' => 'form-control reset
                total_due', 'placeholder' => __('property::lang.total_due'), 'required', 'id' =>
                'total_due']); !!}
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('pay_amount', __('property::lang.pay_amount').':*') !!}
              </div>
              <div class="col-md-6">
                {!! Form::text('pay_amount', null, ['class' => 'form-control reset
                pay_amount', 'placeholder' => __('property::lang.pay_amount'), 'required', 'id' =>
                'pay_amount']); !!}
              </div>
            </div>

          </div>
          <div id="key_pad" class="row col-md-6 text-center">
            <div class="row">
              <button id="7" type="button" class="btn btn-primary btn-sm" onclick="enterVal(this.id)">7</button>
              <button id="8" type="button" class="btn btn-primary btn-sm" onclick="enterVal(this.id)">8</button>
              <button id="9" type="button" class="btn btn-primary btn-sm" onclick="enterVal(this.id)">9</button>

            </div>
            <div class="row">
              <button id="4" type="button" class="btn btn-primary btn-sm" onclick="enterVal(this.id)">4</button>
              <button id="5" type="button" class="btn btn-primary btn-sm" onclick="enterVal(this.id)">5</button>
              <button id="6" type="button" class="btn btn-primary btn-sm" onclick="enterVal(this.id)">6</button>
            </div>
            <div class="row">
              <button id="1" type="button" class="btn btn-primary btn-sm" onclick="enterVal(this.id)">1</button>
              <button id="2" type="button" class="btn btn-primary btn-sm" onclick="enterVal(this.id)">2</button>
              <button id="3" type="button" class="btn btn-primary btn-sm" onclick="enterVal(this.id)">3</button>
            </div>
            <div class="row">
              <button id="backspace" type="button" class="btn btn-danger" onclick="enterVal(this.id)">⌫</button>
              <button id="0" type="button" class="btn btn-primary btn-sm" onclick="enterVal(this.id)">0</button>
              <button id="precision" type="button" class="btn btn-success" onclick="enterVal(this.id)">.</button>
            </div>
          </div>


          <div class="col-md-2 col-lg-2">
            <div class="row">
              <a href="{{action('\Modules\Property\Http\Controllers\SaleAndCustomerPaymentController@dashboard')}}"><input
                  value="Dashboard" class="btn btn-flat btn-lg btn-block" style="color: #fff;background-color:#810040;"
                  type="button" />
              </a>
              <br /><br />
              <button value="save" id="submit" name="submit" class="btn btn-flat btn-lg btn-block"
                style="color: #fff; background-color:#2874A6;" type="button">@lang('lang_v1.save') </button>
              <br /><br />
              <span onclick="reset()">
                <button type="button" class="btn btn-flat btn-lg btn-block"
                  style="color: #fff; background-color:#CC0000;" type="button"> <i class="fa fa-refresh"
                    aria-hidden="true"></i> @lang('petro::lang.cancel') </button>
              </span>
              <br>
              <br>
              <a href="{{action('Auth\PumpOperatorLoginController@logout')}}"
                class="btn btn-flat btn-block btn-lg pull-right"
                style=" background-color: orange; color: #fff;">@lang('petro::lang.logout')</a>
            </div>

          </div>
        </div>
      </div>
      <div class="row text-center">
        <a href="{{action('Auth\PropertyUserLoginController@logout', ['main_system' => true])}}" type="button"
          style="font-size: 19px; background: #9900cc; color: #fff;" class="btn btn-flat m-8  btn-sm mt-10">
          <strong>@lang('lang_v1.main_system')</strong></a>
      </div>

    </div>
    <div class="modal" id="payment_modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document" style="width: 70%">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">@lang('property::lang.payment')</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-2">
                {!! Form::label('cash', __('property::lang.cash').':*') !!}
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('cash', __('property::lang.amount').':*') !!}
                  {!! Form::text('payment[cash][amount]', null, ['class' => 'form-control reset
                  cash', 'placeholder' => __('property::lang.amount'), 'required', 'id' =>
                  'cash']); !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                {!! Form::label('credit_card', __('property::lang.credit_card').':*') !!}
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('cheuqe', __('property::lang.amount').':*') !!}
                  {!! Form::text('payment[credit_card][amount]', null, ['class' => 'form-control reset
                  cheuqe', 'placeholder' => __('property::lang.amount'), 'required', 'id' =>
                  'cheuqe']); !!}
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('card_no', __('property::lang.card_no').':*') !!}
                  {!! Form::text('payment[credit_card][card_no]', null, ['class' => 'form-control reset
                  card_no', 'placeholder' => __('property::lang.card_no'), 'required', 'id' =>
                  'card_no']); !!}
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('expiry_date', __('property::lang.expiry_date').':*') !!}
                  {!! Form::text('payment[credit_card][expiry_date]', null, ['class' => 'form-control reset
                  expiry_date', 'placeholder' => __('property::lang.expiry_date'), 'required', 'id' =>
                  'expiry_date']); !!}
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-md-2">
                {!! Form::label('cheque', __('property::lang.cheque').':*') !!}
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('cheuqe', __('property::lang.amount').':*') !!}
                  {!! Form::text('payment[cheuqe][amount]', null, ['class' => 'form-control reset
                  cheuqe', 'placeholder' => __('property::lang.amount'), 'required', 'id' =>
                  'cheuqe']); !!}
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('cheque_no', __('property::lang.cheque_no').':*') !!}
                  {!! Form::text('payment[cheuqe][cheque_no]', null, ['class' => 'form-control reset
                  cheque_no', 'placeholder' => __('property::lang.cheque_no'), 'required', 'id' =>
                  'cheque_no']); !!}
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('bank', __('property::lang.bank').':*') !!}
                  {!! Form::text('payment[cheuqe][bank]', null, ['class' => 'form-control reset
                  bank', 'placeholder' => __('property::lang.bank'), 'required', 'id' =>
                  'bank']); !!}
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('branch', __('property::lang.branch').':*') !!}
                  {!! Form::text('payment[cheuqe][branch]', null, ['class' => 'form-control reset
                  branch', 'placeholder' => __('property::lang.branch'), 'required', 'id' =>
                  'branch']); !!}
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('cheque_date', __('property::lang.cheque_date').':*') !!}
                  {!! Form::text('payment[cheuqe][cheque_date]', null, ['class' => 'form-control reset
                  cheque_date', 'placeholder' => __('property::lang.cheque_date'), 'required', 'id' =>
                  'cheque_date']); !!}
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">@lang('messages.save')</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('messages.close')</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>
@endsection

@section('javascript')
<script>
  $('.cheque_date').datepicker('setDate', new Date())
  $('.pay_amount').click(function(){
    $('#payment_modal').modal('show');

  });
  $('#submit').click(function(){
    let amount = $('#amount').val();
    let payment_type = $('#payment_type').val();
    if(amount === '' || amount === undefined ){
      toastr.error('Please enter amount');
      return false
    }
    if(payment_type === '' || payment_type === undefined){
      toastr.error('Please select payment type');
      return false
    }
    amount = parseFloat(amount);
    console.log(amount);
    $.ajax({
      method: 'POST',
      url: "{{action('\Modules\Petro\Http\Controllers\PumpOperatorPaymentController@store')}}",
      data: { amount, payment_type },
      success: function(result) {
        if(result.success){
          toastr.success(result.msg);
          reset();
        }else{
          toastr.error(result.msg)
        }
      },
    });
  })

  function reset() {
    console.log('reset');
    $('.reset').val('');
  }
</script>
<script>
  function enterVal(val) {
        $('#amount').focus();
        if(val === 'precision'){
            str = $('#amount').val();
            str = str + '.';
            $('#amount').val(str);
            return;
        }
        if(val === 'backspace'){
            str = $('#amount').val();
            str = str.substring(0, str.length - 1);
            $('#amount').val(str);
            return;
        }
        let amount = $('#amount').val() + val;
        amount = amount.replace(',', '');
        $('#amount').val(amount);
    };
   
   $('#customer_id').change(function () {
      let customer_id = $(this).val();
      $.ajax({
        method: 'GET',
        url: '/property/customer-payment/get-property-dropdown-by-customer-id/'+customer_id,
        contentType: 'html',
        data: {  },
        success: function(result) {
            $('#property_id').empty().append(result);
        },
      });
   })
</script>
@endsection