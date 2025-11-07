<form id="createForm" action="{{ route($route . 'store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- Name --}}
    @component('admin.component.text', [
        'name' => 'name',
        'title' => 'Name',
        'value' => $record->name ?? null,
        'required' => true,
        'options' => ['placeholder' => 'Enter name'],
    ])
    @endcomponent

    {{-- Email --}}
    @component('admin.component.text', [
        'name' => 'email',
        'title' => 'Email',
        'value' => $record->email ?? null,
        'required' => true,
        'options' => ['placeholder' => 'Enter email'],
    ])
    @endcomponent

    {{-- Contact --}}
    @component('admin.component.text', [
        'name' => 'contact',
        'title' => 'Contact',
        'value' => $record->contact ?? null,
        'required' => true,
        'options' => ['placeholder' => 'Enter contact number'],
    ])
    @endcomponent

    {{-- Gender --}}
    @component('admin.component.radio', [
        'name' => 'gender',
        'title' => 'Select Gender',
        'value' => $record->gender ?? null,
        'lists' => App\Models\Variable::$gender,
        'required' => true,
    ])
    @endcomponent

    <div class="row">
        <div class="col-6">
            @component('admin.component.file', [
                'name' => 'profile_image',
                'title' => 'Upload Profile Photo',
                'value' => $record->profile_image ?? null,
                'required' => false,
                'options' => [],
            ])
            @endcomponent
        </div>
        <div class="col-6">
            @component('admin.component.file', [
                'name' => 'image',
                'title' => 'Upload Photo',
                'value' => $record->image ?? null,
                'required' => false,
                'options' => [],
            ])
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            @if (!empty($record->profile_image_url))
                <div class="text-center mb-3">
                    <img src="{{ $record->profile_image_url }}" width="150" class="img-thumbnail"
                        alt="User Profile Image">
                </div>
            @endif
        </div>
        <div class="col-6">
            @if (!empty($record->image_url))
                <div class="text-center mb-3">
                    <img src="{{ $record->image_url }}" width="150" class="img-thumbnail" alt="User Image">
                </div>
            @endif
        </div>
    </div>

    <div class="mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Custom Details</h3>
            <button type="button" id="addCustomField" class="btn btn-sm btn-primary mt-2">
                <i class="ph-plus"></i> Add More
            </button>
        </div>

        <div id="customFieldsContainer" class="row g-2">
            @if (!empty($customFields))
                @foreach ($customFields as $item)
                    <div class="row g-2 mt-2 custom-field-row">
                        <div class="col-6">
                            <input type="text" name="custom_label[]" class="form-control"
                                value="{{ $item['label'] }}" placeholder="Label (e.g. Company Name)">
                        </div>
                        <div class="col-6 d-flex">
                            <input type="text" name="custom_value[]" class="form-control"
                                value="{{ $item['value'] }}" placeholder="Value (e.g. XYZ)">
                            <button type="button" class="btn btn-danger btn-sm ms-2 removeField">
                                -
                            </button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>


    </div>

</form>
