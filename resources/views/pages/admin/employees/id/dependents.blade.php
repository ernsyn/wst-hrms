<!-- ADD -->
{{-- <div class="modal fade" id="dependentPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Emergency Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.employees.dependents.post', ['id' => $id]) }}" id="add_employee_dependent">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-7 col-form-label">Name*</label>
                        <div class="col-md-7">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name here" name="name" value="{{ old('name') }}" required> @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span> @endif
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-md-7 col-form-label">Relationship*</label>
                        <div class="col-md-7">
                            <input id="relationship" type="text" class="form-control{{ $errors->has('relationship') ? ' is-invalid' : '' }}" name="relationship" value="{{ old('relationship') }}" required>
                            @if ($errors->has('relationship'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('relationship') }}</strong>
                                </span> @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-7 col-form-label">Date Of Birth*</label>
                        <div class="col-md-7">
                            <input id="altdobDate" name="altdobDate" type="text" class="form-control" hidden>
                            <input name="dobDate" id="dobDate" type="text" class="form-control" readonly>
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
<div class="modal fade" id="add-dependent-popup" tabindex="-1" role="dialog" aria-labelledby="add-dependent-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-dependent-label">Add a Dependent</h5>
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
                    <div class="row form-group">
                        <label class="col-md-12 col-form-label"><strong>Date Of Birth*</strong></label>
                        <div class="col-md-7">
                            <input id="altdobDate" name="altdobDate" type="text" class="form-control" hidden>
                            <input  name="dobDate" id="dobDate" type="text" class="form-control hrms-datepicker" readonly>
                            <div id="dobDate-error" class="invalid-feedback">
                            
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
<div class="modal fade" id="dependentModal" tabindex="-1" role="dialog" aria-labelledby="updateContactLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateContactLabel">Edit Dependent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="edit-dependent-form">
                    @csrf
                    <div class="form-group row">
                        <input id="emp_con_id" name="emp_con_id" type="hidden">
                        <label class="col-md-7 col-form-label">Name*</label>
                        <div class="col-md-7">
                            <input id="name" name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}"
                                required> @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span> @endif
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-md-7 col-form-label">Relationship*</label>
                        <div class="col-md-7">
                            <input id="relationship" type="text" class="form-control{{ $errors->has('relationship') ? ' is-invalid' : '' }}" name="relationship"
                                value="{{ old('relationship') }}" required> @if ($errors->has('relationship'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('relationship') }}</strong>
                                </span> @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-7 col-form-label">Date Of Birth*</label>
                        <div class="col-md-7">
                            <input id="dob" type="text" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" value="{{ old('dob') }}"
                                required> @if ($errors->has('dob'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('dob') }}</strong>
                                </span> @endif
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
                "data": "dob",
                "iDataSort": 1
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
       $('#add-dependent-form #add-submit').click(function(e){
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
                clearDependentModal('#add-dependent-form');
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
    });

    // GENERAL FUNCTIONS
    function clearDependentModal(htmlId) {
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