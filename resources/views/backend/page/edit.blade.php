<div class="form-group">
    {!! Form::label('title', 'Title *', ['class' => 'form-label']) !!}
    {!! Form::text('title', null, [
        'class' => 'title form-control',
        'id' => 'titleedit',
    ]) !!}
      <span class="text-danger" id="titleedit-error"></span>
      @if ($errors->has('title'))
          <span class="text-danger">{{ $errors->first('title') }}</span>
      @endif
</div>

<div class="form-group">
    {!! Form::label('slug', 'Slug *', ['class' => 'form-label']) !!}
    {!! Form::text('slug', null, [
        'class' => 'slug form-control',
        'id' => 'slugedit',
    ]) !!}
      <span class="text-danger" id="slugedit-error"></span>
      @if ($errors->has('slug'))
          <span class="text-danger">{{ $errors->first('slug') }}</span>
      @endif
</div>

<div class="form-group">
    {!! Form::label('published', 'Published', ['class' => 'form-label']) !!}
    {!! Form::hidden('published',0,['class'=>'toogle-class', 'id'=>'toggle_state']) !!}
    {!! Form::checkbox('publishededit', 1, isset($pageData) ? $pageData->published == 1 : true, [
        'class' => 'published toggle-class',
        'id' => 'publishededit',
        'data-toggle' => 'toggle',
    ]) !!}
</div>


<div class="form-group">
    {!! Form::label('summary', 'Summary', ['class' => 'form-label']) !!}
    {!! Form::textarea('summary', null, ['class' => 'summary form-control', 'id'=>'summaryedit']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description', ['class' => 'form-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'description form-control','id'=>'descriptionedit']) !!}
</div>























