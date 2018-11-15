<!-- ADD -->
<div class="modal fade" id="addBankPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Bank Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('add_employee_bank') }}" id="add_emergency_contact">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <label class="col-md-8 col-form-label">Bank*</label>
                            <div class="col-md-7">
                                <select class="form-control{{ $errors->has('bank_list') ? ' is-invalid' : '' }}" name="bank_list" id="bank_list">
                                    @foreach($bank_list as $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                    @endforeach
                                  </select>                                
                                  @if ($errors->has('bank_list'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('bank_list') }}</strong>
                                      </span>
                                  @endif
                            </div>    
                                <label class="col-md-7 col-form-label">Account Number*</label>
                                <div class="col-md-10">
                                    <input id="acc_no" type="text" class="form-control{{ $errors->has('acc_no') ? ' is-invalid' : '' }}" placeholder="" name="acc_no" value="{{ old('acc_no') }}" required>
                                    @if ($errors->has('acc_no'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('acc_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label class="col-md-5 col-form-label">Status*</label>
                                <div class="col-md-7">
                                    <select class ="form-control" id="status" name="status">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                   </select>
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
<div class="modal fade" id="updateBankPopup" tabindex="-1" role="dialog" aria-labelledby="updateBankLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateBankLabel">Edit Bank</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('edit_bank') }}" id="edit_visa">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <input id="bank_id" name="bank_id" type="hidden">                       
                            <label class="col-md-5 col-form-label">Bank*</label>
                            <div class="col-md-7">
                                    <select class="form-control{{ $errors->has('bank_list') ? ' is-invalid' : '' }}" name="bank_code" id="bank_code">
                                        @foreach($bank_list as $item)
                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>  
                            </div>    
                                <label class="col-md-7 col-form-label">Account Number*</label>
                                <div class="col-md-10">
                                    <input id="acc_no" type="text" class="form-control{{ $errors->has('acc_no') ? ' is-invalid' : '' }}" name="acc_no" value="{{ old('acc_no') }}" required>
                                    @if ($errors->has('acc_no'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('acc_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label class="col-md-5 col-form-label">Status*</label>
                            <div class="col-md-7">
                                <select class ="form-control" id="acc_status" name="acc_status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                               </select>
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


<div class="tab-pane fade show p-3" id="nav-bank" role="tabpanel" aria-labelledby="nav-bank-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal" data-target="#addBankPopup">
                Add Bank
            </button>
        </div>
    </div>
    <table class="table table-bordered table-hover w-100" id="employeeBankTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Bank</th>
                <th>Account Number</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
