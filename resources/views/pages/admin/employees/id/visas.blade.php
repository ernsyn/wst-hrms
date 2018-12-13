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
                            <label for="issued-by"><strong>Issued By*</strong></label>
                            <input id="issued-by" type="text" class="form-control" placeholder="" value="" required>
                            <div id="issued-by-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="issued-date-visa"><strong>Issued Date*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="issued-date-visa" class="form-control datetimepicker-input" data-target="#issued-date-visa"/>
                                <div class="input-group-append" data-target="#issued-date-visa" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="issued-date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="expiry-date-visa"><strong>Expiry Date*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="expiry-date-visa" class="form-control datetimepicker-input" data-target="#expiry-date-visa"/>
                                <div class="input-group-append" data-target="#expiry-date-visa" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="expiry-date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="family-members"><strong>Relationship*</strong></label>
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

<!-- UPDATE VISA -->
<div class="modal fade" id="edit-visa-popup" tabindex="-1" role="dialog" aria-labelledby="edit-visa-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-visa-label">Edit Visa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
            </div>
            <form id="edit-visa-form">
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
                            <input id="visa-number-edit" type="text" class="form-control" placeholder="" value="" required>
                            <div id="visa-number-error" class="invalid-feedback">
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
                        <div class="col-md-8 mb-3">
                            <label for="issued-date-visa-edit"><strong>Issued Date*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="issued-date-visa-edit" class="form-control datetimepicker-input" data-target="#issued-date-visa-edit"/>
                                <div class="input-group-append" data-target="#issued-date-visa-edit" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="issued-date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="expiry-date-visa-edit"><strong>Expiry Date*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="expiry-date-visa-edit" class="form-control datetimepicker-input" data-target="#expiry-date-visa-edit"/>
                                <div class="input-group-append" data-target="#expiry-date-visa-edit" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="expiry-date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="family-members"><strong>Relationship*</strong></label>
                            <input id="family-members" type="text" class="form-control" placeholder="" value="" required>
                            <div id="family-members-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="edit-visa-submit" type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- DELETE VISA --}}
<div class="modal fade" id="confirm-delete-visa-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-visa-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirm-delete-visa-label">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
            </div>
            <div class="modal-body">
                    <p>Are you sure want to delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="delete-visa-submit">Delete</button>
            </div>
        </div>
    </div>
</div>

{{-- TABLE --}}
<div class="tab-pane fade show p-3" id="nav-visa" role="tabpanel" aria-labelledby="nav-visa-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-visa-popup">
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
                <th>Issued By</th>
                <th>Issued Date</th>
                <th>Expiry Date</th>
                <th>Relationship</th>
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
        "columnDefs": [ {
            "targets": 7,
            "orderable": false
        } ],
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
                "data": "issued_by"
            },
            {
                "data": "issued_date"
            },
            {
                "data": "expiry_date"
            },
            {
                "data": "family_members"
            },
            {
                "data": null,
                render: function (data, type, row, meta) {
                    return `<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-visa-popup"><i class="far fa-edit"></i></button>` +
                        `<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#confirm-delete-visa-modal"><i class="far fa-trash-alt"></i></button>`;
                }
            }
        ]
    });

</script>
<script type="text/javascript">
    $(function(){
        //datepicker
        $('#issued-date-visa').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $('#expiry-date-visa').datetimepicker({
            format: 'DD/MM/YYYY',
            useCurrent: false
        });
        $("#issued-date-visa").on("change.datetimepicker", function (e) {
            $('#expiry-date-visa').datetimepicker('minDate', e.date);
        });
        $("#expiry-date-visa").on("change.datetimepicker", function (e) {
            $('#issued-date-visa').datetimepicker('maxDate', e.date);
        });

        $('#issued-date-visa-edit').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $('#expiry-date-visa-edit').datetimepicker({
            format: 'DD/MM/YYYY',
            useCurrent: false
        });
        $("#issued-date-visa-edit").on("change.datetimepicker", function (e) {
            $('#expiry-date-visa-edit').datetimepicker('minDate', e.date);
        });
        $("#expiry-date-visa-edit").on("change.datetimepicker", function (e) {
            $('#issued-date-visa-edit').datetimepicker('maxDate', e.date);
        });

        // ADD VISA
        $('#add-visa-popup').on('show.bs.modal', function (event) {
            clearVisasError('#add-visa-form');
        });
        $('#add-visa-form #add-visa-submit').click(function(e){
          e.preventDefault();
            clearVisasError('#add-visa-form');
          $.ajax({
            url: "{{ route('admin.employees.visas.post', ['id' => $id]) }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                // Form Data
                type: $('#add-visa-form #type').val(),
                visa_number: $('#add-visa-form #visa-number').val(),
                issued_by: $('#add-visa-form #issued-by').val(),
                issued_date: $('#add-visa-form #issued-date-visa').val(),
                expiry_date: $('#add-visa-form #expiry-date-visa').val(),
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

                                    case 'issued_by':
                                        $('#add-visa-form #issued-by').addClass('is-invalid');
                                        $('#add-visa-form #issued-by-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'issued_date':
                                        $('#add-visa-form #issued-date-visa').addClass('is-invalid');
                                        $('#add-visa-form #issued-date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'expiry_date':
                                        $('#add-visa-form #expiry-date-visa').addClass('is-invalid');
                                        $('#add-visa-form #expiry-date-error').html('<strong>' + errors[errorField][0] + '</strong>');
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
            clearVisasError('#edit-visa-form');
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
            console.log('Data: ', currentData)

            editVisaId = currentData.id;

            $('#edit-visa-form #type').val(currentData.type);
            $('#edit-visa-form #visa-number-edit').val(currentData.visa_number);
            $('#edit-visa-form #issued-by').val(currentData.issued_by);
            $('#edit-visa-form #issued-date-visa-edit').val(currentData.issued_date);
            $('#edit-visa-form #expiry-date-visa-edit').val(currentData.expiry_date);
            $('#edit-visa-form #family-members').val(currentData.family_members);
        });

        var editVisaRouteTemplate = "{{ route('admin.employees.visas.edit.post', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#edit-visa-submit').click(function(e){
            var editVisaRoute = editVisaRouteTemplate.replace(encodeURI('<<id>>'), editVisaId);
            e.preventDefault();
            clearVisasError('#edit-visa-form');
            $.ajax({
                url: editVisaRoute,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    type: $('#edit-visa-form #type').val(),
                    visa_number: $('#edit-visa-form #visa-number-edit').val(),

                    issued_by: $('#edit-visa-form #issued-by').val(),
                    issued_date: $('#edit-visa-form #issued-date-visa-edit').val(),
                    expiry_date: $('#edit-visa-form #expiry-date-visa-edit').val(),
                    family_members: $('#edit-visa-form #family-members').val()
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
                                    case 'type':
                                        $('#edit-visa-form #type').addClass('is-invalid');
                                        $('#edit-visa-form #type-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'visa_number':
                                        $('#edit-visa-form #visa-number-edit').addClass('is-invalid');
                                        $('#edit-visa-form #visa-number-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;

                                    case 'issued_by':
                                        $('#edit-visa-form #issued-by').addClass('is-invalid');
                                        $('#edit-visa-form #issued-by-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'issued_date':
                                        $('#edit-visa-form #issued-date-visa-edit').addClass('is-invalid');
                                        $('#edit-visa-form #issued-date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'expiry_date':
                                        $('#edit-visa-form #expiry-date-visa-edit').addClass('is-invalid');
                                        $('#edit-visa-form #expiry-date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'family_members':
                                        $('#edit-visa-form #family-members').addClass('is-invalid');
                                        $('#edit-visa-form #family-members-error').html('<strong>' + errors[errorField][0] + '</strong>');
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
            var button = $(event.relatedTarget)
            var currentData = JSON.parse(decodeURI(button.data('current')))
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
        $(htmlId + ' #visa-number-edit').val('');

        $(htmlId + ' #issued-by').val('');
        $(htmlId + ' #issued-date-visa').val('');
        $(htmlId + ' #expiry-date-visa').val('');
        $(htmlId + ' #family-members').val('');

        $(htmlId + ' #type').removeClass('is-invalid');
        $(htmlId + ' #visa-number').removeClass('is-invalid');
        $(htmlId + ' #visa-number-edit').removeClass('is-invalid');

        $(htmlId + ' #issued-by').removeClass('is-invalid');
        $(htmlId + ' #issued-date-visa').removeClass('is-invalid');
        $(htmlId + ' #expiry-date-visa').removeClass('is-invalid');
        $(htmlId + ' #family-members').removeClass('is-invalid');
    }

    function clearVisasError(htmlId) {
        $(htmlId + ' #type').removeClass('is-invalid');
        $(htmlId + ' #visa-number').removeClass('is-invalid');
        $(htmlId + ' #visa-number-edit').removeClass('is-invalid');

        $(htmlId + ' #issued-by').removeClass('is-invalid');
        $(htmlId + ' #issued-date-visa').removeClass('is-invalid');
        $(htmlId + ' #expiry-date-visa').removeClass('is-invalid');
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
