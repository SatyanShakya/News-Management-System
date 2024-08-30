<div class="card-body">

    <div class="form-group">
        {!! Form::label('title', 'Title *', ['class' => 'form-label']) !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}

            <span class="text-danger">
                @error('title')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="form-group">
            {!! Form::label('content', 'Content', ['class' => 'form-label']) !!}
            {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('summary', 'Summary', ['class' => 'form-label']) !!}
            {!! Form::textarea('summary', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('authors_id', 'Authors *', ['class' => 'form-label']) !!}
            {!! Form::select('authors_id[]', $authors, isset($post) ? $post->authors->pluck('id'):null, ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
            <span class="text-danger">
                @error('authors_id')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="form-group">
            {!! Form::label('categories_id', 'Categories *', ['class' => 'form-label']) !!}
            {!! Form::select('categories_id[]', $categories, isset($post) ? $post->categories->pluck('id'):null, ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
            <span class="text-danger">
                @error('categories_id')
                    {{ $message }}
                @enderror
            </span>
        </div>



        <div class="form-group">
            {!! Form::label('published', 'Published', ['class' => 'form-label']) !!}
            {!! Form::checkbox('published', 1, isset($post) ? $post->published == 1 : true, [   // for displaying the value of published
                'class' => 'toggle-class',
                'id' => 'publishedToggle',
                'data-toggle' => 'toggle',
            ]) !!}
        </div>

        <div class="form-group">
            {{ Form::label('image', 'Featured Image', ['class' => 'form-label']) }}
            {{ Form::file('image', ['class' => 'form-control']) }}
            <span class="text-danger">
                @error('image')
                    {{ $message }}
                @enderror
            </span>
        </div>

</div>
