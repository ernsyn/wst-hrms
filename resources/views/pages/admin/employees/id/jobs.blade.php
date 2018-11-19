<div class="tab-pane fade show p-3" id="nav-job" role="tabpanel" aria-labelledby="nav-job-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal" data-target="#addJobPopup">
                        Add Job
                    </button>
            <button type="button" class="btn btn-outline-danger waves-effect" onclick="window.location='{{ url('admin/resign') }}';">
                        Resign
                    </button>
        </div>
    </div>
    <table class="table table-bordered table-hover w-100" id="employeeJobTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Position</th>
                <th>Department</th>
                <th>Team</th>
                <th>Cost Centre</th>
                <th>Grade</th>
                <th>Basic Salary</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>


<!-- ADD -->
<div class="modal fade" id="addJobPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Leave Balance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('add_job') }}">
                    @csrf
                    <div class="row form-group">
                        <label class="col-md-8 col-form-label">New Basic Salary*</label>
                        <div class="col-lg-8 col-md-7">
                            <input id="basic_salary" type="number" class="form-control{{ $errors->has('basic_salary') ? ' is-invalid' : '' }}" name="basic_salary"
                                value="{{ old('basic_salary') }}" min="0" step=".01" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-8 col-form-label">Cost Centre*</label>
                        <div class="col-lg-8 col-md-7">
                            <select class="form-control{{ $errors->has('cost_centre') ? ' is-invalid' : '' }}" name="cost_centre" id="cost_centre" required>
                                <option disabled selected>Please Select</option>
                                @foreach($cost_centre as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                              </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-8 col-form-label">Department*</label>
                        <div class="col-lg-8 col-md-7">
                            <select class="form-control{{ $errors->has('department') ? ' is-invalid' : '' }}" name="department" id="department" required>
                                <option disabled selected>Please Select</option>
                            @foreach($department as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-8 col-form-label">Team*</label>
                        <div class="col-lg-8 col-md-7">
                            <select class="form-control{{ $errors->has('team') ? ' is-invalid' : '' }}" name="team" id="team" required>
                                <option disabled selected>Please Select</option>
                            @foreach(App\Team::all() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-8 col-form-label">Position*</label>
                        <div class="col-lg-8 col-md-7">
                            <select class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" name="position" id="position" required>
                                <option disabled selected>Please Select</option>
                            @foreach($position as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-8 col-form-label">Grade*</label>
                        <div class="col-lg-8 col-md-7">
                            <select class="form-control{{ $errors->has('grade') ? ' is-invalid' : '' }}" name="grade" id="grade" required>
                                <option disabled selected>Please Select</option>
                            @foreach($grade as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-8 col-form-label">Branch*</label>
                        <div class="col-lg-8 col-md-7">
                            <select class="form-control{{ $errors->has('branch') ? ' is-invalid' : '' }}" name="branch" id="branch" required>
                                    <option disabled selected>Please Select</option>
                            @foreach($branch as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-12 col-form-label">Date*</label>
                        <div class="col-md-7">
                            <input id="jobDate" autocomplete="off" type="text" class="form-control" readonly>
                            <input name="jobDate" id="altjobDate" type="text" class="form-control" hidden>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-10 col-form-label">Employement Status</label>
                        <div class="col-md-7">
                            <select class="form-control" id="emp_status" name="emp_status" required>
                                <option disabled selected>Please Select</option>
                                <option value="Confirmation of Employement">Confirmation of Employement</option>
                                <option value="Confirmation of Promotion">Confirmation of Promotion</option>
                                <option value="Transferred">Transferred</option>
                                <option value="Probationer">Probationer</option>
                           </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-7 col-form-label">Remarks</label>
                        <div class="col-md-10">
                            <textarea id="remarks" type="text" class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}" name="remarks"
                                required>
                            </textarea>
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




@section('scripts')
<script>
    $('#employee-jobs-table').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "{{ route('admin.employees.dt.jobs', ['id' => $id]) }}",
    "columns": [{
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            "data": "start_date"
        },
        {
            "data": "end_date"
        },
        {
            "data": "basic_salary"
        },        
        {
            "data": null, // can be null or undefined
            "defaultContent": '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#jobModal"><i class="far fa-edit"></i></button>'
        }
    ]
});

</script>
@append