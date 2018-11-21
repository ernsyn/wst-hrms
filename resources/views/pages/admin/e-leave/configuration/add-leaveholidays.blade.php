@extends('layouts.admin-base') 
@section('content')

@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
<div class="container">
    <div class="card">
        <form method="POST" action="{{ route('admin.e-leave.configuration.leaveholidays.add.post') }}" id="form_validate" data-parsley-validate>
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
                                        <label class="col-md-5 col-form-label">Repeated Manually*</label>
                                        <div class="col-md-7">
                                            <input id="repeat_manually" type="text" class="form-control{{ $errors->has('repeat_manually') ? ' is-invalid' : '' }}" placeholder=""
                                                name="repeat_manually" value="{{ old('repeat_manually') }}" required>
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