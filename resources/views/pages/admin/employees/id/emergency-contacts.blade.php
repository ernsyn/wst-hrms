<!-- ADD -->
<div class="modal fade" id="add-emergency-contact-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Emergency Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.employees.emergency-contacts.post', ['id' => $id]) }}" id="add_emergency_contact">
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
                                    placeholder="Father, Son, etc" name="relationship" value="{{ old('relationship') }}"
                                    required>
                                @if ($errors->has('relationship'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('relationship') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-5 col-form-label">Contact Number*</label>
                            <div class="col-md-7">
                                <input id="contact_number" type="text" class="form-control{{ $errors->has('contact_number') ? ' is-invalid' : '' }}"
                                    placeholder="+60123456789" name="contact_number" value="{{ old('contact_number') }}"
                                    required>
                                @if ($errors->has('contact_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('contact_number') }}</strong>
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

<!-- UPDATE -->
<div class="modal fade" id="updateContactPopup" tabindex="-1" role="dialog" aria-labelledby="updateContactLabel"
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
                <form method="POST" action="{{ route('admin.employees.emergency-contacts.edit', ['emp_id' => $id, 'id' => 1]) }}" id="edit_emergency_contact">
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
                            <label class="col-md-2 col-form-label">Contact Number*</label>
                            <div class="col-md-10">
                                <input id="contact_number" type="text" class="form-control{{ $errors->has('contact_number') ? ' is-invalid' : '' }}"
                                    name="contact_number" value="{{ old('contact_number') }}" required>
                                @if ($errors->has('contact_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('contact_number') }}</strong>
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

<div class="tab-pane fade show p-3" id="nav-emergency" role="tabpanel" aria-labelledby="nav-emergency-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#add-emergency-contact-popup">
                Add Contact
            </button>
        </div>
    </div>
    <table class="table table-bordered table-hover w-100" id="emergency-contacts-table">
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
$('#emergency-contacts-table').DataTable({
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
            "defaultContent": '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#emergencyModal"><i class="far fa-edit"></i></button>'
        }
    ]
});
</script>
@append
