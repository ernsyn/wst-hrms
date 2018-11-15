<!-- ADD -->
<div class="modal fade" id="dependentPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add New Dependent</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('add_employee_dependent') }}" id="add_employee_dependent">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <label class="col-md-5 col-form-label">Name*</label>
                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name here" name="name" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>    
                                <label class="col-md-8 col-form-label">Relationship*</label>
                                <div class="col-md-10">
                                    <input id="relationship" type="text" class="form-control{{ $errors->has('relationship') ? ' is-invalid' : '' }}" placeholder="Farther, Son, etc" name="relationship" value="{{ old('relationship') }}" required>
                                    @if ($errors->has('relationship'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('relationship') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label class="col-md-7 col-form-label">Date Of Birth*</label>
                                <div class="col-md-7">
                                    <input id="altdobDate" name ="altdobDate" type="text" class="form-control" hidden> 
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
    <div class="modal fade" id="updateDependentPopup" tabindex="-1" role="dialog" aria-labelledby="updateDependentLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="updateDependentLabel">Edit Dependent</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('edit_employee_dependent') }}" id="edit_emergency_contact">
                        @csrf
                        <div class="row pb-5">
                            <div class="col-xl-8">
                                <input id="emp_dep_id" name="emp_dep_id" type="hidden">                       
                                <label class="col-md-5 col-form-label">Name*</label>
                                <div class="col-md-7">
                                    <input id="name" name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required>
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>    
                                    <label class="col-md-7 col-form-label">Relationship*</label>
                                    <div class="col-md-10">
                                        <input id="relationship" type="text" class="form-control{{ $errors->has('relationship') ? ' is-invalid' : '' }}" name="relationship" value="{{ old('relationship') }}" required>
                                        @if ($errors->has('relationship'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('relationship') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <label class="col-md-7 col-form-label">Date Of Birth*</label>
                                    <div class="col-md-10">
                                        <input id="altupdobDate" name ="altdobDate" type="text" class="form-control" hidden> 
                                        <input name="dobDate" id="updatedobDate" type="text" class="form-control" readonly>   
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
                        <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal" data-target="#dependentPopup">
                            Add Dependent
                        </button>
                    </div>
                </div>
        <table class="table table-bordered table-hover w-100" id="dependentTable">
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