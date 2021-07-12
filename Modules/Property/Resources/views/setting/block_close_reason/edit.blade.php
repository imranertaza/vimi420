<div class="modal-dialog" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action('\Modules\Property\Http\Controllers\BlockCloseReasonController@update',
    $block_close_reason->id), 'method' =>
    'post', 'id' => 'block_close_reason_edit_form' ]) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
          aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'property::lang.edit' )</h4>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="form-group col-sm-12">
          {!! Form::label('date', __( 'property::lang.date' ) . ':*') !!}
          {!! Form::text('date', null, ['class' => 'form-control', 'required',
          'readonly', 'placeholder' => __(
          'property::lang.date' )]); !!}
        </div>
        <div class="form-group col-sm-12">
          {!! Form::label('reason', __( 'property::lang.reason' ) . ':*') !!}
          {!! Form::text('reason', $block_close_reason->reason, ['class' => 'form-control', 'placeholder' => __( 'property::lang.reason'), 'id'
          => 'block_close_reason']); !!}
        </div>
      </div>

    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->


<script>
  $('#date').datepicker('setDate', "{{\Carbon::parse($block_close_reason->date)->format('m/d/y')}}");
</script>