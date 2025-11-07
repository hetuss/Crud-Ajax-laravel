<div class="form-group">
    <label for="customFile">{{ $title }} {!! !empty($required) && $required==true?'<span class="text-danger">*</span>':'' !!}</label>
    <div class="custom-file">
        {{--<input name="{{ $name }}" type="file" class="custom-file-input" id="customFile">--}}
        {!! Form::file($name, ['class' => 'custom-file-input form-control'] + $options ) !!}
        <label class="custom-file-label" for="customFile">{{ !empty($options['placeholder'])?$options['placeholder']:'' }} </label>
    </div>
    {{-- <img class="mt-2 previewImg" id="previewImg" src="{{ url($file_url) }}" alt="" width="100"> --}}
</div>
