<div class="modal-dialog" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action('\Modules\Member\Http\Controllers\ServiceAreasController@store'), 'method' =>
    'post', 'id' => 'service_areas_form' ])
    !!}
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
          aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'member::lang.add_service_areas' )</h4>
    </div>

    <div class="modal-body">
      <div class="form-group">
        {!! Form::label('date', __( 'member::lang.date' )) !!}
        {!! Form::text('date', date('m/d/Y'), ['class' => 'form-control', 'required', 'placeholder' => __( 'member::lang.date' ),
        'id' => 'service_areas_date']);
        !!}
      </div>
      <div class="form-group">
        {!! Form::label('service_areas', __( 'member::lang.service_areas' )) !!}
        {!! Form::text('service_area', null, ['class' => 'form-control', 'required', 'placeholder' => __(
        'member::lang.service_areas' ), 'id' => 'service_areas_name']);
        !!}
      </div>

    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary" id="save_service_areas_btn">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script>
  $('#service_areas_date').datepicker({
        format: 'mm/dd/yyyy'
    });
</script>