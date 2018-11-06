@extends('layouts.app')

@section('content')

<!-- ADD -->
<div class="modal fade" id="addImmigrationPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Immigration</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('add_employee_immigration') }}">
                @csrf
                <div class="row pb-5">
                    <div class="col-xl-8">
                        <label class="col-md-5 col-form-label">Document*</label>
                        <div class="col-md-7">
                            <input id="document" type="text" class="form-control{{ $errors->has('document') ? ' is-invalid' : '' }}" placeholder="document here" name="document" value="{{ old('document') }}" required>
                            @if ($errors->has('document'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('document') }}</strong>
                            </span>
                            @endif
                        </div>    
                            <label class="col-md-2 col-form-label">Passport No*</label>
                            <div class="col-md-10">
                                <input id="passport_no" type="text" class="form-control{{ $errors->has('passport_no') ? ' is-invalid' : '' }}" placeholder="Farther, Son, etc" name="passport_no" value="{{ old('passport_no') }}" required>
                                @if ($errors->has('passport_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('passport_no') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-2 col-form-label">Issued By*</label>
                            <div class="col-md-10">
                                <input id="issued_by" type="text" class="form-control{{ $errors->has('issued_by') ? ' is-invalid' : '' }}" placeholder="Farther, Son, etc" name="issued_by" value="{{ old('issued_by') }}" required>
                                @if ($errors->has('issued_by'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('issued_by') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-5 col-form-label">Issued Date*</label>
                            <div class="col-md-7">
                                <input autocomplete="off" id="dobDate" type="text" class="form-control">
                                <input name="issued_date" id="altdobDate" type="text" class="form-control" hidden>                                
                            </div> 
                            <label class="col-md-5 col-form-label">Expiry Date*</label>
                            <div class="col-md-7">
                                <input id="licenseExpiryDate" autocomplete="off" type="text" class="form-control">
                                <input name="expiry_date" id="altlicenseExpiryDate" type="text" class="form-control" hidden>                                
                                
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
                            <label class="col-md-5 col-form-label">Document*</label>
                            <div class="col-md-7">
                                <input id="document" name="document" type="text" class="form-control{{ $errors->has('document') ? ' is-invalid' : '' }}" value="{{ old('document') }}" required>
                                @if ($errors->has('document'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('document') }}</strong>
                                </span>
                                @endif
                            </div>    
                                <label class="col-md-2 col-form-label">Passport No*</label>
                                <div class="col-md-10">
                                    <input id="passport_no" type="text" class="form-control{{ $errors->has('passport_no') ? ' is-invalid' : '' }}" name="passport_no" value="{{ old('passport_no') }}" required>
                                    @if ($errors->has('passport_no'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('passport_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label class="col-md-2 col-form-label">Issued By*</label>
                                <div class="col-md-10">
                                    <input id="issued_by" type="text" class="form-control{{ $errors->has('issued_by') ? ' is-invalid' : '' }}" name="issued_by" value="{{ old('issued_by') }}" required>
                                    @if ($errors->has('issued_by'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('issued_by') }}</strong>
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

<div class="p-4">
        <div class="card py-4">
            <div class="card-body">
                    <div class="row pb-3">
                            <div class="col-auto mr-auto"></div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#addImmigrationPopup">
                                    Add Immigration
                                </button>
                            </div>
                        </div>
                    <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover">
                                  <tr>
                                      <th>No</th>
                                      <th>Document</th>
                                      <th>Passport No</th>
                                      <th>Issued By</th>
                                      <th>Issued Date</th>
                                      <th>Expiry Date</th>                
                                      <th>Action</th>
                                  </tr>
                          
                                  @foreach($immigrations as $row)
                                  <tr>
                                      <td>{{$loop->iteration}}</td>                
                                      <td>{{$row['document']}}</td>
                                      <td>{{$row['passport_no']}}</td>
                                      <td>{{$row['issued_by']}}</td>
                                      <td>{{$row['issued_date']}}</td>
                                      <td>{{$row['expiry_date']}}</td>                
                                      <td><button class="btn btn-outline-primary waves-effect" data-toggle="modal"
                                          data-immigration-id="{{$row['id']}}"
                                          data-immigration-document="{{$row['document']}}"                
                                          data-immigration-passport-no="{{$row['passport_no']}}"
                                          data-immigration-issued-by="{{$row['issued_by']}}"
                                          data-immigration-issued-date="{{$row['issued_date']}}"
                                          data-immigration-expiry-date="{{$row['expiry_date']}}"
                                          data-target="#updateImmigrationPopup">EDIT</button></td>
                                  </tr>
                                  @endforeach
                                </table>
                            </div>
                        </div>
            </div>
        </div>
</div>




@endsection