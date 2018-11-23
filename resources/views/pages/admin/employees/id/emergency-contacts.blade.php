<!-- ADD -->
<div class="modal fade" id="add-emergency-contact-popup" tabindex="-1" role="dialog" aria-labelledby="add-emergency-contact-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-emergency-contact-label">Add an Emergency Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-emergency-contact-form">
            <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Name*</strong></label>
                            <input id="name" type="text" class="form-control" placeholder="" value="" required>
                            {{-- <div class="valid-feedback">
                            Looks good!
                            </div> --}}
                            <div id="name-error" class="invalid-feedback">
                            
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Relationship*</strong></label>
                            <input id="relationship" type="text" class="form-control" placeholder="eg. Father, Son" value="" required>
                            {{-- <div class="valid-feedback">
                            Looks good!
                            </div> --}}
                            <div id="relationship-error" class="invalid-feedback">
                            
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Contact Number*</strong></label>
                            <input id="contact-no" type="tel" class="form-control" placeholder="eg. 01X-XXX XXXX" value="" required>
                            {{-- <div class="valid-feedback">
                            Looks good!
                            </div> --}}
                            <div id="contact-no-error" class="invalid-feedback">
                            
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button id="add-submit" type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
                {{-- <button id="add-close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            </div>
            </form>
        </div>
    </div>
</div>

<!-- UPDATE -->
<div class="modal fade" id="edit-emergency-contact-popup" tabindex="-1" role="dialog" aria-labelledby="edit-emergency-contact-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-emergency-contact-label">Edit an Emergency Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-emergency-contact-form">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Name*</strong></label>
                            <input id="name" type="text" class="form-control" placeholder="" value="" required>
                            {{-- <div class="valid-feedback">
                            Looks good!
                            </div> --}}
                            <div id="name-error" class="invalid-feedback">
                            
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Relationship*</strong></label>
                            <input id="relationship" type="text" class="form-control" placeholder="eg. Father, Son" value="" required>
                            {{-- <div class="valid-feedback">
                            Looks good!
                            </div> --}}
                            <div id="relationship-error" class="invalid-feedback">
                            
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Contact Number*</strong></label>
                            <input id="contact-no" type="tel" class="form-control" placeholder="eg. 01X-XXX XXXX" value="" required>
                            {{-- <div class="valid-feedback">
                            Looks good!
                            </div> --}}
                            <div id="contact-no-error" class="invalid-feedback">
                            
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button id="edit-submit" type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
                {{-- <button id="add-close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            </div>
            </form>
        </div>
    </div>
</div>
{{-- <div class="modal fade" id="updateContactPopup" tabindex="-1" role="dialog" aria-labelledby="updateContactLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateContactLabel">Edit Emergency Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.employees.emergency-contacts.edit', ['emp_id' => $id, 'id' => 1]) }}" id="edit_emergency_contact">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <input id="emp_con_id" name="emp_con_id" type="hidden">
                            <label class="col-md-5 col-form-label">Name*</label>
                            <div class="col-md-7">
                                <input id="name" name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}"
                                    required> @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span> @endif
                            </div>
                            <label class="col-md-2 col-form-label">Relationship*</label>
                            <div class="col-md-10">
                                <input id="relationship" type="text" class="form-control{{ $errors->has('relationship') ? ' is-invalid' : '' }}" name="relationship"
                                    value="{{ old('relationship') }}" required> @if ($errors->has('relationship'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('relationship') }}</strong>
                                </span> @endif
                            </div>
                            <label class="col-md-2 col-form-label">Contact Number*</label>
                            <div class="col-md-10">
                                <input id="contact_number" type="text" class="form-control{{ $errors->has('contact_number') ? ' is-invalid' : '' }}" name="contact_number"
                                    value="{{ old('contact_number') }}" required> @if ($errors->has('contact_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('contact_number') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<div class="tab-pane fade show p-3" id="nav-emergency" role="tabpanel" aria-labelledby="nav-emergency-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-emergency-contact-popup">
                Add Contact
            </button>
        </div>
    </div>
    <table class="hrms-primary-data-table table w-100" id="emergency-contacts-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Relationship</th>
                <th>Contact Number</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>




@section('scripts')
<script>
var emergencyContactsTable = $('#emergency-contacts-table').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "{{ route('admin.employees.dt.emergency-contacts', ['id' => $id]) }}",
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
            "data": "contact_no"
        },
        {
            "data": null, // can be null or undefined
            render: function (data, type, row, meta) {
                return `<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-emergency-contact-popup"><i class="far fa-edit"></i></button>` +
                    `<button type="button" class="delete-emergency-contact-btn btn btn-danger btn-sm" data-id=${row.id}><i class="far fa-trash-alt"></i></button>`;
            }
        }
    ]
});

</script>
<script type="text/javascript">
    $(function(){
        // ADD
       $('#add-emergency-contact-form #add-submit').click(function(e){
          e.preventDefault();
          $.ajax({
            url: "{{ route('admin.employees.emergency-contacts.post', ['id' => $id]) }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                // Form Data
                name: $('#add-emergency-contact-form #name').val(),
                relationship: $('#add-emergency-contact-form #relationship').val(),
                contact_no: $('#add-emergency-contact-form #contact-no').val()
            },
            success: function(data) {
                showAlert(data.success);
                emergencyContactsTable.ajax.reload();
                $('#add-emergency-contact-popup').modal('toggle');
                clearEmergencyContactModal('#add-emergency-contact-form');
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
                                        $('#add-emergency-contact-form #name').addClass('is-invalid');
                                        $('#add-emergency-contact-form #name-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'relationship':
                                        $('#add-emergency-contact-form #relationship').addClass('is-invalid');
                                        $('#add-emergency-contact-form #relationship-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'contact_no':
                                        $('#add-emergency-contact-form #contact-no').addClass('is-invalid');
                                        $('#add-emergency-contact-form #contact-no-error').html('<strong>' + errors[errorField][0] + '</strong>');
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
       $('#edit-emergency-contact-popup').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
            console.log('Data: ', currentData)

            editId = currentData.id;
            
            $('#edit-emergency-contact-form #name').val(currentData.name);
            $('#edit-emergency-contact-form #relationship').val(currentData.relationship);
            $('#edit-emergency-contact-form #contact-no').val(currentData.contact_no);
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
                name: $('#edit-emergency-contact-form #name').val(),
                relationship: $('#edit-emergency-contact-form #relationship').val(),
                contact_no: $('#edit-emergency-contact-form #contact-no').val()
            },
            success: function(data) {
                showAlert(data.success);
                emergencyContactsTable.ajax.reload();
                $('#edit-emergency-contact-popup').modal('toggle');
                clearEmergencyContactModal('#edit-emergency-contact-form');
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
                                        $('#edit-emergency-contact-form #name').addClass('is-invalid');
                                        $('#edit-emergency-contact-form #name-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'relationship':
                                        $('#edit-emergency-contact-form #relationship').addClass('is-invalid');
                                        $('#edit-emergency-contact-form #relationship-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'contact_no':
                                        $('#edit-emergency-contact-form #contact-no').addClass('is-invalid');
                                        $('#edit-emergency-contact-form #contact-no-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                }
                            }
                        }
                }               
             }
          });
       });
        
    });

    // DELETE
    $('')

    // GENERAL FUNCTIONS
    function clearEmergencyContactModal(htmlId) {
        $(htmlId + ' #name').val('');
        $(htmlId + ' #relationship').val('');
        $(htmlId + ' #contact-no').val('');

        $(htmlId + ' #name').removeClass('is-invalid');
        $(htmlId + ' #relationship').removeClass('is-invalid');
        $(htmlId + ' #contact-no').removeClass('is-invalid');
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