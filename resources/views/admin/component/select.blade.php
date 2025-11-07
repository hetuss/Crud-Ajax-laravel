<div class="form-group {{ $errors->has($name) ? ' has-error' : '' }}">
    <label class="control-label">{{ $title }} {!! !empty($required) && $required == true ? '<span class="text-danger">*</span>' : '' !!}</label>
    {!! Form::select($name, $lists, $value, ['class' => 'form-control mb-3'] + $options) !!}
    {{-- <span class="help-block" id="error_{{ $name }}"><strong>{{ $errors->first($name) }}</strong></span> --}}
</div>

{{-- @component('admin.component.select', [
    'name' => 'desciption',
    'title' => 'Description',
    'value' => null,
    'lists' => App\Models\User::pluck('name', 'name')->toArray(),
    'required' => true,
    'options' => [],
])
@endcomponent --}}
