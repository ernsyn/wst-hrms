@extends('layouts.app')

@section('content')
    
    <!-- Modal -->
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
                                <label class="col-md-5 col-form-label">Visa Number*</label>
                                <div class="col-md-10">
                                    <input id="visa_number" type="text" class="form-control{{ $errors->has('visa_number') ? ' is-invalid' : '' }}" placeholder="Farther, Son, etc" name="visa_number" value="{{ old('visa_number') }}" required>
                                    @if ($errors->has('visa_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('visa_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label class="col-md-2 col-form-label">Relation*</label>
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
                                    <input id="dobDate" autocomplete="off" type="text" class="form-control">
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
<div class="modal fade" id="updateVisaPopup" tabindex="-1" role="dialog" aria-labelledby="updateVisaLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="updateVisaLabel">Edit Visa</h5>
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
                                    <input id="type" name="type" type="text" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" value="{{ old('type') }}" required>
                                    @if ($errors->has('type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>    
                                    <label class="col-md-2 col-form-label">Visa Number*</label>
                                    <div class="col-md-10">
                                        <input id="visa_number" type="text" class="form-control{{ $errors->has('visa_number') ? ' is-invalid' : '' }}" name="visa_number" value="{{ old('visa_number') }}" required>
                                        @if ($errors->has('visa_number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('visa_number') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <label class="col-md-2 col-form-label">Relation*</label>
                                    <div class="col-md-10">
                                        <input id="family_members" type="text" class="form-control{{ $errors->has('family_members') ? ' is-invalid' : '' }}" name="family_members" value="{{ old('family_members') }}" required>
                                        @if ($errors->has('family_members'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('family_members') }}</strong>
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
                                <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#addVisaPopup">
                                    Add Visa
                                </button>
                            </div>
                        </div>
                    <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <th>No</th>
                                        <th>Visa No</th>
                                        <th>Relation</th>
                                        <th>Issued Date</th>
                                        <th>Expiry Date</th>                
                                        <th>Action</th>
                                    </tr>
                        
                                    @foreach($visa as $row)
                                    <tr>
                                        <td>{{$loop->iteration}}</td> 
                                        <td>{{$row['visa_number']}}</td>
                                        <td>{{$row['family_members']}}</td>
                                        <td>{{$row['issued_date']}}</td>
                                        <td>{{$row['expiry_date']}}</td>                
                                        <td><button class="btn btn-outline-primary waves-effect" data-toggle="modal"
                                            data-visa-id="{{$row['id']}}"
                                            data-visa-type="{{$row['type']}}"        
                                            data-visa-number="{{$row['visa_number']}}"             
                                            data-visa-family-members="{{$row['family_members']}}"
                                            data-visa-issued-date="{{$row['issued_date']}}"
                                            data-visa-expiry-date="{{$row['expiry_date']}}"
                                            data-target="#updateVisaPopup">EDIT</button></td>
                                    </tr>
                                    @endforeach
                        
                                </table>
                            </div>
                    </div>
            </div>
        </div>
</div>




@endsection