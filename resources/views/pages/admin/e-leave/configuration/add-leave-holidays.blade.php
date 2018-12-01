@extends('layouts.admin-base') 
@section('content')

@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
<div class="container">
    <div class="card">
        <form method="POST" action="{{ route('admin.e-leave.configuration.leave-holidays.add.post') }}" id="form_validate" data-parsley-validate>
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
                            <label class="col-md-5 col-form-label">Start Date*</label>
                            <div class="input-group mb-3 col-md-7">
                                <input id="start-date" type="text" class="form-control" placeholder="Start Date" aria-label="Start Date" aria-describedby="dob-icon" name="start_date" readonly>
                                <input id="alt-start-date" type="text" class="form-control" name="start_date" hidden>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="dob-icon"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>                          
                        </div>
                            <div class="form-group row w-100">
                                <label class="col-md-5 col-form-label">End Date*</label>
                                <div class="input-group mb-3 col-md-7">
                                    <input id="end-date" type="text" class="form-control" placeholder="End Date" aria-label="End Date" aria-describedby="dob-icon" name="end_date" readonly>
                                    <input id="alt-end-date" type="text" class="form-control" name="end_date" hidden>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="dob-icon"><i class="far fa-calendar-alt"></i></span>
                                    </div>                       
                                </div>
                            </div>

                            <div class="form-group row w-100">
                                <label class="col-md-5 col-form-label">Repeated annually*</label>
                                <div class="col-md-7">
                                    <select class="form-control" id="repeat_annually" name="repeat_annually">
                                        <option value="">Please Select</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                    </select>
                          

                                    <div id="repeat-annually-error" class="invalid-feedback">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row w-100">
                                <label class="col-md-5 col-form-label">State*</label>
                                <div class="col-md-7">
                                        <select class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" id="state">
                                            @foreach(App\Constants\MalaysianStates::$all as $state)
                                            <option value="{{ $state }}">{{ $state }}</option value="">
                                            @endforeach
                                        </select> @if ($errors->has('state'))
                                        <span class="invalid-feedback" role="alert">
                                                                  <strong>{{ $errors->first('state') }}</strong>
                                                              </span> @endif
                                    </select> 
                                    
                                    <div id="type-error" class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
    
                                    <div class="form-group row w-100">
                                            <label class="col-md-5 col-form-label">Note*</label>
                                            <div class="col-md-7">
                                                <input id="note" type="text" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" placeholder=""
                                                    name="note" value="{{ old('note') }}" required>
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