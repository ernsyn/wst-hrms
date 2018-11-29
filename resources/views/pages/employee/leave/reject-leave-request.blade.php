@extends('layouts.admin-base')
@section('content')
<div class="container">
    <div class="card">
   
     
          
           
    <form method="POST" action="{{ route('employee.e-leave.add-leave-request-disapprove.post', ['id' => $leaveRequest->id]) }}" id="form_validate"
            data-parsley-validate>
        <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="form-group row w-100">
    
                        <div class="col-8">
                            <label class="col-md-12 col-form-label">Leave Type*</label>
                            <div class="col-md-12">
                                <input id="id" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" placeholder="Registration No. here"
                                    name="id" value="{{ $leaveRequest->id }}" hidden>
                               
                              
                                        <input id="id" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" placeholder="Registration No. here"
                                            name="id" value="{{ $leaveRequest->id }}" readonly>
                                       
                                    </div>

                        </div>
               
                                <div class="col-8">
         
                                <label class="col-md-12 col-form-label">Start Date*</label>
                                <div class="col-md-12">
                                    <input id="start_date" type="text" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" placeholder="Registration No. here"
                                        name="start_date" value="{{ $leaveRequest->start_date }}" readonly>
                                   
                                </div>

                    </div>
                    </div>
                    <div class="form-group row w-100">
                            <div class="col-8">
     
                            <label class="col-md-12 col-form-label">End Date*</label>
                            <div class="col-md-5">
                                <input id="end_date" type="text" class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" placeholder="Registration No. here"
                                    name="end_date" value="{{ $leaveRequest->end_date }}" readonly>
                               
                            </div>

                </div>


    
                        <div class="col-8">
 
                        <label class="col-md-12 col-form-label">Total Applied Days</label>
                        <div class="col-md-5">
                            <input id="applied_days" type="text" class="form-control{{ $errors->has('applied_days') ? ' is-invalid' : '' }}" placeholder="Total Days"
                                name="applied_days" value="{{ $leaveRequest->applied_days }}" readonly>
                           
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
