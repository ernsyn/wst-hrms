<!-- ADD -->
<div class="modal fade" id="add-security-groups-popup" tabindex="-1" role="dialog" aria-labelledby="add-security-group-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-security-group-label">Add an Security Group</h5>
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
                            {{-- <input id="security-group-id" type="text" class="form-control" placeholder="" value="" required>  --}}
                            <div class="col-md-6">
                                    <select class="form-control{{ $errors->has('security-group-id') ? ' is-invalid' : '' }}" name="security-group-id" id="security-group-id">
                                        @foreach(App\SecurityGroup::all() as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select> @if ($errors->has('security-group-id'))
                                    <span class="invalid-feedback" role="alert">
                                                              <strong>{{ $errors->first('security-group-id') }}</strong>
                                                          </span> @endif
                                </div>

                            {{-- <div id="security-group-id-error" class="invalid-feedback"> --}}

                            {{-- </div> --}}
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button id="add-submit" type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button> {{-- <button id="add-close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                    --}}
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ADD Main-->
<div class="modal fade" id="add-main-security-groups-popup" tabindex="-1" role="dialog" aria-labelledby="add-main-security-groups-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-main-security-groups-label">Add Main Security Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-main-security-group-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Name*</strong></label>
                            {{-- <input id="security-group-id" type="text" class="form-control" placeholder="" value="" required>  --}}
                            <div class="col-md-6">
                                    <select class="form-control{{ $errors->has('main-security-group-id') ? ' is-invalid' : '' }}" name="main-security-group-id" id="main-security-group-id">
                                        @foreach(App\SecurityGroup::all() as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select> @if ($errors->has('main-security-group-id'))
                                    <span class="invalid-feedback" role="alert">
                                                              <strong>{{ $errors->first('main-security-group-id') }}</strong>
                                                          </span> @endif
                                </div>

                            {{-- <div id="security-group-id-error" class="invalid-feedback"> --}}

                            {{-- </div> --}}
                        </div>
                    </div>

                </div>
            
                <div class="modal-footer">
                    <button id="add-submit" type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button> {{-- <button id="add-close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                    --}}
                </div>
            </form>
        </div>
    </div>
</div>

<div class="tab-pane fade show p-3" id="nav-security" role="tabpanel" aria-labelledby="nav-security-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-security-groups-popup">
                Add Security Group
            </button>
            <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-main-security-groups-popup">
                    Add Main Security Group  
                </button>
        </div>
    </div>
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
    "columns": [{
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
                return `<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-security-group-popup"><i class="far fa-edit"></i></button>` +
                    `<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#confirm-delete-modal"><i class="far fa-trash-alt"></i></button>`;
            }

            // }
        }
    ]
});

</script>
<script type="text/javascript">
    $(function(){
        // ADD
       $('#add-main-security-group-form #add-submit').click(function(e){
          e.preventDefault();
          $.ajax({
            url: "{{ route('admin.employees.main-security-groups.post', ['id' => $id]) }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                // Form Data
                main_security_group_id: $('#add-main-security-group-form #main-security-group-id').val(),

            },
            success: function(data) {
                showAlert(data.success);
                emergencyContactsTable.ajax.reload();
                $('#add-main-security-group-popup').modal('toggle');
                clearEmergencyContactModal('#add-main-security-group-form');
            },
            error: function(xhr) {
                if(xhr.status == 422) {
                    var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'main_security_group_id':
                                        $('#add-main-security-group-form #main-security-group-id').addClass('is-invalid');
                                        $('#add-main-security-group-form #main-security-group-id-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                               
                                }
                            }
                        }
                    }
                }
            });
        });
</script>
<script type="text/javascript">
    $(function(){
        // ADD
       $('#add-security-group-form #add-submit').click(function(e){
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
                emergencyContactsTable.ajax.reload();
                $('#add-security-group-popup').modal('toggle');
                clearEmergencyContactModal('#add-security-group-form');
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


        // EDIT
        var editId = null;
        // Function: On Modal Clicked Handler
        $('#edit-security-group-popup').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
            console.log('Data: ', currentData)

            editId = currentData.id;

            $('#edit-security-group-form #name').val(currentData.name);

        });

        var editRouteTemplate = "{{ route('admin.employees.emergency-contacts.edit.post', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#edit-submit').click(function(e){
            var editRoute = editRouteTemplate.replace(encodeURI('<<id>>'), editId);
            e.preventDefault();
            $.ajax({
                url: editRoute,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: $('#edit-security-group-form #name').val(),
             
                },
                success: function(data) {
                    showAlert(data.success);
                    emergencyContactsTable.ajax.reload();
                    $('#edit-security-group-popup').modal('toggle');
                    clearEmergencyContactModal('#edit-security-group-form');
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
                                        $('#edit-security-group-form #name').addClass('is-invalid');
                                        $('#edit-security-group-form #security-group-id-error').html('<strong>' + errors[errorField][0] + "</strong>");
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
        $('#confirm-delete-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
            console.log('Data: ', currentData)

            deleteId = currentData.id;

        });

        var deleteRouteTemplate = "{{ route('admin.settings.emergency-contacts.delete', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#delete-submit').click(function(e){
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
                    emergencyContactsTable.ajax.reload();
                    $('#confirm-delete-modal').modal('toggle');
                    // clearEmergencyContactModal('#edit-security-group-form');
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
    function clearEmergencyContactModal(htmlId) {
        $(htmlId + ' #security-group-id').val('');


        $(htmlId + ' #security-group-id').removeClass('is-invalid');

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


