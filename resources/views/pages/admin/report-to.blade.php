<!-- ADD -->
<div class="modal fade" id="addDependentPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                {{-- <select class="form-control{{ $errors->has('employees') ? ' is-invalid' : '' }}" name="employees" id="employees">
                                      @foreach($employees as $item)
                                      <option value="{{ $item->emp_id }}">{{ $item->name }}</option>
                                      @endforeach
                                    </select> @if ($errors->has('employees'))
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('employees') }}</strong>
                                </span> @endif --}}
                            </div>
                            <label class="col-md-2 col-form-label">Type*</label>
                            <div class="col-md-10">
                                <select class="form-control" id="type" name="type">
                                    <option value="Direct">Direct</option>
                                    <option value="Indirect">Indirect</option>
                                </select>
                            </div>
                            <label class="col-md-5 col-form-label">KPI Proposer*</label>
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
</div>
<div class="tab-pane fade show p-3" id="nav-reportto" role="tabpanel" aria-labelledby="nav-reportto-tab">
    <table class="table table-bordered table-hover" id="employeeReporttoTable">
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
        {{--
        <tbody>
            @foreach($reports as $row)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$row['name']}}</td>
                <td>{{$row['type']}}</td>
                <td>{{$row['note']}}</td>
                @if($row['kpi_proposer']==1)
                <td><i class="fas fa-check"></i></td>
                @else
                <td><i class="fas fa-times"></i></td>
                @endif
            </tr>
            @endforeach
        </tbody> --}}
    </table>
</div>