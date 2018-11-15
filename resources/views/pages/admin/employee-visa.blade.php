<!-- ADD -->
<div class="modal fade" id="addVisaPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Visa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('add_employee_visa') }}">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <label class="col-md-5 col-form-label">Type*</label>
                            <div class="col-md-7">
                                <input id="type" type="text" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" placeholder="type here" name="type" value="{{ old('type') }}" required>
                                @if ($errors->has('type'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                                @endif
                            </div>    
                                <label class="col-md-8 col-form-label">Visa Number*</label>
                                <div class="col-md-10">
                                    <input id="visa_number" type="text" class="form-control{{ $errors->has('visa_number') ? ' is-invalid' : '' }}" placeholder="WG675FE" name="visa_number" value="{{ old('visa_number') }}" required>
                                    @if ($errors->has('visa_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('visa_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label class="col-md-7 col-form-label">Relation*</label>
                                <div class="col-md-10">
                                    <input id="family_members" type="text" class="form-control{{ $errors->has('family_members') ? ' is-invalid' : '' }}" placeholder="Farther, Son, etc" name="family_members" value="{{ old('family_members') }}" required>
                                    @if ($errors->has('family_members'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family_members') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label class="col-md-5 col-form-label">Issued Date*</label>
                                <div class="col-md-7">
                                    <input id="visaissueDate" autocomplete="off" type="text" class="form-control" readonly>
                                    <input name="issued_date" id="altvisaissueDate" type="text" class="form-control" hidden>   
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
                                <label class="col-md-5 col-form-label">Expiry Date*</label>
                                <div class="col-md-7">
                                    <input id="visaexpDate" autocomplete="off" type="text" class="form-control" readonly>
                                    <input name="expiry_date" id="altvisaexpDate" type="text" class="form-control" hidden>          
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
                            <input id="visa_id" name="visa_id" type="text" hidden>   
                            <label class="col-md-5 col-form-label">Type*</label>
                            <div class="col-md-7">
                                <input id="type" type="text" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" placeholder="type here" name="type" value="{{ old('type') }}" required>
                                @if ($errors->has('type'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                                @endif
                            </div>    
                                <label class="col-md-8 col-form-label">Visa Number*</label>
                                <div class="col-md-10">
                                    <input id="visa_number" type="text" class="form-control{{ $errors->has('visa_number') ? ' is-invalid' : '' }}" placeholder="WG675FE" name="visa_number" value="{{ old('visa_number') }}" required>
                                    @if ($errors->has('visa_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('visa_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label class="col-md-7 col-form-label">Relation*</label>
                                <div class="col-md-10">
                                    <input id="family_members" type="text" class="form-control{{ $errors->has('family_members') ? ' is-invalid' : '' }}" placeholder="Farther, Son, etc" name="family_members" value="{{ old('family_members') }}" required>
                                    @if ($errors->has('family_members'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family_members') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label class="col-md-5 col-form-label">Issued Date*</label>
                                <div class="col-md-7">
                                    <input id="visaUpissueDate" autocomplete="off" type="text" class="form-control" readonly>
                                    <input name="issued_date" id="altvisaUpissueDate" type="text" class="form-control" hidden>   
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
                                <label class="col-md-5 col-form-label">Expiry Date*</label>
                                <div class="col-md-7">
                                    <input id="visaUpexpDate" autocomplete="off" type="text" class="form-control" readonly>
                                    <input name="expiry_date" id="altvisaUpexpDate" type="text" class="form-control" hidden>          
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
                <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal" data-target="#addVisaPopup">
                    Add Visa
                </button>
            </div>
        </div>
<table class="table table-bordered table-hover w-100" id="employeeVisaTable">
    <thead>
        <tr>
                <th>No</th>
                <th>Type</th>
                <th>Visa No</th>
                <th>Relation</th>
                <th>Issued Date</th>
                <th>Expiry Date</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
