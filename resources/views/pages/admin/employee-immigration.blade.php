<!-- ADD -->
<div class="modal fade" id="employeeImmiPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Immigration</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('add_employee_immigration') }}" id="add_employee_immigration">
                @csrf
                <div class="row pb-5">
                    <div class="col-xl-8"> 
                            <label class="col-md-8 col-form-label">Passport No*</label>
                            <div class="col-md-10">
                                <input id="passport_no" type="text" class="form-control{{ $errors->has('passport_no') ? ' is-invalid' : '' }}" 
                                onkeyup="this.value = this.value.toUpperCase();" name="passport_no" value="{{ old('passport_no') }}" required>
                                @if ($errors->has('passport_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('passport_no') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-5 col-form-label">Expiry Date*</label>
                            <div class="col-md-7">
                                <input id="altexpiryDate" name ="altexpiryDate" type="text" class="form-control" hidden> 
                                <input name="expiryDate" id="expiryDate" type="text" class="form-control" readonly>                                              
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
                                <input id="altlicenseExpiryDate" name ="altlicenseExpiryDate" type="text" class="form-control" hidden> 
                                <input name="licenseExpiryDate" id="licenseExpiryDate" type="text" class="form-control" readonly>                                              
                            </div>
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

 <!-- UPDATE -->
 <div class="modal fade" id="updateImmigrationPopup" tabindex="-1" role="dialog" aria-labelledby="updateImmigrationLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateContactLabel">Edit Immigration</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('edit_immigration') }}" id="edit_immigration">
                @csrf
                <div class="row pb-5">
                    <div class="col-xl-8">
                        <input id="img_id" name="img_id" type="hidden">
                            <label class="col-md-7 col-form-label">Passport No*</label>
                            <div class="col-md-10">
                                <input id="passport_no" type="text" class="form-control{{ $errors->has('passport_no') ? ' is-invalid' : '' }}"
                                onkeyup="this.value = this.value.toUpperCase();" name="passport_no" value="{{ old('passport_no') }}" required>
                                @if ($errors->has('passport_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('passport_no') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-5 col-form-label">Expiry Date*</label>
                            <div class="col-md-7">
                                <input id="altexpiryDate2" name ="altexpiryDate" type="text" class="form-control" hidden> 
                                <input name="expiryDate" id="expiryDate2" type="text" class="form-control" readonly>                                              
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
                                <input id="altlicenseExpiryDate2" name ="altlicenseExpiryDate" type="text" class="form-control" hidden> 
                                <input name="licenseExpiryDate" id="licenseExpiryDate2" type="text" class="form-control" readonly>                                              
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

<div class="tab-pane fade show p-3" id="nav-immigration" role="tabpanel" aria-labelledby="nav-immigration-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal" data-target="#employeeImmiPopup">
                Add Immigration
            </button>
        </div>
    </div>
    <table class="table table-bordered table-hover w-100" id="employeeImmigrationTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Passport No</th>
                <th>Issued By</th>
                <th>Issued Date</th>
                <th>Expiry Date</th>
                <th>Document</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
