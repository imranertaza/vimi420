
<!-- Modal -->

    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@lang('hr::lang.edit_department')</h4>
            </div>
            {!! Form::open(['url' => action('\Modules\HR\Http\Controllers\DepartmentController@update', $department->id), 'method' => 'put']) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="department">@lang('hr::lang.department'):</label>
                            <input type="text" class="form-control" name="department" value="{{$department->department}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('hr::lang.description'):</label>
                            <textarea type="text" class="form-control" name="description">{{$department->description}} </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            {!! Form::close() !!}
        </div>

    </div>
