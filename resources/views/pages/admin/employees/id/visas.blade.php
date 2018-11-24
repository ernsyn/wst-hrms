<!-- ADD VISA -->
<div class="modal fade" id="add-visa-popup" tabindex="-1" role="dialog" aria-labelledby="add-visa-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-visa-label">Add Visa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form id="add-visa-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="type"><strong>Type*</strong></label>
                            <input id="type" type="text" class="form-control" placeholder="" value="" required>
                            <div id="type-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="visa-number"><strong>Visa Number*</strong></label>
                            <input id="visa-number" type="text" class="form-control" placeholder="" value="" required>
                            <div id="visa-number-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="passport-no"><strong>Passport Number*</strong></label>
                            <input id="passport-no" type="text" class="form-control" placeholder="" value="" required>
                            <div id="passport-no-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="expiry-date"><strong>Expiry Date*</strong></label>
                            <input id="expiry-date" type="text" class="form-control" placeholder="" value="" required>
                            <div id="expiry-date-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="issued-by"><strong>Issued By*</strong></label>
                            <input id="issued-by" type="text" class="form-control" placeholder="" value="" required>
                            <div id="issued-by-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="issued-date"><strong>Issued Date*</strong></label>
                            <input id="issued-date" type="text" class="form-control" placeholder="" value="" required>
                            <div id="issued-date-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="family-members"><strong>Family Members*</strong></label>
                            <input id="family-members" type="text" class="form-control" placeholder="" value="" required>
                            <div id="family-members-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="add-visa-submit" type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- UPDATE -->
<div class="modal fade" id="updateVisaPopup" tabindex="-1" role="dialog" aria-labelledby="updateVisaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateVisaLabel">Edit Emergency Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.employees.visas.edit.post', ['emp_id' => $id, 'id' => 1]) }}" id="edit_visa">
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
</div>

<div class="tab-pane fade show p-3" id="nav-visa" role="tabpanel" aria-labelledby="nav-visa-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#add-visa-popup">
                Add Visa
            </button>
        </div>
    </div>
    <table class="hrms-primary-data-table table w-100" id="employeeVisaTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Type</th>
                <th>Visa Number</th>
                <th>Passport No</th>
                <th>Expiry Date</th>
                <th>Issued By</th>
                <th>Issued Date</th>
                <th>Family Members</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>



@section('scripts')
<script>
    var visasTable = $('#employeeVisaTable').DataTable({
        "bInfo": true,
        "bDeferRender": true,
        "serverSide": true,
        "bStateSave": true,
        "ajax": "{{ route('admin.employees.dt.visas', ['id' => $id]) }}",
        "columns": [{
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "type"
            },
            {
                "data": "visa_number"
            },
            {
                "data": "passport_no"
            },
            {
                "data": "expiry_date"
            },
            {
                "data": "issued_by"
            },
            {
                "data": "issued_date"
            },
            {
                "data": "family_members"
            },
            {
                "data": null, // can be null or undefined
                "defaultContent": '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#visaModal"><i class="far fa-edit"></i></button>'
            }
        ]
    });

</script>
<script type="text/javascript">
    $(function(){
        // ADD VISA
        $('#add-visa-form #add-visa-submit').click(function(e){
          e.preventDefault();
          $.ajax({
            url: "{{ route('admin.employees.visas.post', ['id' => $id]) }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                // Form Data
                type: $('#add-visa-form #type').val(),
                visa_number: $('#add-visa-form #visa-number').val(),
                passport_no: $('#add-visa-form #passport-no').val(),
                expiry_date: $('#add-visa-form #expiry-date').val(),
                issued_by: $('#add-visa-form #issued-by').val(),
                issued_date: $('#add-visa-form #issued-date').val(),
                family_members: $('#add-visa-form #family-members').val()
            },
            success: function(data) {
                showAlert(data.success);
                visasTable.ajax.reload();
                $('#add-visa-popup').modal('toggle');
                clearVisasModal('#add-visa-form');
            },
            error: function(xhr) {
                if(xhr.status == 422) {
                    var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'type':
                                        $('#add-visa-form #type').addClass('is-invalid');
                                        $('#add-visa-form #type-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'visa_number':
                                        $('#add-visa-form #visa-number').addClass('is-invalid');
                                        $('#add-visa-form #visa-number-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'passport_no':
                                        $('#add-visa-form #passport-no').addClass('is-invalid');
                                        $('#add-visa-form #passport-no-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'expiry_date':
                                        $('#add-visa-form #expiry-date').addClass('is-invalid');
                                        $('#add-visa-form #expiry-date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'issued_by':
                                        $('#add-visa-form #issued-by').addClass('is-invalid');
                                        $('#add-visa-form #issued-by-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'issued_date':
                                        $('#add-visa-form #issued-date').addClass('is-invalid');
                                        $('#add-visa-form #issued-date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'family_members':
                                        $('#add-visa-form #family-members').addClass('is-invalid');
                                        $('#add-visa-form #family-members-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                }
                            }
                        }
                    }
                }
            });
        });

        // EDIT VISA
        var editVisaId = null;
        // Function: On Modal Clicked Handler
        $('#edit-visa-popup').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
            console.log('Data: ', currentData)

            editVisaId = currentData.id;

            $('#edit-visa-form #company').val(currentData.company);
            $('#edit-visa-form #position').val(currentData.position);
            $('#edit-visa-form #start-date').val(currentData.start_date);
            $('#edit-visa-form #end-date').val(currentData.end_date);
            $('#edit-visa-form #notes').val(currentData.notes);
        });

        var editVisaRouteTemplate = "{{ route('admin.employees.visas.edit.post', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#edit-visa-submit').click(function(e){
            var editVisaRoute = editVisaRouteTemplate.replace(encodeURI('<<id>>'), editVisaId);
            e.preventDefault();
            $.ajax({
                url: editVisaRoute,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    company: $('#edit-visa-form #company').val(),
                    position: $('#edit-visa-form #position').val(),
                    start_date: $('#edit-visa-form #start-date').val(),
                    end_date: $('#edit-visa-form #end-date').val(),
                    notes: $('#edit-visa-form #notes').val()
                },
                success: function(data) {
                    showAlert(data.success);
                    visasTable.ajax.reload();
                    $('#edit-visa-popup').modal('toggle');
                    clearVisasModal('#edit-visa-form');
                },
                error: function(xhr) {
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'company':
                                        $('#edit-visa-form #company').addClass('is-invalid');
                                        $('#edit-visa-form #company-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'position':
                                        $('#edit-visa-form #position').addClass('is-invalid');
                                        $('#edit-visa-form #position-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'start_date':
                                        $('#edit-visa-form #start-date').addClass('is-invalid');
                                        $('#edit-visa-form #start-date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'end_date':
                                        $('#edit-visa-form #end-date').addClass('is-invalid');
                                        $('#edit-visa-form #end-date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'notes':
                                        $('#edit-visa-form #notes').addClass('is-invalid');
                                        $('#edit-visa-form #notes-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                }
                            }
                        }
                    }
                }
            });
        });

        // DELETE VISA
        var deleteVisaId = null;
        // Function: On Modal Clicked Handler
        $('#confirm-delete-visa-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
            console.log('Data: ', currentData)

            deleteVisaId = currentData.id;
        });

        var deleteVisaRouteTemplate = "{{ route('admin.settings.visas.delete', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#delete-visa-submit').click(function(e){
            var deleteVisaRoute = deleteVisaRouteTemplate.replace(encodeURI('<<id>>'), deleteVisaId);
            e.preventDefault();
            $.ajax({
                url: deleteVisaRoute,
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: deleteVisaId
                },
                success: function(data) {
                    showAlert(data.success);
                    visasTable.ajax.reload();
                    $('#confirm-delete-visa-modal').modal('toggle');
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
    function clearVisasModal(htmlId) {
        $(htmlId + ' #type').val('');
        $(htmlId + ' #visa-number').val('');
        $(htmlId + ' #passport-no').val('');
        $(htmlId + ' #expiry-date').val('');
        $(htmlId + ' #issued-by').val('');
        $(htmlId + ' #issued-date').val('');
        $(htmlId + ' #family-members').val('');

        $(htmlId + ' #type').removeClass('is-invalid');
        $(htmlId + ' #visa-number').removeClass('is-invalid');
        $(htmlId + ' #passport-no').removeClass('is-invalid');
        $(htmlId + ' #expiry-date').removeClass('is-invalid');
        $(htmlId + ' #issued-by').removeClass('is-invalid');
        $(htmlId + ' #issued-date').removeClass('is-invalid');
        $(htmlId + ' #family-members').removeClass('is-invalid');
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
