@extends('layouts.admin-base')
@section('content')
<div class="container">
        <div id="alert-container">
            </div>  
    <div class="card">
        <form method="POST" action="{{ route('admin.e-leave.configuration.leave-holidays.add.post') }}">
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="form-group row w-100">
                        <label class="col-md-5 col-form-label">Name*</label>
                        <div class="col-md-7">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="" name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <label class="col-md-5 col-form-label">Start Date*</label>
                        <div class="input-group col-md-7 date" data-target-input="nearest">
                            <input type="text" id="start-date" name="start_date" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" value="{{ old('start_date') }}" data-target="#start-date" autocomplete="off" >
                            <div class="input-group-append" data-target="#start-date" data-toggle="datetimepicker">
                                <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                            </div>
                            @if ($errors->has('start_date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('start_date') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <label class="col-md-5 col-form-label">End Date*</label>
                        <div class="input-group col-md-7 date" data-target-input="nearest">
                            <input type="text" id="end-date" name="end_date" class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" value="{{ old('end_date') }}" data-target="#end-date" autocomplete="off" >
                            <div class="input-group-append" data-target="#end-date" data-toggle="datetimepicker">
                                <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                            </div>
                            @if ($errors->has('end_date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('end_date') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <label class="col-md-5 col-form-label">Repeated annually*</label>
                        <div class="col-md-7">
                            <select class="form-control{{ $errors->has('repeat_annually') ? ' is-invalid' : '' }}" id="repeat_annually" name="repeat_annually">
                                <option value="">Please Select</option>
                                <option value="1" {{ old('repeat_annually') == '1' ? 'selected' : ''}}>Yes</option>
                                <option value="2" {{ old('repeat_annually') == '2' ? 'selected' : ''}}>No</option>
                            </select>
                            @if ($errors->has('repeat_annually'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('repeat_annually') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <label class="col-md-5 col-form-label">Type*</label>
                        <div class="col-md-7">
                            <select class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" id="type" name="type">
                                <option value="">Please Select</option>
                                <option value="Paid Public Holiday" {{ old('type') == 'Paid Public Holiday' ? 'selected' : ''}}>Paid Public Holiday</option>
                                <option value="Replacement Leave" {{ old('type') == 'Replacement Leave' ? 'selected' : ''}}>Replacement Leave</option>
                            </select>
                            @if ($errors->has('type'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row w-100">
                        <label class="col-md-5 col-form-label">State*</label>
                        <div class="col-md-7">
                            <select multiple class="tagsinput form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" id="state" name="state[]">
                                <option value="">Please Select</option>
                                @foreach(MalaysianStates::$all as $state)
                                <option value="{{ $state }}" {{ (collect(old("state"))->contains($state)) == $state ? "selected":"" }}>{{ $state }}</option value="">
                                @endforeach
                            </select>
                            @if ($errors->has('state'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('state') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <label class="col-md-5 col-form-label">Note</label>
                        <div class="col-md-7">
                            <input id="note" type="text" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" placeholder="" name="note"
                                value="{{ old('note') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                <a role="button" class="btn btn-secondary" href="{{ URL::previous() }}">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>


    $('#start-date').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    $('#start-date').keydown(false);
    $('#start-date').css('caret-color', 'transparent');


    $('#end-date').datetimepicker({
        format: 'DD/MM/YYYY',
        useCurrent: false
    });
    $('#end-date').keydown(false);
    $('#end-date').css('caret-color', 'transparent');

    $("#start-date").on("change.datetimepicker", function (e) {
        $('#end-date').datetimepicker('minDate', e.date);
    });
    $("#end-date").on("change.datetimepicker", function (e) {
        $('#start-date').datetimepicker('maxDate', e.date);
    });
    
    $('#state').selectize({
        sortField: 'text'
    });

</script>
<script type="text/javascript">

</script>
@append
