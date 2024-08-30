<div class="form-group">
    {!! Form::label('title', 'Title *', ['class' => 'form-label']) !!}
    {!! Form::text('title', null, [
        'class' => 'title form-control',
        'id' => 'title',
    ]) !!}
    <span class="text-danger" id="title-error"></span>
    @if ($errors->has('title'))
        <span class="text-danger">{{ $errors->first('title') }}</span>
    @endif

</div>

<div class="form-group">
    {!! Form::label('slug', 'Slug *', ['class' => 'form-label']) !!}
    {!! Form::text('slug', null, [
        'class' => 'slug form-control',
        'id' => 'slug',
    ]) !!}
     <span class="text-danger" id="slug-error"></span>
     @if ($errors->has('slug'))
         <span class="text-danger">{{ $errors->first('slug') }}</span>
     @endif
</div>

<div class="form-group">
    {!! Form::label('published', 'Published', ['class' => 'form-label']) !!}
    {!! Form::checkbox('published', 1, isset($pageData) ? $pageData->published == 1 : true, [
        'class' => 'published toggle-class',
        'id' => 'published',
        'data-toggle' => 'toggle',
    ]) !!}
</div>



<div class="form-group">
    {!! Form::label('summary', 'Summary', ['class' => 'form-label']) !!}
    {!! Form::textarea('summary', null, ['class' => 'summary form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description', ['class' => 'form-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'description form-control', 'id' => 'description']) !!}
</div>
