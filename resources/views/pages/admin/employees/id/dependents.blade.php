<!-- ADD -->
<div class="modal fade" id="dependentPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <label class="col-md-5 col-form-label">Name*</label>
                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    placeholder="Name here" name="name" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-8 col-form-label">Relationship*</label>
                            <div class="col-md-10">
                                <input id="relationship" type="text" class="form-control{{ $errors->has('relationship') ? ' is-invalid' : '' }}"
                                    placeholder="Farther, Son, etc" name="relationship" value="{{ old('relationship') }}"
                                    required>
                                @if ($errors->has('relationship'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('relationship') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-5 col-form-label">Date Of Birth*</label>
                            <div class="col-md-7">
                                <input id="altdobDate" name="altdobDate" type="text" class="form-control" hidden>
                                <input name="dobDate" id="dobDate" type="text" class="form-control" readonly>
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

<!-- UPDATE -->
<div class="modal fade" id="dependentModal" tabindex="-1" role="dialog" aria-labelledby="updateContactLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateContactLabel">Edit Emergency Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST"  id="edit-dependent-form">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <input id="emp_con_id" name="emp_con_id" type="hidden">
                            <label class="col-md-5 col-form-label">Name*</label>
                            <div class="col-md-7">
                                <input id="name" name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-2 col-form-label">Relationship*</label>
                            <div class="col-md-10">
                                <input id="relationship" type="text" class="form-control{{ $errors->has('relationship') ? ' is-invalid' : '' }}"
                                    name="relationship" value="{{ old('relationship') }}" required>
                                @if ($errors->has('relationship'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('relationship') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-2 col-form-label">Date Of Birth*</label>
                            <div class="col-md-10">
                                <input id="dob" type="text" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}"
                                    name="dob" value="{{ old('dob') }}" required>
                                @if ($errors->has('dob'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('dob') }}</strong>
                                </span>
                                @endif
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

<div class="tab-pane fade show p-3" id="nav-dependent" role="tabpanel" aria-labelledby="nav-dependent-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#dependentPopup">
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
    $('#employee-dependents-table').DataTable({
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
                "data": "dob"
            },
            {
                data: "update_url",
                render: function (data, type, row, meta) {
                    return '<button type="button" class="open-update-dependent-modal btn btn-success btn-sm" data-toggle="modal" data-action="' + data + '" data-target="#dependentModal"><i class="far fa-edit"></i></button>' ;
                }
            }
        ]
    });

    $(function () {
        console.log("Calling function");
        $(document).on("click", ".open-update-dependent-modal", function () {
            console.log("Updating route: ", $(this).data('action'));
            $('#edit-dependent-form').attr("action", $(this).data('action'));
            $('#dependentModal').modal('show');
        });

        $('#my_modal').on('show.bs.modal', function(e) {

            //get data-id attribute of the clicked element
            var bookId = $(e.relatedTarget).data('book-id');

            //populate the textbox
            $(e.currentTarget).find('input[name="bookId"]').val(bookId);
        });
    });

</script>

@append