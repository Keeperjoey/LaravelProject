<div class="form-group {{ $errors->has('uuid') ? 'has-error' : ''}}">
    {!! Form::label('uuid', 'Uuid', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('uuid', null, ['class' => 'form-control']) !!}
        {!! $errors->first('uuid', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    {!! Form::label('content', 'Content', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('floor') ? 'has-error' : ''}}">
    {!! Form::label('floor', 'Floor', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('floor', ['1', '2', '3'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('floor', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('x') ? 'has-error' : ''}}">
    {!! Form::label('x', 'X', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('x', null, ['class' => 'form-control']) !!}
        {!! $errors->first('x', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('y') ? 'has-error' : ''}}">
    {!! Form::label('y', 'Y', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('y', null, ['class' => 'form-control']) !!}
        {!! $errors->first('y', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
    {!! Form::label('category', 'Category', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('category', ['temperature', 'humidity', 'people'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
