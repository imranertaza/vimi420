<div class="modal-dialog" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action('ContactGroupController@store'), 'method' => 'post', 'id' => 'contact_group_add_form' ]) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'lang_v1.contact_group' )</h4>
    </div>
    <input type="hidden" name="type" value="{{$type}}">
    <div class="modal-body">
      <div class="form-group">
        {!! Form::label('name', __( 'lang_v1.contact_group_name' ) . ':*') !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.contact_group_name' ) ]); !!}
      </div>

      <div class="form-group">
        {!! Form::label('amount', __( 'lang_v1.calculation_percentage' ) . ':') !!}
        @if(!empty($help_explanations['calculation_percentage'])) @show_tooltip($help_explanations['calculation_percentage']) @endif
        {!! Form::text('amount', null, ['class' => 'form-control input_number','placeholder' => __( 'lang_v1.calculation_percentage')]); !!}
      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->