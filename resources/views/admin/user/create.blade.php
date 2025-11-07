<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-secondary" id="createModalLabel">
                    {{ isset($record) && $record ? 'Edit ' . $title : 'Add New ' . $title }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="{{ isset($record) && $record ? 'editForm' : 'createForm' }}"
                action="{{ isset($record) && $record ? route($route . 'update', $record->id) : route($route . 'store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($record) && $record)
                    @method('PUT')
                @endif
                <div class="modal-body">
                    @include('admin.user.form')

                    

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        {{ isset($record) && $record ? 'Update' : 'Submit' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
