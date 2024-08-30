<div class="card-body">
    <div class="form-group">
        {!! Form::label('name', 'Name *', ['class' => 'form-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        <span class="text-danger">
            @error('name')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="form-group">
        {!! Form::label('email','Email *',['class' => 'form-label']) !!}
        {!! Form::text('email',null,['class' => 'form-control','readonly'=>isset($user)]) !!}
        <span class="text-danger">
            @error('email')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="form-group">
        {!! Form::label('password','Password *',['class'=>'form-label']) !!}
        {!! Form::password('password',['class'=>'form-control']) !!}
        <span class="text-danger">
            @error('password')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="form-group">
        {!! Form::label('password_confirmation','Confirm Password *',['class'=>'form-label']) !!}
        {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
        <span class="text-danger">
            @error('password')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="form-group">
        {!! Form::label('roles_id', 'Role *', ['class' => 'form-label']) !!}
        {!! Form::select('roles_id[]', $roles, isset($user) ? $user->roles->pluck('id'):null, ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
        <span class="text-danger">
            @error('roles_id')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="form-group">
        {!! Form::label('published', 'Status', ['class' => 'form-label']) !!}
        {!! Form::checkbox('published', 1,  isset($user) ? $user->published == 1 : true, [
            'class' => 'toggle-class',
            'id' => 'publishedToggle',
            'data-toggle' => 'toggle',
            'data-on'=>'Active',
             'data-off'=>'Inactive',
        ]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('image','Image',['class'=>'form-label']) !!}
        {!! Form::file('image',['class'=>'form-control']) !!}
        <span class="text-danger">
            @error('image')
                {{ $message }}
            @enderror
        </span>
    </div>

</div>
