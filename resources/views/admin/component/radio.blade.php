<div class="form-group mb-2 {{ $errors->has($name) ? ' has-error' : '' }}">
    <label class="control-label">{{ $title }} {!! !empty($required) && $required == true ? '<span class="text-danger">*</span>' : '' !!}</label>
    <div>
        @foreach($lists as $key => $status)
            <label class="radio-inline p-2">
                {!! Form::radio($name, $key, $value == $key ? true : false, []) !!} {{ $status }}
            </label>
        @endforeach
    </div>
</div>