<!-- Set Security Group -->
<div class="modal fade" id="add-security-group-popup" tabindex="-1" role="dialog" aria-labelledby="add-security-group-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-security-group-label">Add Security Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-security-group-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Name*</strong></label>
                            <select class="form-control{{ $errors->has('security-group-id') ? ' is-invalid' : '' }}" name="security-group-id" id="security-group-id">
                                <option value="">Select Security Group</option>
                                @foreach($securityGroup as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                            <div id="security-group-id-error" class="invalid-feedback"></div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button id="add-security-group-submit" type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- DELETE SG--}}
<div class="modal fade" id="confirm-delete-security-group-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-security-group-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirm-delete-security-group-label">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="delete-security-group-submit">Delete</button>
            </div>
        </div>
    </div>
</div>

{{-- TABLE --}}
<div class="tab-pane fade show p-3" id="nav-security" role="tabpanel" aria-labelledby="nav-security-tab">
	@hasrole('HR Admin')
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-security-group-popup">
                Add Security Group
            </button>

        </div>
    </div>
    @endhasrole
    <table class="hrms-primary-data-table table w-100" id="security-groups-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>



@section('scripts')
<script>
    var securityGroupsTable = $('#security-groups-table').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "{{ route('admin.employees.dt.security-groups', ['id' => $id]) }}",
    "columnDefs": [ {
        "targets": 2,
        "orderable": false
    } ],
    "columns": [
        {
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            "data": "security_groups.name"
        },
        {
            "data": null, // can be null or undefined
            render: function (data, type, row, meta) {
                // return `<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-security-group-popup"><i class="far fa-edit"></i></button>` +
                @hasrole('HR Admin')
                return `<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#confirm-delete-security-group-modal"><i class="far fa-trash-alt"></i></button>`;
                @endhasrole
                return '';
            }
        }
    ]
});

</script>
<script type="text/javascript">
    $(function(){
        $('#add-security-group-form #security-group-id').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });

        // ADD SECURITY GROUP
        $('#add-security-group-popup').on('show.bs.modal', function (event) {
            clearSecurityGroupError('#add-security-group-form');
        });
        $('#add-security-group-form #add-security-group-submit').click(function(e){
            clearSecurityGroupError('#add-security-group-form');
            e.preventDefault();
            $.ajax({
                url: "{{ route('admin.employees.security-groups.post', ['id' => $id]) }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    // Form Data
                    security_group_id: $('#add-security-group-form #security-group-id').val(),

                },
                success: function(data) {
                    showAlert(data.success);
                    securityGroupsTable.ajax.reload();
                    $('#add-security-group-popup').modal('toggle');
                    clearSecurityGroupModal('#add-security-group-form');
                },
                error: function(xhr) {
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'security_group_id':
                                        $('#add-security-group-form #security-group-id').addClass('is-invalid');
                                        $('#add-security-group-form #security-group-id-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;

                                }
                            }
                        }
                    }
                }
            });
        });

        // DELETE
        var deleteId = null;
        // Function: On Modal Clicked Handler
        $('#confirm-delete-security-group-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
            console.log('Data: ', currentData)

            deleteId = currentData.id;

        });

        var deleteRouteTemplate = "{{ route('admin.settings.security-groups.delete', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#delete-security-group-submit').click(function(e){
            var deleteRoute = deleteRouteTemplate.replace(encodeURI('<<id>>'), deleteId);
            e.preventDefault();
            $.ajax({
                url: deleteRoute,
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: deleteId
                },
                success: function(data) {
                    showAlert(data.success);
                    securityGroupsTable.ajax.reload();
                    $('#confirm-delete-security-group-modal').modal('toggle');
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
    function clearSecurityGroupModal(htmlId) {
        $(htmlId + ' #security-group-id')[0].selectize.clear();
        $(htmlId + ' #security-group-id').removeClass('is-invalid');
    }
    function clearSecurityGroupError(htmlId) {
        $(htmlId + ' #security-group-id').removeClass('is-invalid');
    }

    function clearMainSecurityGroupModal(htmlId) {
        $(htmlId + ' #main-security-group-id').val('');
        $(htmlId + ' #main-security-group-id').removeClass('is-invalid');
    }
    function clearMainSecurityGroupError(htmlId) {
        $(htmlId + ' #main-security-group-id').removeClass('is-invalid');
    }

    function showAlert(message) {
        $('#alert-container').html(`<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <span id="alert-message">${message}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>`)
    }


    $(function(){
        // EDIT Profile
        var editProfileId = null;
        // Function: On Modal Clicked Handler
        $('#edit-profile-popup').on('show.bs.modal', function (event) {
            clearProfilesError('#edit-profile-form');
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = button.data('current') // Extract info from data-* attributes
            console.log('Data: ', currentData)

            editProfileId = currentData.id;

            $('#edit-profile-form #gender').val(currentData.gender);

        });

        var editRouteTemplate = "{{ route('admin.employees.profile.edit.post', ['id' => $employee->id]) }}";
        $('#edit-profile-submit').click(function(e){
            clearProfilesError('#edit-profile-form');
            // var editProfileRoute = editProfileRouteTemplate.replace($id, editProfileId);
            e.preventDefault();
            $.ajax({
                url: editRouteTemplate,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',

                    gender: $('#edit-profile-form #gender').val(),

                },
                success: function(data) {
                    showAlert(data.success);
                    $('#edit-profile-popup').modal('toggle');
                    $('#employee-profile-details').load(' #reload-profile1');
                    $('#nav-profile').load(' #reload-profile2');
                    clearProfilesModal('#edit-profile-form');
                },
                error: function(xhr) {
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {

                                    case 'gender':
                                        $('#edit-profile-form #gender').addClass('is-invalid');
                                        $('#edit-profile-form #gender-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;

                                }
                            }
                        }
                    }
                }
            });
        });

    });
</script>
@append
