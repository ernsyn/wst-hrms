{{-- TABLE --}}
<div class="tab-pane fade show p-3" id="nav-reportto" role="tabpanel" aria-labelledby="nav-reportto-tab">
    {{-- <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#add-report-to-popup">
                    Add Report To
                </button>
        </div>
    </div> --}}
    <table class="hrms-primary-data-table table w-100" id="report-to-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Full Name</th>
                <th>Type</th>
                <th>Note</th>
                <th>KPI Proposer</th>
                <th>Report To Level</th>
                {{-- <th>Action</th> --}}
            </tr>
        </thead>
    </table>
</div>
{{-- ADD --}}
<div class="modal fade" id="add-report-to-popup" tabindex="-1" role="dialog" aria-labelledby="add-report-to-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-report-to-label">Assign Report To</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form id="add-report-to-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="report-to"><strong>Report To*</strong></label>
                            <select class="form-control" name="report-to" id="report-to">
                                    <option value="">Select Name</option>
                                    @foreach(App\Employee::with('user')->get() as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->user->name }}</option>
                                    @endforeach
                                </select>
                            <div id="report-to-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="type"><strong>Type*</strong></label>
                            <select class="form-control" id="type" name="type">
                                    <option value="">Select Name</option>
                                    <option value="Direct">Direct</option>
                                    <option value="Indirect">Indirect</option>
                                </select>
                            <div id="type-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="kpi-proposer"><strong>KPI Proposer*</strong></label>

                            <input type="hidden" value="0" checked>
                            <input id="kpi-proposer" type="checkbox" value="1" checked id="kpi_proposer" name="kpi_proposer">
                            <div id="kpi-proposer-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="notes"><strong>Notes*</strong></label>
                            <input id="notes" type="text" class="form-control" placeholder="" value="" readonly>
                            <div id="notes-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="add-report-to-submit" type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- UPDATE --}}
<div class="modal fade" id="edit-report-to-popup" tabindex="-1" role="dialog" aria-labelledby="edit-report-to-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-report-to-label">View Assign Report To</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
            </div>
            <form id="edit-report-to-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="report-to"><strong>Report To*</strong></label>
                            {{-- <select class="form-control" name="report-to" id="report-to">
                                        @foreach(App\Employee::with('user')->get() as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->user->name }}</option>
                                        @endforeach
                                    </select> --}}
                            <input id="report-to" type="text" class="form-control" placeholder="" value="" readonly>
                            <div id="report-to-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="type"><strong>Type*</strong></label>
                            {{-- <select class="form-control" id="type" name="type">
                                        <option value="Direct">Direct</option>
                                        <option value="Indirect">Indirect</option>
                                    </select> --}}
                            <input id="type" type="text" class="form-control" placeholder="" value="" readonly>
                            <div id="type-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="kpi-proposer"><strong>KPI Proposer*</strong></label>
                            <input type="hidden" value="0" checked>
                            <input id="kpi-proposer" type="checkbox" value="1" checked id="kpi_proposer" name="kpi_proposer">
                            <div id="kpi-proposer-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div> --}}
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="notes"><strong>Notes*</strong></label>
                            <input id="notes" type="text" class="form-control" placeholder="" value="" readonly>
                            <div id="notes-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button id="edit-report-to-submit" type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button> --}}
                </div>
            </form>
        </div>
    </div>
</div>
{{-- DELETE EXP--}}
<div class="modal fade" id="confirm-delete-report-to-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-report-to-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirm-delete-report-to-label">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="delete-report-to-submit">Delete</button>
            </div>
        </div>
    </div>
</div>


@section('scripts')
<script>
    var reportTosTable = $('#report-to-table').DataTable({
            "bInfo": true,
            "bDeferRender": true,
            "serverSide": true,
            "bStateSave": true,
            "ajax": "{{ route('employee.dt.report-to', ['id' => $id]) }}",
            "columns": [{
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "data": "employee_report_to.user.name"
                },
                {
                    "data": "type"
                },
                {
                    "data": "notes",
                },
                {
                    "data": "kpi_proposer",

                    render: function(data) {
                        if(data ==1) {
                        return '<i class="fas fa-check-circle" style="color:green"></i>'

                        }
                        else {
                        return '<i class="fas fa-times-circle" style="color:red"></i>'
                        }

                    },
                    defaultContent: ''
                },
                {
                "data": "report_to_level",
                }
                // {
                //     "data": null,
                //     render: function (data, type, row, meta) {
                //         return `<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-report-to-popup"><i class="far fa-eye"></i></button>`;
                //             // `<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#confirm-delete-report-to-modal"><i class="far fa-trash-alt"></i></button>`;
                //     }
                // }
            ]
        });
</script>
<script type="text/javascript">
    $(function(){
            // ADD
            $('#add-report-to-popup').on('show.bs.modal', function (event) {
                clearReportToError('#add-report-to-form');
            });
            $('#add-report-to-form #add-report-to-submit').click(function(e){
                clearReportToError('#add-report-to-form');
                e.preventDefault();
                $.ajax({
                    url: "{{ route('employee.report-to.post', ['id' => $id]) }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        report_to_emp_id: $('#add-report-to-form #report-to').val(),
                        type: $('#add-report-to-form #type').val(),
                        kpi_proposer: $('#add-report-to-form #kpi-proposer').val(),
                        notes: $('#add-report-to-form #notes').val()
                    },
                    success: function(data) {
                        showAlert(data.success);
                        reportTosTable.ajax.reload();
                        $('#add-report-to-popup').modal('toggle');
                        clearReportToModal('#add-report-to-form');
                    },
                    error: function(xhr) {
                        if(xhr.status == 422) {
                            var errors = xhr.responseJSON.errors;
                            console.log("Error: ", xhr);
                            for (var errorField in errors) {
                                if (errors.hasOwnProperty(errorField)) {
                                    console.log("Error: ", errorField);
                                    switch(errorField) {
                                        case 'report_to_emp_id':
                                            $('#add-report-to-form #report-to').addClass('is-invalid');
                                            $('#add-report-to-form #report-to-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                        break;
                                        case 'type':
                                            $('#add-report-to-form #type').addClass('is-invalid');
                                            $('#add-report-to-form #type-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                        break;
                                        case 'kpi_proposer':
                                            $('#add-report-to-form #kpi-proposer').addClass('is-invalid');
                                            $('#add-report-to-form #kpi-proposer-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                        break;
                                        case 'notes':
                                            $('#add-report-to-form #notes').addClass('is-invalid');
                                            $('#add-report-to-form #notes-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                        break;
                                    }
                                }
                            }
                        }
                    }
                });
            });

            // EDIT REPORT TO
            var editReportToId = null;
            // Function: On Modal Clicked Handler
            $('#edit-report-to-popup').on('show.bs.modal', function (event) {
                clearReportToError('#edit-report-to-form');
                var button = $(event.relatedTarget) // Button that triggered the modal
                var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
                console.log('Data: ', currentData)

                editReportToId = currentData.id;

                $('#edit-report-to-form #report-to').val(currentData.report_to_emp_id);
                $('#edit-report-to-form #type').val(currentData.type);
                $('#edit-report-to-form #kpi-proposer').val(currentData.kpi_proposer);
                $('#edit-report-to-form #notes').val(currentData.notes);
            });

            var editReportToRouteTemplate = "{{ route('employee.report-to.edit.post', ['emp_id' => $id, 'id' => '<<id>>']) }}";
            $('#edit-report-to-submit').click(function(e){
                clearReportToError('#edit-report-to-form');
                var editReportToRoute = editReportToRouteTemplate.replace(encodeURI('<<id>>'), editReportToId);
                e.preventDefault();
                $.ajax({
                    url: editReportToRoute,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        report_to_emp_id: $('#edit-report-to-form #report-to').val(),
                        type: $('#edit-report-to-form #type').val(),
                        kpi_proposer: $('#edit-report-to-form #kpi-proposer').val(),
                        notes: $('#edit-report-to-form #notes').val()
                    },
                    success: function(data) {
                        showAlert(data.success);
                        reportTosTable.ajax.reload();
                        $('#edit-report-to-popup').modal('toggle');
                        clearReportToModal('#edit-report-to-form');
                    },
                    error: function(xhr) {
                        if(xhr.status == 422) {
                            var errors = xhr.responseJSON.errors;
                            console.log("Error: ", xhr);
                            for (var errorField in errors) {
                                if (errors.hasOwnProperty(errorField)) {
                                    console.log("Error: ", errorField);
                                    switch(errorField) {
                                        case 'report_to_emp_id':
                                            $('#edit-report-to-form #report-to').addClass('is-invalid');
                                            $('#edit-report-to-form #report-to-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                        break;
                                        case 'type':
                                            $('#edit-report-to-form #type').addClass('is-invalid');
                                            $('#edit-report-to-form #type-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                        break;
                                        case 'kpi_proposer':
                                            $('#edit-report-to-form #kpi-proposer').addClass('is-invalid');
                                            $('#edit-report-to-form #kpi-proposer-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                        break;
                                        case 'notes':
                                            $('#edit-report-to-form #notes').addClass('is-invalid');
                                            $('#edit-report-to-form #notes-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                        break;
                                    }
                                }
                            }
                        }
                    }
                });
            });

            // DELETE REPORT TO
            var deleteReportToId = null;
            // Function: On Modal Clicked Handler
            $('#confirm-delete-report-to-modal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
                console.log('Data: ', currentData)

                deleteReportToId = currentData.id;
            });
            var deleteReportToRouteTemplate = "{{ route('employee.report-tos.delete', ['emp_id' => $id, 'id' => '<<id>>']) }}";
            $('#delete-report-to-submit').click(function(e){
                var deleteReportToRoute = deleteReportToRouteTemplate.replace(encodeURI('<<id>>'), deleteReportToId);
                e.preventDefault();
                $.ajax({
                    url: deleteReportToRoute,
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: deleteReportToId
                    },
                    success: function(data) {
                        showAlert(data.success);
                        reportTosTable.ajax.reload();
                        $('#confirm-delete-report-to-modal').modal('toggle');
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
        function clearReportToModal(htmlId) {
            $(htmlId + ' #report-to').val('');
            $(htmlId + ' #type').val('');
            $(htmlId + ' #kpi-proposer').val('');
            $(htmlId + ' #notes').val('');

            $(htmlId + ' #report-to').removeClass('is-invalid');
            $(htmlId + ' #type').removeClass('is-invalid');
            $(htmlId + ' #kpi-proposer').removeClass('is-invalid');
            $(htmlId + ' #notes').removeClass('is-invalid');
        }

        function clearReportToError(htmlId) {
            $(htmlId + ' #report-to').removeClass('is-invalid');
            $(htmlId + ' #type').removeClass('is-invalid');
            $(htmlId + ' #kpi-proposer').removeClass('is-invalid');
            $(htmlId + ' #notes').removeClass('is-invalid');
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
