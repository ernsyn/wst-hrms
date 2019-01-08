@extends('layouts.admin-base')
@section('content')
<div class="container pb-5">
    <div class="card">
        <form method="POST" action="{{ route('admin.e-leave.configuration.leave-holidays.edit.post', ['id' => $holidays->id]) }}" id="form_validate"
            data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="form-group row w-100">
                        <div class="col-4">
                            <label class="col-md-12 col-form-label">Name*</label>
                            <div class="col-md-12">

                                    <input id="id" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" placeholder="Total Day here"
                                    name="id" value="{{ $holidays->id }}" hidden>    
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name here"
                                    name="name" value="{{ $holidays->name }}" required> @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif
                            </div>
                        </div>

                    
                        <div class="col-4">
                            <label class="col-md-12 col-form-label">Start Date*</label>
                            <div class="col-md-12">
                                <input id="start-date" type="text" class="form-control" value="{{ $holidays->start_date }}" 
                                placeholder="Start Date" aria-label="Start Date" aria-describedby="dob-icon" name="start_date" readonly>
                                @if ($errors->has('start_date'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span> @endif
                                <input id="alt-start-date" type="text" class="form-control" name="start_date" hidden>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="dob-icon"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>                          
                        </div>
                                   
                        <div class="col-4">
                            <label class="col-md-12 col-form-label">End Date*</label>
                            <div class="col-md-12">
                                    <input id="end-date" type="text" class="form-control" value="{{ $holidays->end_date }}"  placeholder="End Date" aria-label="End Date" aria-describedby="dob-icon" name="end_date" readonly>
                                    @if ($errors->has('end_date'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('end_date') }}</strong>
                                        </span> @endif
                                         <input id="alt-end-date" type="text" class="form-control" name="end_date" hidden>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="dob-icon"><i class="far fa-calendar-alt"></i></span>
                                    </div>                       
                                </div>
                            </div>
                            

                    </div>
                    <div class="form-group row w-100">
                        <div class="col-8">
                            <label class="col-md-12 col-form-label">Total Day*</label>
                            <div class="col-md-12">
                                <input id="total_days" type="text" class="form-control{{ $errors->has('total_days') ? ' is-invalid' : '' }}" placeholder="Total Day here"
                                    name="total_days" value="{{ $holidays->total_days }}" readonly>                                @if ($errors->has('total_days'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('total_days') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                        <div class="col-4">
                                <div class="form-group">
                                        <label class="col-md-12 col-form-label">Repeated Annually*</label>
                                        <div class="col-md-12">
                                    {{-- <select class="form-control{{ $errors->has('repeat_annually') ? ' is-invalid' : '' }}" id="repeat_annually" name="repeat_annually" value="{{ $holidays->repeat_annually }}">
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                            </select> --}}

                                            <select class="form-control" id="status" name="status" value="{{ $holidays->repeat_annually}}">
                                                <option value="">Please Select</option>
                                                    <option value="1"  {{ $holidays->repeat_annually == '1' ? 'selected' : ''}}>Yes</option>
                                                    <option value="2"{{ $holidays->repeat_annually == '2' ? 'selected' : ''}}>No</option>
                                                </select>
                                        </div>


                                </div>
                            </div>
                            <div class="col-8">
                                <label class="col-md-12 col-form-label">Note</label>
                                <div class="col-md-12">
                                    <input id="note" type="text" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" placeholder="Note here"
                                        name="note" value="{{ $holidays->note }}" >                                @if ($errors->has('total_days'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('note') }}</strong>
                                        </span> @endif
                                </div>
                            </div>


                            <div class="col-4">
                                <div class="form-group">
                                        <label class="col-md-12 col-form-label">Status*</label>
                                        <div class="col-md-12">
                                    <select class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" id="holidaysStatus" name="status" value="{{ $holidays->status }}">
                                              <option>Active</option>
                                              <option>Inactive</option>
                                            </select>
                                        </div>
                                </div>
                            </div>

           
                            <div class="col-8">
                                <label class="col-md-12 col-form-label">State</label>
                                <div class="col-md-12">
                                    <select multiple class="tagsinput form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" id="state" name="state[]"
                                        >
                                        <option value="">Please Select</option>
                                        @foreach(App\Constants\MalaysianStates::$all as $state)
                                        <option value="{{ $state }}">{{ $state }}</option value="">
                                        @endforeach
                                    </select> @if ($errors->has('state'))
                                    <span class="invalid-feedback" role="alert">
                                                                      <strong>{{ $errors->first('state') }}</strong>
                                                                  </span> @endif
                                    </select>
                                                                            {{-- <select class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" id="state" value="{{ $holidays->state }}">
                                                <option value="">Please Select</option>
                                            @foreach(App\Constants\MalaysianStates::$all as $state)
                                            <option value="{{$state }}">{{ $state }}</option value="">
                                            @endforeach
                                        </select> @if ($errors->has('state'))
                                        <span class="invalid-feedback" role="alert">
                                                                  <strong>{{ $errors->first('state') }}</strong>
                                                              </span> @endif
                                    </select> --}}
                                    <div id="state-error" class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
             
                  

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
<script type="text/javascript">


$('.itemName').select2({
  placeholder: 'Select an item',
  ajax: {
    url: '/select2-autocomplete-ajax',
    dataType: 'json',
    delay: 250,
    processResults: function (data) {
      return {
        results:  $.map(data, function (item) {
              return {
                  text: item.name,
                  id: item.id
              }
          })
      };
    },
    cache: true
  }
});


</script>
@append