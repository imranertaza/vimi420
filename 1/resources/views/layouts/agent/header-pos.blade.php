@inject('request', 'Illuminate\Http\Request')
<div class="col-md-12 no-print pos-header">
  <input type="hidden" id="pos_redirect_url" value="{{action('Ecom\EcomCustomerOrderController@getOrders')}}">
  <div class="row">

    <div class="col-md-10">

      <a href="{{ action('CustomerController@index')}}" title="{{ __('lang_v1.go_back') }}" data-toggle="tooltip" data-placement="bottom" class="btn btn-info btn-flat m-6 btn-xs m-5 pull-right">
        <strong><i class="fa fa-backward fa-lg"></i></strong>
      </a>
      
      <button type="button" id="close_register" title="{{ __('cash_register.close_register') }}" data-toggle="tooltip" data-placement="bottom" class="btn btn-danger btn-flat m-6 btn-xs m-5 btn-modal pull-right" data-container=".close_register_modal" 
          data-href="{{ action('CashRegisterController@getCloseRegister')}}">
            <strong><i class="fa fa-window-close fa-lg"></i></strong>
      </button>
      
      <button type="button" id="register_details" title="{{ __('cash_register.register_details') }}" data-toggle="tooltip" data-placement="bottom" class="btn btn-success btn-flat m-6 btn-xs m-5 btn-modal pull-right" data-container=".register_details_modal" 
          data-href="{{ action('CashRegisterController@getRegisterDetails')}}">
            <strong><i class="fa fa-briefcase fa-lg" aria-hidden="true"></i></strong>
      </button>

      <button title="@lang('lang_v1.calculator')" id="btnCalculator" type="button" class="btn btn-success btn-flat pull-right m-5 btn-xs mt-10 popover-default" data-toggle="popover" data-trigger="click" data-content='@include("layouts.partials.calculator")' data-html="true" data-placement="bottom">
            <strong><i class="fa fa-calculator fa-lg" aria-hidden="true"></i></strong>
        </button>

      <button type="button" title="{{ __('lang_v1.hide_pos_popup') }}" data-toggle="tooltip" data-placement="bottom" class="btn btn-info btn-flat m-6 hidden-xs btn-xs m-5 pull-right" id="toggle_popup">
          <strong><i class="fa fa-window-close-o fa-lg"></i></strong>
      </button>

      <button type="button" title="{{ __('lang_v1.full_screen') }}" data-toggle="tooltip" data-placement="bottom" class="btn btn-primary btn-flat m-6 hidden-xs btn-xs m-5 pull-right" id="full_screen">
            <strong><i class="fa fa-window-maximize fa-lg"></i></strong>
      </button>

      <button type="button" title="{{ __('lang_v1.hide_show_products') }}" data-toggle="tooltip" data-placement="bottom" class="btn btn-info btn-flat m-6 hidden-xs btn-xs m-5 pull-right" id="hide_show_products"  style="background: pink;">
        <strong><i class="fa fa-eye fa-lg"></i></strong>
      </button>


      <button type="button" id="view_suspended_sales" title="{{ __('lang_v1.view_suspended_sales') }}" data-toggle="tooltip" data-placement="bottom" class="btn bg-yellow btn-flat m-6 btn-xs m-5 btn-modal pull-right" data-container=".view_modal" 
          data-href="{{ action('SellController@index')}}?suspended=1">
            <strong><i class="fa fa-pause-circle-o fa-lg"></i></strong>
      </button>


      <button id="btnKeyboard" type="button" class="btn btn-flat m-6 hidden-xs btn-xs m-5 pull-right" style="background: yellow;"
      data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="click"
           data-content="@include('sale_pos.partials.keyboard_shortcuts_details')" data-html="true"
           >
        <i  class="fa fa-keyboard-o hover-q text-muted" aria-hidden="true"></i>
     </button>

     <button id="btnLock" title="@lang('lang_v1.lock_screen')" type="button" class="btn btn-success btn-flat pull-right m-6 btn-xs m-5 hidden-xs btn-sm mt-10 popover-default" data-placement="bottom">
        <strong><i class="fa fa-lock fa-lg" aria-hidden="true"></i></strong>
    </button>

      @if(Module::has('Repair'))
        @include('repair::layouts.partials.pos_header')
      @endif

    </div>

    <div class="col-md-2">
      <div class="m-6 pull-right mt-15 hidden-xs"><strong>{{ @format_date('now') }}</strong></div>
    </div>
    
  </div>
</div>
