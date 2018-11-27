{{-- ADD --}}
<div class="modal fade" id="add-dependent-popup" tabindex="-1" role="dialog" aria-labelledby="add-dependent-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-dependent-label">Add Dependent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-dependent-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Name*</strong></label>
                            <input id="name" type="text" class="form-control" placeholder="" value="" required>
                            <div id="name-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Relationship*</strong></label>
                            <input id="relationship" type="text" class="form-control" placeholder="eg. Father, Son" value="" required>
                            <div id="relationship-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-12 col-form-label"><strong>Date Of Birth*</strong></label>
                        <div class="col-md-7">
                            <input id="altdobDate" name="altdobDate" type="text" class="form-control" hidden>
                            <input name="dobDate" id="dobDate" type="text" class="form-control hrms-datepicker" readonly>
                            <div id="dobDate-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="add-dependent-submit" type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- UPDATE --}}
<div class="modal fade" id="edit-dependent-popup" tabindex="-1" role="dialog" aria-labelledby="edit-dependent-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-dependent-label">Add Dependent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit-dependent-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Name*</strong></label>
                            <input id="name" type="text" class="form-control" placeholder="" value="" required>
                            <div id="name-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Relationship*</strong></label>
                            <input id="relationship" type="text" class="form-control" placeholder="" value="" required>
                            <div id="relationship-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-12 col-form-label"><strong>Date Of Birth*</strong></label>
                        <div class="col-md-7">
                            {{-- <input id="altdobDate" name="altdobDate" type="text" class="form-control" hidden> --}}
                            <input name="dobDate" id="dobDate" type="text" class="form-control">
                            <div id="dobDate-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="edit-dependent-submit" type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- DELETE--}}
<div class="modal fade" id="confirm-delete-dependent-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-dependent-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirm-delete-dependent-label">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="delete-dependent-submit">Delete</button>
            </div>
        </div>
    </div>
</div>


{{-- TABLE --}}
<div class="tab-pane fade show p-3" id="nav-dependent" role="tabpanel" aria-labelledby="nav-dependent-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#add-dependent-popup">
                Add Dependent
            </button>
        </div>
    </div>
    <table class="table table-bordered table-hover w-100" id="employee-dependents-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Relationship</th>
                <th>Date Of Birth</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>


@section('scripts')
<script>
    var dependentsTable = $('#employee-dependents-table').DataTable({
        "bInfo": true,
        "bDeferRender": true,
        "serverSide": true,
        "bStateSave": true,
        "ajax": "{{ route('admin.employees.dt.dependents', ['id' => $id]) }}",
        "columns": [{
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "name"
            },
            {
                "data": "relationship"
            },
            {
                "data": "dob"
            },
            {
                "data": null,
                render: function (data, type, row, meta) {
                    return `<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-dependent-popup"><i class="far fa-edit"></i></button>` +
                        `<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#confirm-delete-dependent-modal"><i class="far fa-trash-alt"></i></button>`;
                }
            }
        ]
    });

</script>
<script type="text/javascript">
    $(function(){
        // ADD
       $('#add-dependent-form #add-dependent-submit').click(function(e){
          e.preventDefault();
          $.ajax({
            url: "{{ route('admin.employees.dependents.post', ['id' => $id]) }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                name: $('#add-dependent-form #name').val(),
                relationship: $('#add-dependent-form #relationship').val(),
                dob: $('#add-dependent-form #dobDate').val()
            },
            success: function(data) {
                showAlert(data.success);
                dependentsTable.ajax.reload();
                $('#add-dependent-popup').modal('toggle');
                clearDependentsModal('#add-dependent-form');
            },
            error: function(xhr) {
                if(xhr.status == 422) {
                    var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'name':
                                        $('#add-dependent-form #name').addClass('is-invalid');
                                        $('#add-dependent-form #name-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'relationship':
                                        $('#add-dependent-form #relationship').addClass('is-invalid');
                                        $('#add-dependent-form #relationship-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'dob':
                                        $('#add-dependent-form #dobDate').addClass('is-invalid');
                                        $('#add-dependent-form #dobDate-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                }
                            }
                        }
                    }
                }
            });
        });

        // EDIT DEPENDENT
        var editDependentId = null;
        // Function: On Modal Clicked Handler
        $('#edit-dependent-popup').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
            console.log('Data: ', currentData)

            editDependentId = currentData.id;

            $('#edit-dependent-form #name').val(currentData.name);
            $('#edit-dependent-form #relationship').val(currentData.relationship);
            $('#edit-dependent-form #dobDate').val(currentData.dob);
        });

        var editDependentRouteTemplate = "{{ route('admin.employees.dependents.edit.post', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#edit-dependent-submit').click(function(e){
            var editDependentRoute = editDependentRouteTemplate.replace(encodeURI('<<id>>'), editDependentId);
            e.preventDefault();
            $.ajax({
                url: editDependentRoute,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: $('#edit-dependent-form #name').val(),
                    relationship: $('#edit-dependent-form #relationship').val(),
                    dob: $('#edit-dependent-form #dobDate').val()
                },
                success: function(data) {
                    showAlert(data.success);
                    dependentsTable.ajax.reload();
                    $('#edit-dependent-popup').modal('toggle');
                    clearDependentsModal('#edit-dependent-form');
                },
                error: function(xhr) {
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'name':
                                        $('#edit-dependent-form #name').addClass('is-invalid');
                                        $('#edit-dependent-form #name-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'relationship':
                                        $('#edit-dependent-form #relationship').addClass('is-invalid');
                                        $('#edit-dependent-form #relationship-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'dob':
                                        $('#edit-dependent-form #dobDate').addClass('is-invalid');
                                        $('#edit-dependent-form #dobDate-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                }
                            }
                        }
                    }
                }
            });
        });
        // DELETE DEPENDENT
        var deleteDependentId = null;
        // Function: On Modal Clicked Handler
        $('#confirm-delete-dependent-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
            console.log('Data: ', currentData)

            deleteDependentId = currentData.id;
        });

        var deleteDependentRouteTemplate = "{{ route('admin.settings.dependents.delete', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#delete-dependent-submit').click(function(e){
            var deleteDependentRoute = deleteDependentRouteTemplate.replace(encodeURI('<<id>>'), deleteDependentId);
            e.preventDefault();
            $.ajax({
                url: deleteDependentRoute,
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: deleteDependentId
                },
                success: function(data) {
                    showAlert(data.success);
                    dependentsTable.ajax.reload();
                    $('#confirm-delete-dependent-modal').modal('toggle');
                },
                error: function(xhr) {
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error 422: ", xhr);
                    }
                    console.log("Error: ", xhr);
                }
            });
        });
    });

    // GENERAL FUNCTIONS
    function clearDependentsModal(htmlId) {
        $(htmlId + ' #name').val('');
        $(htmlId + ' #relationship').val('');
        $(htmlId + ' #dobDate').val('');

        $(htmlId + ' #name').removeClass('is-invalid');
        $(htmlId + ' #relationship').removeClass('is-invalid');
        $(htmlId + ' #dobDate').removeClass('is-invalid');
    }

    function showAlert(message) {
        $('#alert-container').html(`<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <span id="alert-message">${message}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>`)
    }

</script>
@append
