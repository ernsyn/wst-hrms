<!-- ADD -->
<div class="modal fade" id="emergencyContactPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Emergency Contact</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('add_emergency_contact') }}" id="add_emergency_contact">
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
                            <label class="col-md-5 col-form-label">Contact Number*</label>
                            <div class="col-md-7">
                                <input id="contact_number" type="text" class="form-control{{ $errors->has('contact_number') ? ' is-invalid' : '' }}" placeholder="+60123456789" name="contact_number" value="{{ old('contact_number') }}" required>
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

 <!-- UPDATE -->
<div class="modal fade" id="updateContactPopup" tabindex="-1" role="dialog" aria-labelledby="updateContactLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateContactLabel">Edit Emergency Contact</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('edit_emergency_contact') }}" id="edit_emergency_contact">
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

{{-- <div class="p-4">
    <div class="card py-4">
        <div class="card-body">
                <div class="row pb-3">
                        <div class="col-auto mr-auto"></div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#emergencyContactPopup">
                                Add Contact
                            </button>
                        </div>
                    </div>
                <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Relationship</th>
                                    <th>Contact Number</th>
                                    <th>Action</th>
                                </tr>
                    
                                @foreach($contacts as $row)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$row['contact_name']}}</td>
                                    <td>{{$row['relationship']}}</td>
                                    <td>{{$row['contact_number']}}</td>
                                    <td>
                                        <button class="btn btn-outline-primary waves-effect" data-toggle="modal"
                                        data-contact-id="{{$row['id']}}"
                                        data-contact-name="{{$row['contact_name']}}"                
                                        data-contact-relationship="{{$row['relationship']}}"
                                        data-contact-number="{{$row['contact_number']}}"
                                        data-target="#updateContactPopup">EDIT
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                </div>
        </div>
    </div>
</div>
             --}}



<div class="tab-pane fade show p-3" id="nav-emergency" role="tabpanel" aria-labelledby="nav-emergency-tab">
        <div class="row pb-3">
                <div class="col-auto mr-auto"></div>
                <div class="col-auto">
                    <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#emergencyContactPopup">
                        Add Contact
                    </button>
                </div>
            </div>
    <table class="table table-bordered table-hover w-100" id="emergencyContactTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Relationship</th>
                <th>Contact Number</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>