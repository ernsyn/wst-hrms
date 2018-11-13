<!-- ADD -->
<div class="modal fade" id="employeeVisaPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Visa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('add_employee_visa') }}" id="add_employee_visa">
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
                            <label class="col-md-8 col-form-label">Passport No*</label>
                            <div class="col-md-10">
                                <input id="passport_no" type="text" class="form-control{{ $errors->has('passport_no') ? ' is-invalid' : '' }}"  name="passport_no" value="{{ old('passport_no') }}" required>
                                @if ($errors->has('passport_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('passport_no') }}</strong>
                                </span>
                                @endif
                            </div>

                            <label class="col-md-5 col-form-label">Expiry Date*</label>
                            <div class="col-md-7">
                                <input id="altdobDate" name ="altdobDate" type="text" class="form-control" hidden> 
                                <input name="dobDate" id="dobDate" type="text" class="form-control" readonly>                                            
                            </div>
                    
                            <label class="col-md-5 col-form-label">Issued By*</label>
                            <div class="col-md-7">
                                <input id="issued_by" type="text" class="form-control{{ $errors->has('issued_by') ? ' is-invalid' : '' }}" name="issued_by" value="{{ old('issued_by') }}" required>
                                @if ($errors->has('issued_by'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('issued_by') }}</strong>
                                </span>
                                @endif
                            </div> 
                            <label class="col-md-5 col-form-label">Issued Date*</label>
                            <div class="col-md-7">
                                <input id="licenseExpiryDate" type="text" class="form-control" readonly>           
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
<div class="modal fade" id="updateVisaPopup" tabindex="-1" role="dialog" aria-labelledby="updateVisaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateVisaLabel">Edit Emergency Contact</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('edit_visa') }}" id="edit_visa">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <input id="emp_con_id" name="emp_con_id" type="hidden">                       
                            <label class="col-md-5 col-form-label">Name*</label>
                            <div class="col-md-7">
                                <input id="name" name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>    
                                <label class="col-md-2 col-form-label">Relationship*</label>
                                <div class="col-md-10">
                                    <input id="relationship" type="text" class="form-control{{ $errors->has('relationship') ? ' is-invalid' : '' }}" name="relationship" value="{{ old('relationship') }}" required>
                                    @if ($errors->has('relationship'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('relationship') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label class="col-md-2 col-form-label">Contact Number*</label>
                                <div class="col-md-10">
                                    <input id="contact_number" type="text" class="form-control{{ $errors->has('contact_number') ? ' is-invalid' : '' }}" name="contact_number" value="{{ old('contact_number') }}" required>
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

<div class="tab-pane fade show p-3" id="nav-visa" role="tabpanel" aria-labelledby="nav-visa-tab">
    <div class="row pb-3">
            <div class="col-auto mr-auto"></div>
            <div class="col-auto">
                <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#employeeVisaPopup">
                    Add Visa
                </button>
            </div>
        </div>
<table class="table table-bordered table-hover w-100" id="employeeVisaTable">
    <thead>
        <tr>
                <th>No</th>
                <th>Document</th>
                <th>Passport No</th>
                <th>Issued By</th>
                <th>Issued Date</th>
                <th>Expiry Date</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
