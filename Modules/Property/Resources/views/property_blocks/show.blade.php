<div class="modal-dialog" role="document" style="width: 55%;">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@lang( 'property::lang.blocks_details' )</h4>
        </div>

        <div class="modal-body">
            <div class="row">

                <input type="hidden" name="property_id" value="{{$property->id}}">
                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('land_name', __( 'property::lang.land_name' )) !!} : {{$property->name}}
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('block_customer_id', __('property::lang.property_seller') . ':') !!}
                        {!! Form::select('block_customer_id', $customers, null, ['class' => 'form-control select2',
                        'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('block_block_id', __('property::lang.block_number') . ':') !!}
                        {!! Form::select('block_block_id', $block_numbers, null, ['class' => 'form-control select2',
                        'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('block_user_id', __('property::lang.sale_officers') . ':') !!}
                        {!! Form::select('block_user_id', $users, null, ['class' => 'form-control select2', 'style' =>
                        'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="col-md-12 block_details_table" style="margin-top: 10px;">
                </div>

            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default add_block_btn" data-dismiss="modal">@lang( 'messages.close'
                )</button>
        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script>
    $('#block_block_id, #block_customer_id, #block_user_id ').change(function(){
        get_block_list();
    })
    get_block_list();
    function get_block_list(){
        let block_id = $('#block_block_id').val();
        let customer_id = $('#block_customer_id').val();
        let user_id = $('#block_user_id').val();

        $.ajax({
            method: 'get',
            url: '/property/property-blocks/get-block-tr/{{$property->id}}',
            data: {  user_id, customer_id, block_id },
            contentType: 'html',
            success: function(result) {
                $('.block_details_table').empty().append(result);
            },
        });
    }
</script>