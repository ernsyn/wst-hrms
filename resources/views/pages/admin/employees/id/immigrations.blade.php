<!-- ADD -->
@can(PermissionConstant::ADD_IMMIGRATION)
<div class="modal fade" id="add-immigration-popup" tabindex="-1" role="dialog" aria-labelledby="add-immigration-label" aria-hidden="true">
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
                            <input name="passport-no" type="text" class="form-control" placeholder="" value="" required>
                            <div id="passport-no-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="issued-by"><strong>Issued By*</strong></label>
                            <input name="issued-by" type="text" class="form-control" placeholder="" value="" required>
                            <div id="issued-by-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="issued-date-immigration"><strong>Issued Date*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="issued-date-immigration" class="form-control datetimepicker-input" data-target="#issued-date-immigration" autocomplete="off"/>
                                <div class="input-group-append" data-target="#issued-date-immigration" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="issued-date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="expiry-date-immigration"><strong>Expiry Date*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="expiry-date-immigration" class="form-control datetimepicker-input" data-target="#expiry-date-immigration" autocomplete="off"/>
                                <div class="input-group-append" data-target="#expiry-date-immigration" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="expiry-date-error" class="invalid-feedback">
                                </div>
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
@endcan
<!-- UPDATE -->
@can(PermissionConstant::UPDATE_IMMIGRATION)
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
                            <input name="passport-no" type="text" class="form-control" placeholder="" value="" required>
                            <div id="passport-no-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="issued-by"><strong>Issued By*</strong></label>
                            <input name="issued-by" type="text" class="form-control" placeholder="" value="" required>
                            <div id="issued-by-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="issued-date-immigration-edit"><strong>Issued Date*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="issued-date-immigration-edit" class="form-control datetimepicker-input" data-target="#issued-date-immigration-edit" autocomplete="off"/>
                                <div class="input-group-append" data-target="#issued-date-immigration-edit" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="issued-date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="expiry-date-immigration-edit"><strong>Expiry Date*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="expiry-date-immigration-edit" class="form-control datetimepicker-input" data-target="#expiry-date-immigration-edit" autocomplete="off"/>
                                <div class="input-group-append" data-target="#expiry-date-immigration-edit" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="expiry-date-error" class="invalid-feedback">
                                </div>
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
@endcan
{{-- DELETE --}}
@can(PermissionConstant::DELETE_IMMIGRATION)
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
@endcan

{{-- TABLE --}}
@can(PermissionConstant::VIEW_IMMIGRATION)
<div class="tab-pane fade show p-3" id="nav-immigration" role="tabpanel" aria-labelledby="nav-immigration-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
        	@can(PermissionConstant::ADD_IMMIGRATION)
            <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-immigration-popup">
                Add Immigration
            </button>
            @endcan
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
@endcan

@section('scripts')
<script>
    var immigrationsTable = $('#employeeImmigrationTable').DataTable({
        "bInfo": true,
        "bDeferRender": true,
        "serverSide": true,
        "bStateSave": true,
        "ajax": "{{ route('admin.employees.dt.immigrations', ['id' => $id]) }}",
        "columnDefs": [ {
            "targets": 5,
            "orderable": false
        } ],
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
                    return `
                    @can(PermissionConstant::UPDATE_IMMIGRATION)
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-immigration-popup"><i class="far fa-edit"></i></button>
					@endcan` + `@can(PermissionConstant::DELETE_IMMIGRATION)
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#confirm-delete-immigration-modal"><i class="far fa-trash-alt"></i></button>
					@endcan
                    `;
                }
            }
        ]
    });

</script>
<script type="text/javascript">
    $(function(){
        //datepicker
        $('#issued-date-immigration').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        //disable keyboard input & hide caret
        $('#issued-date-immigration').keydown(false);
        $('#issued-date-immigration').css('caret-color', 'transparent');

        $('#expiry-date-immigration').datetimepicker({
            format: 'DD/MM/YYYY',
            useCurrent: false
        });
        //disable keyboard input & hide caret
        $('#expiry-date-immigration').keydown(false);
        $('#expiry-date-immigration').css('caret-color', 'transparent');

        $("#issued-date-immigration").on("change.datetimepicker", function (e) {
            $('#expiry-date-immigration').datetimepicker('minDate', e.date);
        });
        $("#expiry-date-immigration").on("change.datetimepicker", function (e) {
            $('#issued-date-immigration').datetimepicker('maxDate', e.date);
        });

        $('#issued-date-immigration-edit').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        //disable keyboard input & hide caret
        $('#issued-date-immigration-edit').keydown(false);
        $('#issued-date-immigration-edit').css('caret-color', 'transparent');

        $('#expiry-date-immigration-edit').datetimepicker({
            format: 'DD/MM/YYYY',
            useCurrent: false
        });
        //disable keyboard input & hide caret
        $('#expiry-date-immigration-edit').keydown(false);
        $('#expiry-date-immigration-edit').css('caret-color', 'transparent');

        $("#issued-date-immigration-edit").on("change.datetimepicker", function (e) {
            $('#expiry-date-immigration-edit').datetimepicker('minDate', e.date);
        });
        $("#expiry-date-immigration-edit").on("change.datetimepicker", function (e) {
            $('#issued-date-immigration-edit').datetimepicker('maxDate', e.date);
        });

        // ADD IMMIGRATIONS
        $('#add-immigration-popup').on('show.bs.modal', function (event) {
            clearImmigrationsError('#add-immigration-form'); //clear error if close or cancel
        });
        $('#add-immigration-form #add-immigration-submit').click(function(e){
            e.preventDefault();
            clearImmigrationsError('#add-immigration-form');
            $.ajax({
                url: "{{ route('admin.employees.immigrations.post', ['id' => $id]) }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    // Form Data
                    passport_no: $('#add-immigration-form input[name=passport-no]').val(),
                    issued_by: $('#add-immigration-form input[name=issued-by]').val(),
                    issued_date: $('#add-immigration-form #issued-date-immigration').val(),
                    expiry_date: $('#add-immigration-form #expiry-date-immigration').val()
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
                                        $('#add-immigration-form input[name=passport-no]').addClass('is-invalid');
                                        $('#add-immigration-form #passport-no-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'issued_by':
                                        $('#add-immigration-form input[name=issued-by]').addClass('is-invalid');
                                        $('#add-immigration-form #issued-by-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'issued_date':
                                        $('#add-immigration-form #issued-date-immigration').addClass('is-invalid');
                                        $('#add-immigration-form #issued-date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'expiry_date':
                                        $('#add-immigration-form #expiry-date-immigration').addClass('is-invalid');
                                        $('#add-immigration-form #expiry-date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
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

            $('#edit-immigration-form input[name=passport-no]').val(currentData.passport_no);
            $('#edit-immigration-form input[name=issued-by]').val(currentData.issued_by);
            $('#edit-immigration-form #issued-date-immigration-edit').val(currentData.issued_date);
            $('#edit-immigration-form #expiry-date-immigration-edit').val(currentData.expiry_date);
        });

        var editImmigrationRouteTemplate = "{{ route('admin.employees.immigrations.edit.post', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#edit-immigration-submit').click(function(e){
            var editImmigrationRoute = editImmigrationRouteTemplate.replace(encodeURI('<<id>>'), editImmigrationId);
            e.preventDefault();
            clearImmigrationsError('#edit-immigration-form');
            $.ajax({
                url: editImmigrationRoute,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    passport_no: $('#edit-immigration-form input[name=passport-no]').val(),
                    issued_by: $('#edit-immigration-form input[name=issued-by]').val(),
                    issued_date: $('#edit-immigration-form #issued-date-immigration-edit').val(),
                    expiry_date: $('#edit-immigration-form #expiry-date-immigration-edit').val()
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
                                        $('#edit-immigration-form input[name=passport-no]').addClass('is-invalid');
                                        $('#edit-immigration-form #passport-no-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'issued_by':
                                        $('#edit-immigration-form input[name=issued-by]').addClass('is-invalid');
                                        $('#edit-immigration-form #issued-by-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'issued_date':
                                        $('#edit-immigration-form #issued-date-immigration-edit').addClass('is-invalid');
                                        $('#edit-immigration-form #issued-date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'expiry_date':
                                        $('#edit-immigration-form #expiry-date-immigration-edit').addClass('is-invalid');
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

        var deleteImmigrationRouteTemplate = "{{ route('admin.settings.immigrations.delete', ['emp_id' => $id, 'id' => '<<id>>']) }}";
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
        $(htmlId + ' input[name=passport-no]').val('');
        $(htmlId + ' input[name=issued-by]').val('');
        $(htmlId + ' #issued-date-immigration').val('');
        $(htmlId + ' #expiry-date-immigration').val('');

        $(htmlId + ' input[name=passport-no]').removeClass('is-invalid');
        $(htmlId + ' input[name=issued-by]').removeClass('is-invalid');
        $(htmlId + ' #issued-date-immigration').removeClass('is-invalid');
        $(htmlId + ' #expiry-date-immigration').removeClass('is-invalid');
    }

    function clearImmigrationsError(htmlId) {
        $(htmlId + ' input[name=passport-no]').removeClass('is-invalid');
        $(htmlId + ' input[name=issued-by]').removeClass('is-invalid');
        $(htmlId + ' #issued-date-immigration').removeClass('is-invalid');
        $(htmlId + ' #expiry-date-immigration').removeClass('is-invalid');
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
