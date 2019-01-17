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
                    @foreach($additions as $additions)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$additions['code']}}</td>
                        <td>{{$additions['name']}}</td>
                        <td>{{$additions['amount']}}</td>
                        <td><button type="button" class="btn btn-success btn-smt" data-toggle="modal"
                                data-addition-id="{{$additions['id']}}" data-addition-code="{{$additions['code']}}"
                                data-addition-name="{{$additions['name']}}" data-addition-type="{{$additions['type']}}"
                                data-addition-amount="{{$additions['amount']}}" data-addition-confirmed_employee="{{$additions['confirmed_employee']}}"
                                data-addition-status="{{$additions['status']}}" data-target="#editCompanyAdditionPopup"><i class="fas fa-edit"></i></button>
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
                <form method="POST" action="{{ route('admin.settings.additions.add.post', ['id' => $company_addition->id])}} " id="add_company_addition">
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
                                <select class="form-control" id="type" name="type" onchange="myFunction(event)">
                                    <option value="Fixed">Fixed</option>
                                    <option value="Custom">Custom</option>
                                </select>
                            </div>
                            <label class="col-md-12 col-form-label">Amount</label>
                            <div class="col-md-12">
                                <input id="amount" type="text" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}"
                                    disabled="true">
                            </div>
                            <label class="col-md-12 col-form-label">Status*</label>
                            <div class="col-md-12">
                                <select class="form-control" id="status" name="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
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
                                    <input type="checkbox" class="form-check-input" id="check_cost_centre" name="applies[]">
                                    <label class="form-check-label">Cost Centre</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="check_job_grade" name="applies[]">
                                    <label class="form-check-label">Job Grade</label>
                                </div>
                            </div>
                            <label class="col-md-12 col-form-label">Cost Centre</label>
                            <div class="col-md-12">
                                <select multiple class="tagsinput form-control{{ $errors->has('cost_centres') ? ' is-invalid' : '' }}" id="cost_centre" name="cost_centres"
                                    required disabled>
                                    @foreach(App\CostCentre::all() as $cost_centre)
                                    <option value="{{ $cost_centre->id }}">{{ $cost_centre->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('cost_centres'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('cost_centres') }}</strong>
                                </span>
                                @endif

                            </div>
                            <label class="col-md-12 col-form-label">Job Grade</label>
                            <div class="col-md-12">
                                <select multiple class="tagsinput form-control{{ $errors->has('job_grade') ? ' is-invalid' : '' }}" id="job_grade" name="job_grade[]"
                                    required disabled>
                                    @foreach(App\EmployeeGrade::all() as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
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
                    <form method="POST" action="{{ route('admin.settings.company-addition.edit.post', ['id' => $company_addition->id])}} " id="add_company_addition">
                        @endforeach @csrf
                        <div class="row pb-5">
                            <div class="col-xl-8">
                                <input id="company_addition_id" name="company_addition_id" type="hidden">
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
                                    <select class="form-control" id="type" name="type">
                                    <option value="Fixed">Fixed</option>
                                    <option value="Custom">Custom</option>
                                </select>
                                </div>
                                <label class="col-md-12 col-form-label">Amount</label>
                                <div class="col-md-12">
                                    <input id="amount" type="number" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}"
                                        disabled="true">
                                </div>
                                <label class="col-md-12 col-form-label">Status*</label>
                                <div class="col-md-12">
                                    <select class="form-control" id="status" name="status" value="{{ old('status') }}">
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
                                        <input type="checkbox" class="form-check-input" id="statutory[]" name="statutory[]" value="PCB" {!! strpos($additions,'PCB') !== false ? 'checked':'' !!}>
                                        <label class="form-check-label">PCB</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="statutory[]" name="statutory[]" value="EPF" {!! strpos($additions,'EPF') !== false ? 'checked':'' !!}>
                                        <label class="form-check-label">EPF</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="statutory[]" name="statutory[]" value="SOCSO" {!! strpos($additions,'SOCSO') !== false ? 'checked':'' !!}>
                                        <label class="form-check-label">SOCSO</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="statutory[]" name="statutory[]" value="EIS" {!! strpos($additions,'EIS') !== false ? 'checked':'' !!}>
                                        <label class="form-check-label">EIS</label>
                                    </div>
                                </div>
                                <label class="col-md-12 col-form-label">EA Form*</label>
                                <div class="col-md-12">
                                    <select class="form-control{{ $errors->has('ea_form_id') ? ' is-invalid' : '' }}" name="ea_form_id" id="ea_form_id" value="{{ old('ea_form_id') }}">
                                        @foreach($ea_form as $item)
                                        <option value="{{ $item->id }}">{{ $item->code }}: {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="col-md-12 col-form-label">Applies To</label>
                                <div class="checkbox col-md-12">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="check_cost_centre_a" name="applies[]">
                                        <label class="form-check-label">Cost Centre</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="check_job_grade_a" name="applies[]">
                                        <label class="form-check-label">Job Grade</label>
                                    </div>
                                </div>
                                <label class="col-md-12 col-form-label">Cost Centre</label>
                                <div class="col-md-12">
                                    <select multiple class="tagsinput form-control{{ $errors->has('cost_centres') ? ' is-invalid' : '' }}" id="cost_centre_a"
                                        name="cost_centres" required disabled>
                                        @foreach(App\CostCentre::all() as $cost_centre)
                                        <option value="{{ $cost_centre->id }}">{{ $cost_centre->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('cost_centres'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cost_centres') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label class="col-md-12 col-form-label">Job Grade</label>
                                <div class="col-md-12">
                                    <select multiple class="tagsinput form-control{{ $errors->has('job_grade') ? ' is-invalid' : '' }}" id="job_grade_a" name="job_grade[]"
                                        required disabled>
                                        @foreach(App\EmployeeGrade::all() as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
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
</script>
@append
