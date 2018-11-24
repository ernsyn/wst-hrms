<div class="tab-pane fade show p-3" id="nav-reportto" role="tabpanel" aria-labelledby="nav-reportto-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#add-report-to-popup">
                Add Report To
            </button>
        </div>
    </div>
    <table class="table table-bordered table-hover" id="report-to-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Full Name</th>
                <th>Type</th>
                <th>Note</th>
                <th>KPI Proposer</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

<!-- ADD -->
{{-- <div class="modal fade" id="add-report-to-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Report To</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('add_report_to') }}" id="add_report_to">
                        @csrf
                        <div class="row pb-5">
                            <div class="col-xl-8">
                                <label class="col-md-5 col-form-label">Report To*</label>
                                <div class="col-md-7">
                                    <select class="form-control{{ $errors->has('employees') ? ' is-invalid' : '' }}" name="employees" id="employees">
                                        @foreach(App\Employee::with('user')->get() as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->user->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('employees'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('employees') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label class="col-md-7 col-form-label">Type*</label>
                                <div class="col-md-10">
                                    <select class="form-control" id="type" name="type">
                                        <option value="Direct">Direct</option>
                                        <option value="Indirect">Indirect</option>
                                    </select>
                                </div>
                                <label class="col-md-12 col-form-label">KPI Proposer*</label>
                                <div class="col-md-7">
                                    <input type="hidden" value="0" checked id="kpi_proposer" name="kpi_proposer">
                                    <input type="checkbox" value="1" checked id="kpi_proposer" name="kpi_proposer">
                                </div>
                                <label class="col-md-5 col-form-label">Note</label>
                                <div class="col-md-10">
                                    <textarea name="note" id="note" class="form-control"></textarea>
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

<div class="modal fade" id="add-report-to-popup" tabindex="-1" role="dialog" aria-labelledby="add-report-to-label"
    aria-hidden="true">
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
                                @foreach(App\Employee::with('user')->get() as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->user->name }}</option>
                                @endforeach
                            </select>
                            {{-- <div class="valid-feedback">
                            Looks good!
                            </div> --}}
                            <div id="report-to-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="type"><strong>Type*</strong></label>
                            <select class="form-control" id="type" name="type">
                                <option value="Direct">Direct</option>
                                <option value="Indirect">Indirect</option>
                            </select>
                            {{-- <div class="valid-feedback">
                            Looks good!
                            </div> --}}
                            <div id="type-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="kpi-proposer"><strong>KPI Proposer*</strong></label>

                            <input type="hidden" value="0" checked>
                            <input id="kpi-proposer" type="checkbox" value="1" checked id="kpi_proposer" name="kpi_proposer">
                            {{-- <div class="valid-feedback">
                            Looks good!
                            </div> --}}
                            <div id="kpi-proposer-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="notes"><strong>Notes*</strong></label>
                            <input id="notes" type="text" class="form-control" placeholder="" value="" required>
                            {{-- <div class="valid-feedback">
                            Looks good!
                            </div> --}}
                            <div id="notes-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>

                    {{--  --}}
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

@section('scripts')
<script>
    var reportTosTable = $('#report-to-table').DataTable({
        "bInfo": true,
        "bDeferRender": true,
        "serverSide": true,
        "bStateSave": true,
        "ajax": "{{ route('admin.employees.dt.report-to', ['id' => $id]) }}",
        "columns": [{
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "report_to.user.name"
            },
            {
                "data": "type"
            },
            {
                "data": "notes",
            },
            {
                "data": "kpi_proposer",
            },
            {
                data: "update_url",
                render: function (data, type, row, meta) {
                    return '<button type="button" class="open-update-dependent-modal btn btn-success btn-sm" data-toggle="modal" data-action="' + encodeURI(JSON.stringify(row)) + '" data-target="#dependentModal"><i class="far fa-edit"></i></button>' ;
                }
            }
        ]
    });

    // $(function () {
    //     $(document).on("click", ".open-update-dependent-modal", function () {
    //         console.log("Updating route: ", JSON.parse(decodeURI($(this).data('action'))));
    //         $('#edit-dependent-form').attr("action", $(this).data('action'));
    //         $('#dependentModal').modal('show');
    //     });

    //     $('#my_modal').on('show.bs.modal', function(e) {

    //         //get data-id attribute of the clicked element
    //         var bookId = $(e.relatedTarget).data('book-id');

    //         //populate the textbox
    //         $(e.currentTarget).find('input[name="bookId"]').val(bookId);
    //     });
    // });

</script>
<script type="text/javascript">
    $(function(){
        // ADD
       $('#add-report-to-form #add-submit').click(function(e){
          e.preventDefault();
          $.ajax({
            url: "{{ route('admin.employees.report-to.post', ['id' => $id]) }}",
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
                dependentsTable.ajax.reload();
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
    });

    // GENERAL FUNCTIONS
    function clearReportToModal(htmlId) {
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
