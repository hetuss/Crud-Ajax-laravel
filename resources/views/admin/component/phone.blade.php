<div class="form-group">
    <label class="control-label">
        {{ $title }}
        {!! !empty($required) && $required == true ? '<span class="text-danger">*</span>' : '' !!}
    </label>

    <input
        type="number"
        name="{{ $name }}"
        value="{{ old($name, $value ?? '') }}"
        class="form-control mb-3"
        placeholder="{{ $options['placeholder'] ?? 'Enter phone number' }}"
        pattern="[0-9]{10}"
        maxlength="10"
        minlength="10"
        inputmode="numeric"
        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,10);"
        {{ !empty($required) && $required == true ? 'required' : '' }}
    >
</div>
