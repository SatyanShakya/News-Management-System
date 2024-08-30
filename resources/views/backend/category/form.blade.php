<div class="card-body">
    <div class="form-group">
        {!! Form::label('name', 'Name *', ['class' => 'form-label']) !!}
        {!! Form::text('name', null, [
            'class' => 'form-control',
            'id' => 'name',
        ]) !!}
        <span class="text-danger">
            @error('name')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="form-group">

        {!! Form::label('slug', 'Slug *', ['class' => 'form-label']) !!}
        {!! Form::text('slug', null, [
            'class' => 'form-control',
            'id' => 'slug',
        ]) !!}
        <span class="text-danger">
            @error('slug')
                {{ $message }}
            @enderror
        </span>
    </div>
    <div class="form-group">

        {!! Form::label('description', 'Description', ['class' => 'form-label']) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}

    </div>

    <div class="form-group">
        {!! Form::label('published', 'Published', ['class' => 'form-label']) !!}
        {!! Form::checkbox('published', 1, isset($category) ? $category->published == 1 : true, [
            // for displaying the value of published in edit we use isset
            'class' => 'toggle-class',
            'id' => 'publishedToggle',
            'data-toggle' => 'toggle',
        ]) !!}
    </div>
</div>

</div>
