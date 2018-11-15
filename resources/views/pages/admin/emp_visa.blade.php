@extends('layouts.base')

@section('content')


<div class="col-xs-12">

<!-- Modal -->
<div class="modal fade" id="emergencyContactPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Visa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('admin.employees.visas.post', ['id' => $id]) }}">
                @csrf
                <div class="row">
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
                            <label class="col-md-2 col-form-label">Visa Number*</label>
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
                                <input name="issued_date" id="dobDate" type="text" class="form-control" readonly>
                            </div> 
                            <label class="col-md-5 col-form-label">Expiry Date*</label>
                            <div class="col-md-7">
                                <input name="expiry_date" id="licenseExpiryDate" type="text" class="form-control" readonly>
                            </div>                       
                    </div>
                </div>     
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </div>

            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



    <div class="table-responsive top-border-table">
        <table class="table">
            <thead>
                <th>No</th>
                @foreach($forms->visa as $label)
                <th>{{ ucwords(str_replace('_', ' ', $label)) }}</th>
                @endforeach
                <th>Action</th>
            </thead>
            <tbody>
                @if (count(@$info->visa))
                    @foreach ($info->visa as $key => $visa)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            @foreach($forms->visa as $label)
                            <td>{{ @$visa->$label }}</td>
                            @endforeach
                            <td><a href="{{ route('employee.visa.show', ['employee_id'=>$id, 'id'=>$visa->id]) }}" class="btn btn-primary btn-circle" data-lity><i class="fa fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="{{ count($forms->visa) }}"><em>@lang('app.no_records_found')</em></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>