@extends('layouts.admin-base') 
@section('content')

@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
<div class="container">
    <div class="card">
        <form method="POST" action="{{ route('admin.e-leave.configuration.leavetypes.add.post') }}" id="form_validate" data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="row p-3">
                        <div class="form-group row w-100">
                            <label class="col-md-5 col-form-label">Name*</label>
                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder=""
                                    name="name" value="{{ old('name') }}" required>
                            </div>                            
                        </div>
                    
                        <div class="form-group row w-100">
                            <label class="col-md-5 col-form-label">Code*</label>
                            <div class="col-md-7">
                                <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder=""
                                    name="code" value="{{ old('code') }}" required>
                            </div>                            
                        </div>
                        <div class="form-group row w-100">
                            <label class="col-md-5 col-form-label">Apply Before*</label>
                            <div class="col-md-7">
                                <input id="apply_before_days" type="text" class="form-control{{ $errors->has('apply_before_days') ? ' is-invalid' : '' }}" placeholder=""
                                    name="apply_before_days" value="{{ old('apply_before_days') }}" required>
                            </div>                            
                        </div>
                        <div class="form-group row w-100">
                            <label class="col-md-5 col-form-label">Increment Per Year (in days) *</label>
                            <div class="col-md-7">
                                <input id="increment_per_year" type="text" class="form-control{{ $errors->has('increment_per_year') ? ' is-invalid' : '' }}" placeholder=""
                                    name="increment_per_year" value="{{ old('increment_per_year') }}" required>
                            </div>                            
                        </div>
                                <div class="form-group row w-100">
                                        <label class="col-md-5 col-form-label">Approval Level*</label>
                                    
                                        <div class="col-md-7">
                                            <select class="form-control" id="approval_level" name="approval_level">
                                                <option selected disabled>Approval Level</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                            @if ($errors->has('approval_level'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('approval_level') }}</strong>
                                            </span> 
                                            @endif                       
                                    </div>
                                </div>
                                <div class="form-group row w-100">
                                    <label class="col-md-5 col-form-label">Carry Forward*</label> 
                                    <div class="col-md-7">
                                        <select class="form-control" id="carry_forward" name="carry_forward">
                                            <option selected disabled>Carry Forward</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select>
                                        @if ($errors->has('carry_forward'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('carry_forward') }}</strong>
                                        </span> 
                                        @endif
                                    </div>                          
                                </div>
                                <div class="form-group row w-100">
                                    <label class="col-md-5 col-form-label">Allow Carry Forward (Days)*</label>
                                    <div class="col-md-7">
                                        <input id="allow_carry_forward" type="text" class="form-control{{ $errors->has('allow_carry_forward') ? ' is-invalid' : '' }}" placeholder=""
                                            name="allow_carry_forward" value="{{ old('allow_carry_forward') }}" required>
                                    </div>                            
                                </div>
                                    <div class="form-group row w-100">
                                        <label class="col-md-5 col-form-label">Carry Forward End Month*</label> 
                                        <div class="col-md-7">
                                            <select class="form-control" id="carry_forward_expiry_months" name="carry_forward_expiry_months">
                                                <option selected disabled>Carry Forward End Month</option>
                                                <option value="1">JAN</option>
                                                <option value="2">FEB</option>
                                                <option value="3">MARCH</option>
                                                <option value="4">APR</option>
                                                <option value="5">MAY</option>
                                                <option value="6">JUNE</option>
                                                <option value="7">JULY</option>
                                                <option value="8">AUG</option>
                                                <option value="9">SEP</option>
                                                <option value="10">OCT</option>
                                                <option value="11">NOV</option>
                                                <option value="12">DEC</option>
                                            </select>
                                            @if ($errors->has('carry_forward_expiry_months'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('carry_forward_expiry_months') }}</strong>
                                            </span> 
                                            @endif
                                        </div>                            
                                    </div>

                                    
                                    <div class="form-group row w-100">
                                        <label class="col-md-5 col-form-label">Divide Method*</label> 
                                        <div class="col-md-7">
                                            <select class="form-control" id="divide_method" name="divide_method">
                                                <option selected disabled>Divide Method</option>
                                                <option value="1">No</option>
                                                <option value="2">Monthly</option>
                                            </select>
                                            @if ($errors->has('divide_method'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('divide_method') }}</strong>
                                            </span> 
                                            @endif
                                        </div>                          
                                    </div>


                                
                    </div>

                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                            </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts') 
<script>
    $('#end-date').datepicker({
        altField: "#alt-end-date",
        altFormat: 'yy-mm-dd',
        format: 'dd/mm/yy'
    });

    $('#start-date').datepicker({
        altField: "#alt-start-date",
        altFormat: 'yy-mm-dd',
        format: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "-80:+0"
    });
</script>
@append