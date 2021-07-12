<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      @component('components.filters', ['title' => __('report.filters')])
      <div class="col-md-3">
        <div class="form-group">
          {!! Form::label('route_invoice_number_date_range_filter', __('report.date_range') . ':') !!}
          {!! Form::text('route_invoice_number_date_range_filter', @format_date('first day of this month') . ' ~ ' .
          @format_date('last
          day of this month') , ['placeholder' => __('lang_v1.select_a_date_range'), 'class' =>
          'form-control date_range', 'id' => 'route_invoice_number_date_range_filter', 'readonly']); !!}
        </div>
      </div>
      @endcomponent
    </div>
  </div>
  @component('components.widget', ['class' => 'box-primary', 'title' => __('fleet::lang.all_your_starting_invoice_number')])
  @slot('tool')
  <div class="box-tools ">
    <button type="button" class="btn  btn-primary btn-modal"
      data-href="{{action('\Modules\Fleet\Http\Controllers\RouteInvoiceNumberController@create')}}" data-container=".view_modal">
      <i class="fa fa-plus"></i> @lang('messages.add')</button>

  </div>
  @endslot
  <div class="table-responsive">
    <table class="table table-bordered table-striped" id="route_invoice_number_table" style="width: 100%;">
      <thead>
        <tr>
          <th class="notexport">@lang('messages.action')</th>
          <th>@lang('fleet::lang.date')</th>
          <th>@lang('fleet::lang.prefix')</th>
          <th>@lang('fleet::lang.starting_number')</th>
          <th>@lang('fleet::lang.added_by')</th>
        </tr>
      </thead>
    </table>
  </div>
  @endcomponent
</section>
<!-- /.content -->