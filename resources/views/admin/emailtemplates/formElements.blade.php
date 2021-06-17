<div class="card-body">
<div class="form-body">
    <div class="row">
        <div class="col-md-offset-2 col-md-6">
            <div class="form-group">
                {{ Form::label( 'title', 'Title: ',['class' => 'control-label']) }} <span class="star">*</span>
                {{ Form::text( 'title',null,['id' => 'title','class' => 'form-control', 'maxlength'=> '100']) }}
                @if ($errors->has('title'))
                    <span class="errormsges">{{ $errors->first('title') }}</span>
                @endif
                <label class="help-block"></label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label( 'type', 'Type: ',['class' => 'control-label']) }} <span class="star">*</span>
                {{ Form::text( 'type',null,['id' => 'type','class' => 'form-control', 'maxlength'=> '100']) }}
                @if ($errors->has('type'))
                    <span class="errormsges">{{ $errors->first('type') }}</span>
                @endif
                <label class="help-block"></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-2 col-md-6">
            <div class="form-group">
                {{ Form::label( 'subject', 'Subject: ',['class' => 'control-label']) }} <span class="star">*</span>
                {{ Form::text( 'subject',null,['id' => 'subject','class' => 'form-control', 'maxlength'=> '100']) }}
                @if ($errors->has('subject'))
                    <span class="errormsges">{{ $errors->first('subject') }}</span>
                @endif
                <label class="help-block"></label>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label( 'subject', 'Email Tag: ',['class' => 'control-label']) }}
                <select id="email-tag" class="form-control select-box">
                    <option value="">-Select-</option>
                    @foreach($tags as $tag)
                        <option value="{{$tag['title']}}">{{$tag['title']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-2 col-md-12">
            <div class="form-group">
                {{ Form::label( 'content', 'Content: ',['class' => 'control-label']) }} <span class="star">*</span>
                {{ Form::textarea( 'content',null,['id' => 'content', 'class' => 'form-control']) }}
                @if ($errors->has('content'))
                    <span class="errormsges">{{ $errors->first('content') }}</span>
                @endif
                <label class="help-block"></label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                {{ Form::submit( $submitButtonText, ['class' => 'btn btn-primary']) }}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <a href="{{route('admin.getEmailTemplates')}}" class="btn btn-primary">Cancel</a>
            </div>
        </div>
    </div>
</div>
</div>
