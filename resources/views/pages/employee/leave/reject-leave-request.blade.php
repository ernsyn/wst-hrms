@extends('layouts.base')
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
       
                                    <div class="col-md-12">
                                
                                                <input id="emp_id" type="text" class="form-control{{ $errors->has('emp_id') ? ' is-invalid' : '' }}" placeholder="Registration No. here"
                                                    name="emp_id" value="{{ $leaveRequest->emp_id }}" hidden>
                                               
                                            </div>
        
                                </div>

                                <div class="col-8">
                                        <label class="col-md-12 col-form-label">Employee Name*</label>
                                        <div class="col-md-12">
    
                                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Registration No. here"
                                                        name="name" value="{{$leaveRequest->employee->user->name}}" readonly>
                                             </div>
            
                                    </div>

                                    <div class="col-8">
                                            <label class="col-md-12 col-form-label">Allocated Days*</label>
                                            <div class="col-md-12">
        
                                                   <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Registration No. here"
                                                            name="name" value="{{$leaveRequest->leave_allocation->allocated_days}}" readonly> 
                                                    </div>
                
                                        </div>

                        <div class="col-8">
                            <label class="col-md-12 col-form-label">Leave Type*</label>
                            <div class="col-md-12">
                         
                                    
                                    <input id="id" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" placeholder="Registration No. here"
                                    name="id" value="{{ $leaveRequest->id }}" hidden>

                                    <input id="total_days" type="text" class="form-control{{ $errors->has('total_days') ? ' is-invalid' : '' }}" placeholder="Registration No. here"
                                    name="total_days" value="{{ $leaveRequest->applied_days }}" hidden>

                                    <input id="leave_type_id" type="text" class="form-control{{ $errors->has('leave_type_id') ? ' is-invalid' : '' }}" placeholder="Registration No. here"
                                    name="leave_type_id" value="{{$leaveRequest->leave_type_id}}" hidden>
                                        <input id="leave_type_name" type="text" class="form-control{{ $errors->has('leave_type_name') ? ' is-invalid' : '' }}" placeholder="Registration No. here"
                                            name="leave_type_name" value="{{$leaveRequest->leave_type->name}}" readonly>
                                       
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
                            <div class="col-md-12">
                                <input id="end_date" type="text" class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" placeholder="Registration No. here"
                                    name="end_date" value="{{ $leaveRequest->end_date }}" readonly>
                               
                            </div>

                </div>


    
                        <div class="col-8">
 
                        <label class="col-md-12 col-form-label">Total Applied Days</label>
                        <div class="col-md-12">
                            <input id="applied_days" type="text" class="form-control{{ $errors->has('applied_days') ? ' is-invalid' : '' }}" placeholder="Total Days"
                                name="applied_days" value="{{ $leaveRequest->applied_days }}" readonly>
                           
                        </div>
                        </div>
                        <div class="col-8">
 
                                <label class="col-md-12 col-form-label">Reason</label>
                                <div class="col-md-12">
                                    <input id="reason" type="text" class="form-control{{ $errors->has('reason') ? ' is-invalid' : '' }}" placeholder="Total Days"
                                        name="reason" value="{{ $leaveRequest->reason }}" readonly>
                                   
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
