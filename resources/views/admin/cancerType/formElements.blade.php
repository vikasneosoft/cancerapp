<div class="card-body">
    <div class="form-body">
        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('name', 'Name: ', ['class' => 'control-label']) }} <span class="star">*</span>
                    {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'maxlength' => '100']) }}
                    <label class="help-block errormsges"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('status', 'Status: ', ['class' => 'control-label']) }}
                    {{ Form::select('status', ['1' => 'Active', '0' => 'Inactive'], null, ['class' => 'form-control']) }}
                    <label class="help-block"></label>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    {{ Form::submit($submitButtonText, ['class' => 'btn btn-primary']) }}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <a href="{{ route('admin.getCancerTypes') }}" class="btn btn-primary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
