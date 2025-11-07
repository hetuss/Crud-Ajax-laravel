@extends('admin.layouts.app')
@section('body')
    <div class="content">

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label>Select Gender</label>
                        {!! Form::select(
                            'gender',
                            [
                                '' => '--- Select Gender ---',
                                'Male' => 'Male',
                                'Female' => 'Female',
                                'Other' => 'Other',
                            ],
                            request()->get('gender'),
                            [
                                'class' => 'form-control shorting',
                                'id' => 'txt_gender',
                            ],
                        ) !!}
                    </div>
                    <div class="col-md-4">
                        <label>Custom Field Search</label>
                        <div class="input-group">
                            <input type="text" id="txt_custom_search" class="form-control"
                                placeholder="Search custom details..." value="{{ request()->get('custom_search') }}">
                            <button class="btn btn-primary" id="btn_custom_search" type="button">
                                <i class="ph-magnifying-glass"></i>
                            </button>
                            <button class="btn btn-secondary" id="btn_custom_clear" type="button">
                                <i class="ph-x"></i> <!-- or use Cancel text -->
                            </button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $title }} Records</h5>
                <button type="button" class="btn btn-primary" id="openCreateModal">+ Add New</button>
            </div>

            <div id="createModalContainer"></div>

            <table class="table datatable-responsive" id="datatable1">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Gender</th>
                        <th>Created At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {

            const oTable = $('#datatable1').DataTable({
                destroy: true,
                order: [
                    [0, "desc"]
                ],
                ajax: {
                    url: "{{ route('admin.user.index') }}",
                    data: function(d) {
                        d.gender = $('#txt_gender').val();
                        d.custom_search = $('#txt_custom_search').val();
                    }
                },
                columns: [{
                        render: function(data, type, row) {
                            return ` <input type="checkbox" class="user-checkbox" data-id="${row.id}">
                <span style="margin-left:5px;">${row.id}</span>`;
                        },
                        data: 'id'
                    }, {
                        data: 'name'
                    }, {
                        data: 'email'
                    }, {
                        data: 'contact'
                    },
                    {
                        data: 'gender'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                ]
            });

            $('body').on('change', '#txt_gender', function() {
                oTable.ajax.reload();
            });
            $('body').on('click', '#btn_custom_search', function() {
                oTable.ajax.reload();
            });
            $('#btn_custom_clear').on('click', function() {
                $('#txt_custom_search').val(''); // clear input
                oTable.ajax.reload(); // reload table without filter
            });


            $('body').on('click', '#openCreateModal', function() {
                $.get("{{ route($route . 'create') }}", response => showModal(response))
                    .fail(() => toastr.error('Error loading form!'));
            });


            /// custom field code
            $('body').on('click', '#addCustomField', function() {
                const newRow = `
        <div class="row g-2 mt-2 custom-field-row">
            <div class="col-6">
                <input type="text" name="custom_label[]" class="form-control" placeholder="Label (e.g. Company Name)">
            </div>
            <div class="col-6 d-flex">
                <input type="text" name="custom_value[]" class="form-control" placeholder="Value (e.g. XYZ)">
                <button type="button" class="btn btn-danger btn-sm ms-2 removeField">
                    -
                </button>
            </div>
        </div>`;
                $('#customFieldsContainer').append(newRow);
            });

            $('body').on('click', '.removeField', function() {
                $(this).closest('.custom-field-row').remove();
            });


            // ✅ Remove row when - clicked
            $('body').on('click', '.removeField', function() {
                $(this).closest('.custom-field-row').remove();
            });

            // Remove a field pair
            $('body').on('click', '.removeField', function() {
                $(this).closest('.custom-field-row').remove();
            });

            // 🔹 Open Edit Modal
            $('body').on('click', '.editRecord', function() {
                const id = $(this).data('id');
                const url = "{{ route($route . 'edit', ':id') }}".replace(':id', id);
                $.get(url, response => showModal(response))
                    .fail(() => toastr.error('Error loading edit form!'));
            });

            // 🔹 Submit (Create / Update)
            $('body').on('submit', '#createForm, #editForm', function(e) {
                e.preventDefault();

                const form = this;
                const formData = new FormData(form);

                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        toastr.success('Saved successfully!');
                        oTable.ajax.reload(null, false);
                        closeModal();
                    },
                    error: function() {
                        toastr.error('Error saving record!');
                    }
                });
            });


            // 🔹 Helper: Show modal
            function showModal(response) {
                $('#createModalContainer').html(response);
                new bootstrap.Modal('#createModal').show();
            }

            // 🔹 Helper: Close modal
            function closeModal() {
                bootstrap.Modal.getInstance('#createModal')?.hide();
                $('.modal-backdrop').remove();
            }

            // checkbox coding

            let selectedUsersGlobal = [];
            let popupShown = false;

            // Track checkboxes
            $('#datatable1').on('change', '.user-checkbox', function() {
                const id = $(this).data('id');
                if ($(this).is(':checked')) {
                    if (!selectedUsersGlobal.includes(id)) selectedUsersGlobal.push(id);
                } else {
                    selectedUsersGlobal = selectedUsersGlobal.filter(x => x != id);
                }

                // Step 1 popup: show automatically if 2+ selected
                if (selectedUsersGlobal.length >= 2 && !popupShown) {
                    popupShown = true;

                    const confirmHtml = `
            <div id="confirmMergeModal" class="modal" style="display:block; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Check this out!</h5>
                            <button type="button" class="bootbox-close-button btn-close" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <div class="bootbox-body">Do you want to merge selected users?</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary bootbox-cancel">No</button>
                            <button type="button" class="btn btn-primary bootbox-accept">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
                    $('body').append(confirmHtml);

                    // Cancel / close popup
                    $('.bootbox-cancel, .bootbox-close-button').on('click', function() {
                        $('#confirmMergeModal').remove();
                        popupShown = false;
                    });

                    // Yes → Step 2: Choose master contact
                    $('.bootbox-accept').on('click', function() {
                        $('#confirmMergeModal').remove();
                        openMasterContactModal(selectedUsersGlobal);
                    });
                }

                // Reset if less than 2 selected
                if (selectedUsersGlobal.length < 2) {
                    popupShown = false;
                }
            });

            // Step 2 modal
            function openMasterContactModal(selectedUsers) {
                let masterHtml = `
    <div id="chooseMasterModal" class="modal" style="display:block; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Master Contact</h5>
                    <button type="button" class="bootbox-close-button btn-close" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="bootbox-body">
                        <p>Which one is your master contact?</p>
                        <form id="masterForm">
    `;

                selectedUsers.forEach(id => {
                    const row = $(`.user-checkbox[data-id="${id}"]`).closest('tr');
                    const contact = row.find('td:eq(3)').text(); // assuming contact column
                    masterHtml += `<div>
            <input type="radio" name="masterUser" value="${id}"> ${contact}
        </div>`;
                });

                masterHtml += `
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancelStep2Btn">Cancel</button>
                    <button type="button" class="btn btn-success" id="confirmStep2Btn">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    `;

                $('body').append(masterHtml);

                // Cancel / close
                $('#cancelStep2Btn, .bootbox-close-button').on('click', function() {
                    $('#chooseMasterModal').remove();
                    popupShown = false;
                });

                // Confirm → show "Are you sure?" popup first
                $('#confirmStep2Btn').on('click', function() {
                    const masterId = $('input[name="masterUser"]:checked').val();
                    if (!masterId) {
                        alert('Please select a master contact.');
                        return;
                    }

                    // Show confirmation popup
                    if (confirm('Are you sure you want to merge into this master contact?')) {
                        // Proceed with AJAX merge
                        $.ajax({
                            url: "{{ route('admin.user.merge') }}",
                            method: "POST",
                            data: {
                                _token: '{{ csrf_token() }}',
                                masterId: masterId,
                                userIds: selectedUsers
                            },
                            success: function(res) {
                                alert(res.message);
                                oTable.ajax.reload(); // reload datatable
                                $('#chooseMasterModal').remove();
                                selectedUsersGlobal = [];
                                popupShown = false;
                            },
                            error: function(err) {
                                alert('Something went wrong. Please try again.');
                            }
                        });
                    }
                });
            }


            // 🔹 Delete Record
            $('body').on('click', '.data-delete', function() {
                const id = $(this).data('id');
                swal({
                    title: "Are you sure?",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes!",
                    showCancelButton: true,
                }, function() {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route($route . 'index') }}/" + id,
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id
                        },
                        success: (resp) => {
                            toastr.error(resp.message);
                            oTable.ajax.reload();
                        },
                        error: (xhr) => alert('Error: ' + xhr.statusText)
                    });

                });
            });

        });
    </script>
@endsection
