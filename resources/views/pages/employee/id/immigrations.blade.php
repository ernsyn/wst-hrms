<!-- ADD -->
<div class="modal fade" id="add-immigration-popup" tabindex="-1" role="dialog" aria-labelledby="add-immigration-label" aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-immigration-label">Add Immigration</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form id="add-immigration-form">
                    <div class="modal-body">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="passport-no"><strong>Passport No*</strong></label>
                                <input id="passport-no" type="text" class="form-control" placeholder="" value="" required>
                                <div id="passport-no-error" class="invalid-feedback">
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
                                <input id="alt-issued-date" name="alt-issued-date" type="text" class="form-control" hidden>
                                <input id="issued-date" type="text" class="form-control issued-date" readonly>
                                <div id="issued-date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="expiry-date"><strong>Expiry Date*</strong></label>
                                <input id="alt-expiry-date" name="alt-expiry-date" type="text" class="form-control" hidden>
                                <input id="expiry-date" type="text" class="form-control expiry-date" readonly>
                                <div id="expiry-date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="add-immigration-submit" type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- UPDATE -->
    <div class="modal fade" id="edit-immigration-popup" tabindex="-1" role="dialog" aria-labelledby="edit-immigration-label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-immigration-label">Edit Immigration</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                </div>
                <form id="edit-immigration-form">
                    <div class="modal-body">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="passport-no"><strong>Passport No*</strong></label>
                                <input id="passport-no" type="text" class="form-control" placeholder="" value="" required>
                                <div id="passport-no-error" class="invalid-feedback">
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
                                <label for="expiry-date"><strong>Expiry Date*</strong></label>
                                <input id="expiry-date" type="text" class="form-control" placeholder="" value="" required>
                                <div id="expiry-date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="edit-immigration-submit" type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- DELETE --}}
    <div class="modal fade" id="confirm-delete-immigration-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-immigration-label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirm-delete-immigration-label">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                </div>
                <div class="modal-body">
                        <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="delete-immigration-submit">Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- TABLE --}}
    <div class="tab-pane fade show p-3" id="nav-immigration" role="tabpanel" aria-labelledby="nav-immigration-tab">
        <div class="row pb-3">
            <div class="col-auto mr-auto"></div>
            <div class="col-auto">
                <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#add-immigration-popup">
                    Add Immigration
                </button>
            </div>
        </div>
        <table class="hrms-primary-data-table table w-100" id="employeeImmigrationTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Passport No</th>
                    <th>Issued By</th>
                    <th>Issued Date</th>
                    <th>Expiry Date</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    @section('scripts')
    <script>
        var immigrationsTable = $('#employeeImmigrationTable').DataTable({
            "bInfo": true,
            "bDeferRender": true,
            "serverSide": true,
            "bStateSave": true,
            "ajax": "{{ route('employee.dt.immigrations', ['id' => $id]) }}",

            "columns": [{
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "data": "passport_no"
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
                    "data": null,
                    render: function (data, type, row, meta) {
                        return `<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-immigration-popup"><i class="far fa-edit"></i></button>` +
                            `<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#confirm-delete-immigration-modal"><i class="far fa-trash-alt"></i></button>`;
                    }
                }
            ]
        });

    </script>
    <script type="text/javascript">
        $(function(){
            //datepicker
            $('.issued-date').datepicker({
                altField: "#alt-issued-date",
                altFormat: 'yy-mm-dd',
                format: 'dd/mm/yy',
                changeMonth: true,
                changeYear: true,
                yearRange: "-10:+20"
            });

            $('.expiry-date').datepicker({
                altField: "#alt-expiry-date",
                altFormat: 'yy-mm-dd',
                format: 'dd/mm/yy',
                changeMonth: true,
                changeYear: true,
                yearRange: "-10:+20"
            });
            // ADD IMMIGRATIONS
            $('#add-immigration-popup').on('show.bs.modal', function (event) {
                clearImmigrationsError('#add-immigration-form'); //clear error if close or cancel
            });
            $('#add-immigration-form #add-immigration-submit').click(function(e){
                e.preventDefault();
                clearImmigrationsError('#add-immigration-form');
                $.ajax({
                    url: "{{ route('employee.immigrations.post', ['id' => $id]) }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        // Form Data
                        passport_no: $('#add-immigration-form #passport-no').val(),
                        issued_by: $('#add-immigration-form #issued-by').val(),
                        issued_date: $('#add-immigration-form #alt-issued-date').val(),
                        expiry_date: $('#add-immigration-form #alt-expiry-date').val()
                    },
                    success: function(data) {
                        showAlert(data.success);
                        immigrationsTable.ajax.reload();
                        $('#add-immigration-popup').modal('toggle');
                        clearImmigrationsModal('#add-immigration-form');
                    },
                    error: function(xhr) {
                        if(xhr.status == 422) {
                            var errors = xhr.responseJSON.errors;
                            console.log("Error xhr: ", xhr);
                            for (var errorField in errors) {
                                if (errors.hasOwnProperty(errorField)) {
                                    console.log("Error errorfield: ", errorField);
                                    switch(errorField) {
                                        case 'passport_no':
                                            $('#add-immigration-form #passport-no').addClass('is-invalid');
                                            $('#add-immigration-form #passport-no-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                        break;
                                        case 'issued_by':
                                            $('#add-immigration-form #issued-by').addClass('is-invalid');
                                            $('#add-immigration-form #issued-by-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                        break;
                                        case 'issued_date':
                                            $('#add-immigration-form #issued-date').addClass('is-invalid');
                                            $('#add-immigration-form #issued-date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                        break;
                                        case 'expiry_date':
                                            $('#add-immigration-form #expiry-date').addClass('is-invalid');
                                            $('#add-immigration-form #expiry-date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                        break;
                                        default:
                                            $('#add-immigration-form #passport-no').removeClass('is-invalid');
                                    }
                                }
                            }
                        }
                    }
                });
            });

            // EDIT EXPERIENCE
            var editImmigrationId = null;
            // Function: On Modal Clicked Handler
            $('#edit-immigration-popup').on('show.bs.modal', function (event) {
                clearImmigrationsError('#edit-immigration-form'); //clear error if close or cancel
                var button = $(event.relatedTarget) // Button that triggered the modal
                var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
                console.log('Data: ', currentData)

                editImmigrationId = currentData.id;

                $('#edit-immigration-form #passport-no').val(currentData.passport_no);
                $('#edit-immigration-form #issued-date').val(currentData.issued_date);
                $('#edit-immigration-form #issued-by').val(currentData.issued_by);
                $('#edit-immigration-form #expiry-date').val(currentData.expiry_date);
            });

            var editImmigrationRouteTemplate = "{{ route('employee.immigrations.edit.post', ['emp_id' => $id, 'id' => '<<id>>']) }}";
            $('#edit-immigration-submit').click(function(e){
                var editImmigrationRoute = editImmigrationRouteTemplate.replace(encodeURI('<<id>>'), editImmigrationId);
                e.preventDefault();
                clearImmigrationsError('#edit-immigration-form');
                $.ajax({
                    url: editImmigrationRoute,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        passport_no: $('#edit-immigration-form #passport-no').val(),
                        issued_by: $('#edit-immigration-form #issued-by').val(),
                        issued_date: $('#edit-immigration-form #issued-date').val(),
                        expiry_date: $('#edit-immigration-form #expiry-date').val()
                    },
                    success: function(data) {
                        showAlert(data.success);
                        immigrationsTable.ajax.reload();
                        $('#edit-immigration-popup').modal('toggle');
                        clearImmigrationsModal('#edit-immigration-form');
                    },
                    error: function(xhr) {
                        if(xhr.status == 422) {
                            var errors = xhr.responseJSON.errors;
                            console.log("Error: ", xhr);
                            for (var errorField in errors) {
                                if (errors.hasOwnProperty(errorField)) {
                                    console.log("Error: ", errorField);
                                    switch(errorField) {
                                        case 'passport_no':
                                            $('#edit-immigration-form #passport-no').addClass('is-invalid');
                                            $('#edit-immigration-form #passport-no-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                        break;
                                        case 'issued_by':
                                            $('#edit-immigration-form #issued-by').addClass('is-invalid');
                                            $('#edit-immigration-form #issued-by-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                        break;
                                        case 'issued_date':
                                            $('#edit-immigration-form #issued-date').addClass('is-invalid');
                                            $('#edit-immigration-form #issued-date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                        break;
                                        case 'expiry_date':
                                            $('#edit-immigration-form #expiry-date').addClass('is-invalid');
                                            $('#edit-immigration-form #expiry-date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                        break;
                                    }
                                }
                            }
                        }
                    }
                });
            });

            // DELETE EXPERIENCE
            var deleteImmigrationId = null;
            // Function: On Modal Clicked Handler
            $('#confirm-delete-immigration-modal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
                console.log('Data: ', currentData)

                deleteImmigrationId = currentData.id;
            });

            var deleteImmigrationRouteTemplate = "{{ route('employee.immigrations.delete', ['emp_id' => $id, 'id' => '<<id>>']) }}";
            $('#delete-immigration-submit').click(function(e){
                var deleteImmigrationRoute = deleteImmigrationRouteTemplate.replace(encodeURI('<<id>>'), deleteImmigrationId);
                e.preventDefault();
                $.ajax({
                    url: deleteImmigrationRoute,
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: deleteImmigrationId
                    },
                    success: function(data) {
                        showAlert(data.success);
                        immigrationsTable.ajax.reload();
                        $('#confirm-delete-immigration-modal').modal('toggle');
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
        function clearImmigrationsModal(htmlId) {
            $(htmlId + ' #passport-no').val('');
            $(htmlId + ' #issued-by').val('');
            $(htmlId + ' #issued-date').val('');
            $(htmlId + ' #expiry-date').val('');

            $(htmlId + ' #passport-no').removeClass('is-invalid');
            $(htmlId + ' #issued-by').removeClass('is-invalid');
            $(htmlId + ' #issued-date').removeClass('is-invalid');
            $(htmlId + ' #expiry-date').removeClass('is-invalid');
        }

        function clearImmigrationsError(htmlId) {
            $(htmlId + ' #passport-no').removeClass('is-invalid');
            $(htmlId + ' #issued-by').removeClass('is-invalid');
            $(htmlId + ' #issued-date').removeClass('is-invalid');
            $(htmlId + ' #expiry-date').removeClass('is-invalid');
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
