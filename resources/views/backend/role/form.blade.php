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
        {!! Form::label('permissions_id', 'Permission', ['class' => 'form-label']) !!}
        {!! Form::select('permissions_id[]', $permissions, isset($role) ? $role->permissions->pluck('id')->toArray() : null, ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
        <span class="text-danger">
            @error('permissions_id')
                {{ $message }}
            @enderror
        </span>
    </div>



</div>
