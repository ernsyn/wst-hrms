{{-- TABLE ADDITION --}}
<div class="tab-pane fade" id="nav-addition" role="tabpanel" aria-labelledby="nav-addition-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCompanyAdditionPopup">
                Add Company Addition
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="float-right tableTools-container"></div>
            <table class="hrms-data-table compact w-100 t-2" id="additions-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($addition as $additions)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$additions['code']}}</td>
                        <td>{{$additions['name']}}</td>
                        <td>{{$additions['amount']}}</td>
                        <td><button type="button" class="btn btn-success btn-smt" data-toggle="modal"
                                data-addition-id="{{$additions['id']}}" data-addition-code="{{$additions['code']}}"
                                data-addition-name="{{$additions['name']}}" data-addition-type="{{$additions['type']}}"
                                data-addition-amount="{{$additions['amount']}}" data-addition-status="{{$additions['status']}}"
                                data-addition-confirmed_employee="{{$additions['confirmed_employee']}}" data-addition-statutory="{{$additions['statutory']}}"
                                data-addition-eaform="{{$additions['ea_form_id']}}" data-addition-cost_centre="{{$additions['cost_centre']}}"
                                data-addition-employee_grade="{{$additions['employee_grade']}}" data-target="#editCompanyAdditionPopup"><i class="fas fa-edit"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- ADD COMPANY ADDITION -->
<div class="modal fade" id="addCompanyAdditionPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Company Addition</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                @foreach($company as $company_addition)
                <form method="POST" action="{{ route('admin.settings.additions.add.post', ['id' => $company_addition->id])}} " id="add-company-addition-form">
                    @endforeach @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <label class="col-md-12 col-form-label">Code*</label>
                            <div class="col-md-12">
                                <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}"
                                    required>
                            </div>
                            <label class="col-md-12 col-form-label">Name*</label>
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                                    required>
                            </div>
                            <label class="col-md-12 col-form-label">Type*</label>
                            <div class="col-md-12">
                                <select class="form-control" name="type">
                                    <option value="fixed">Fixed</option>
                                    <option value="custom">Custom</option>
                                </select>
                            </div>
                            <label class="col-md-12 col-form-label">Amount</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="0" readonly required>
                            </div>
                            <label class="col-md-12 col-form-label">Status*</label>
                            <div class="col-md-12">
                                <select class="form-control" id="status" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <label class="col-md-12 col-form-label">Applies To (Employment Status)*</label>
                            <div class="col-md-12">
                                <select class="form-control" id="confirmed_employee" name="confirmed_employee">
                                    <option value="1">Confirmed Employee</option>
                                    <option value="0">Not Related</option>
                                </select>
                            </div>
                            <label class="col-md-12 col-form-label">Statutory</label>
                            <div class="checkbox col-md-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="inlineCheckbox1" name="statutory[]" value="PCB">
                                    <label class="form-check-label">PCB</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="inlineCheckbox2" name="statutory[]" value="EPF">
                                    <label class="form-check-label">EPF</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="inlineCheckbox3" name="statutory[]" value="SOCSO">
                                    <label class="form-check-label">SOCSO</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="inlineCheckbox4" name="statutory[]" value="EIS">
                                    <label class="form-check-label">EIS</label>
                                </div>
                            </div>
                            <label class="col-md-12 col-form-label">EA Form*</label>
                            <div class="col-md-12">
                                <select class="form-control{{ $errors->has('ea_form_id') ? ' is-invalid' : '' }}" name="ea_form_id" id="ea_form_id">
                                @foreach($ea_form as $item)
                                <option value="{{ $item->id }}">{{ $item->code }}: {{ $item->name }}</option>
                                @endforeach
                            </select>
                            </div>
                            <label class="col-md-12 col-form-label">Applies To</label>
                            <div class="checkbox col-md-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="check_cost_centre">
                                    <label class="form-check-label">Cost Centre</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="check_job_grade">
                                    <label class="form-check-label">Employee Grade</label>
                                </div>
                            </div>
                            <label class="col-md-12 col-form-label">Cost Centre</label>
                            <div class="col-md-12">
                                <select multiple class="tagsinput form-control{{ $errors->has('cost_centre') ? ' is-invalid' : '' }}" id="cost_centre" name="cost_centre[]"
                                    required disabled>
                                    @foreach(App\CostCentre::all() as $cost_centre)
                                    <option value="{{ $cost_centre->id }}">{{ $cost_centre->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('cost_centrs'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('cost_centre') }}</strong>
                                </span>
                                @endif

                            </div>
                            <label class="col-md-12 col-form-label">Employee Grade</label>
                            <div class="col-md-12">
                                <select multiple class="tagsinput form-control{{ $errors->has('employee_grade') ? ' is-invalid' : '' }}" id="job_grade" name="employee_grade[]"
                                    required disabled>
                                    @foreach(App\EmployeeGrade::all() as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('employee_grade'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('employee_grade') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- UPDATE COMPANY ADDITION -->
<div class="modal fade" id="editCompanyAdditionPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Company Addition</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    @foreach($company as $company_addition)
                    <form method="POST" action="{{ route('admin.settings.company-addition.edit.post', ['id' => $company_addition->id])}} " id="edit-company-addition-form">
                        @csrf
                        <div class="row pb-5">
                            <div class="col-xl-8">
                                <input name="company_addition_id" type="hidden">
                                <label class="col-md-12 col-form-label">Code*</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}"
                                        required>
                                </div>
                                <label class="col-md-12 col-form-label">Name*</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                                        required>
                                </div>
                                <label class="col-md-12 col-form-label">Type*</label>
                                <div class="col-md-12">
                                    <select class="form-control" name="type">
                                    <option value="fixed">Fixed</option>
                                    <option value="custom">Custom</option>
                                </select>
                                </div>
                                <label class="col-md-12 col-form-label">Amount</label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}" required>
                                </div>
                                <label class="col-md-12 col-form-label">Status*</label>
                                <div class="col-md-12">
                                    <select class="form-control" name="status" value="{{ old('status') }}">
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                </div>
                                <label class="col-md-12 col-form-label">Applies To (Employment Status)*</label>
                                <div class="col-md-12">
                                    <select class="form-control" name="confirmed_employee">
                                            <option value="1">Confirmed Employee</option>
                                            <option value="0">Not Related</option>
                                        </select>
                                </div>
                                <label class="col-md-12 col-form-label">Statutory</label>
                                <div class="checkbox col-md-12">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="updateAdditionPCB" name="statutory[]" value="PCB">
                                        <label class="form-check-label">PCB</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="updateAdditionEPF" name="statutory[]" value="EPF">
                                        <label class="form-check-label">EPF</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="updateAdditionSOCSO" name="statutory[]" value="SOCSO">
                                        <label class="form-check-label">SOCSO</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="updateAdditionEIS" name="statutory[]" value="EIS">
                                        <label class="form-check-label">EIS</label>
                                    </div>
                                </div>
                                <label class="col-md-12 col-form-label">EA Form*</label>
                                <div class="col-md-12">
                                    <select class="form-control{{ $errors->has('ea_form_id') ? ' is-invalid' : '' }}" name="ea_form_id" value="">
                                        @foreach($ea_form as $item)
                                        <option value="{{ $item->id }}">{{ $item->code }}: {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="col-md-12 col-form-label">Applies To</label>
                                <div class="checkbox col-md-12">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="check_cost_centre">
                                        <label class="form-check-label">Cost Centre</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="check_job_grade">
                                        <label class="form-check-label">Employee Grade</label>
                                    </div>
                                </div>
                                <label class="col-md-12 col-form-label">Cost Centre</label>
                                <div class="col-md-12">
                                    <select multiple class="tagsinput form-control{{ $errors->has('cost_centre') ? ' is-invalid' : '' }}" id="update_cost_centre"
                                        name="cost_centre[]" required disabled>
                                        @foreach(App\CostCentre::all() as $cost_centre)
                                        <option value="{{ $cost_centre->id }}">{{ $cost_centre->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('cost_centre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cost_centre') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label class="col-md-12 col-form-label">Employee Grade</label>
                                <div class="col-md-12">
                                    <select multiple class="tagsinput form-control{{ $errors->has('employee_grade') ? ' is-invalid' : '' }}" id="update_job_grade" name="employee_grade[]"
                                        required disabled>
                                        @foreach(App\EmployeeGrade::all() as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('employee_grade'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('employee_grade') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
    $('#additions-table').DataTable({
        responsive: true,
        stateSave: true,
        dom: `<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
        <'row'<'col-md-6'><'col-md-6'>>
        <'row'<'col-md-12't>><'row'<'col-md-12'ip>>`,
        buttons: [{
                extend: 'copy',
                text: '<i class="fas fa-copy "></i>',
                className: 'btn-segment',
                titleAttr: 'Copy'
            },
            {
                extend: 'colvis',
                text: '<i class="fas fa-search "></i>',
                className: 'btn-segment',
                titleAttr: 'Show/Hide Column'
            },
            {
                extend: 'csv',
                text: '<i class="fas fa-file-alt "></i>',
                className: 'btn-segment',
                titleAttr: 'Export CSV'
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print "></i>',
                className: 'btn-segment',
                titleAttr: 'Print'
            },
        ]
    });


    $(function(){
        var addCostCentre = $('#add-company-addition-form #cost_centre').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });
        var editCostCentre = $('#edit-company-addition-form #update_cost_centre').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });

    //update addition
        $('#editCompanyAdditionPopup').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('addition-id');
            var code = button.data('addition-code');
            var name = button.data('addition-name');
            var type = button.data('addition-type');
            var amount = button.data('addition-amount');
            var status = button.data('addition-status');
            var confirmed_employee = button.data('addition-confirmed_employee');
            var statutory = button.data('addition-statutory');
            var eaform = button.data('addition-eaform');
            var cost_centre = button.data('addition-cost_centre').split(',');
            var employee_grade = button.data('addition-employee_grade');

            console.log(cost_centre);

            $('#edit-company-addition-form input[name=company_addition_id]').val(id);
            $('#edit-company-addition-form input[name=code]').val(code);
            $('#edit-company-addition-form input[name=name]').val(name);
            $('#edit-company-addition-form select[name=type]').val(type);
            $('#edit-company-addition-form input[name=amount]').val(amount);
            if(type=="custom") $('#edit-company-addition-form input[name=amount]').attr('readonly',false);
            else  $('#edit-company-addition-form input[name=amount]').attr('readonly',true);

            $('#edit-company-addition-form select[name=status]').val(status);
            $('#edit-company-addition-form select[name=confirmed_employee]').val(confirmed_employee);

            if(statutory.includes('PCB')) $('#edit-company-addition-form #updateAdditionPCB').prop("checked", true);
            else $('#edit-company-addition-form #updateAdditionPCB').prop("checked", false);

            if(statutory.includes('EPF')) $('#edit-company-addition-form #updateAdditionEPF').prop("checked", true);
            else $('#edit-company-addition-form #updateAdditionEPF').prop("checked", false);

            if(statutory.includes('SOCSO')) $('#edit-company-addition-form #updateAdditionSOCSO').prop("checked", true);
            else $('#edit-company-addition-form #updateAdditionSOCSO').prop("checked", false);

            if(statutory.includes('EIS')) $('#edit-company-addition-form #updateAdditionEIS').prop("checked", true);
            else $('#edit-company-addition-form #updateAdditionEIS').prop("checked", false);

            $('#edit-company-addition-form select[name=ea_form_id]').val(eaform);

            if(cost_centre != '') {
                $('#edit-company-addition-form input[name=check_cost_centre]').prop("checked", true);
                editCostCentre[0].selectize.enable();
            } else {
                $('#edit-company-addition-form input[name=check_cost_centre]').prop("checked", false);
                editCostCentre[0].selectize.disable();
            }

            editCostCentre[0].selectize.setValue(cost_centre);
        });

        // add
        $('#add-company-addition-form select[name=type]').change(function() {
            if( $(this).val() == "custom") {
                $('#add-company-addition-form input[name=amount]').prop("readonly", false );
                $('#add-company-addition-form input[name=amount]').val("");
            } else {
                $('#add-company-addition-form input[name=amount]').prop("readonly", true );
                $('#add-company-addition-form input[name=amount]').val("0");
            }
        });

        $('#add-company-addition-form input[name=check_cost_centre]').change(function () {
            if ($('input[name=check_cost_centre]:checked').length) {
                addCostCentre[0].selectize.enable();
            } else {
                // $('#add-company-addition-form #cost_centre').prop('disabled', true);
                addCostCentre[0].selectize.disable();
            }
        });

        $('#add-company-addition-form input[name=check_job_grade]').change(function () {
            if ($('input[name=check_job_grade]:checked').length) {
                $('#job_grade').prop('disabled', false);
            } else {
                $('#job_grade').prop('disabled', true);
            }
        });

        // edit
        $('#edit-company-addition-form select[name=type]').change(function() {
            if( $(this).val() == "custom") {
                $('#edit-company-addition-form input[name=amount]').prop("readonly", false );
                $('#edit-company-addition-form input[name=amount]').val("");
            } else {
                $('#edit-company-addition-form input[name=amount]').prop("readonly", true );
                $('#edit-company-addition-form input[name=amount]').val("0");
            }
        });
        $('#edit-company-addition-form input[name=check_cost_centre]').change(function () {
            if ($('input[name=check_cost_centre]:checked').length) {
                editCostCentre[0].selectize.enable();
            } else {
                editCostCentre[0].selectize.disable();
            }
        });

        $('#edit-company-addition-form input[name=check_job_grade]').change(function () {
            if ($('input[name=check_job_grade]:checked').length) {
                $('#update_job_grade').prop('disabled', false);
            } else {
                $('#update_job_grade').prop('disabled', true);
            }
        });
    });
</script>
@append
