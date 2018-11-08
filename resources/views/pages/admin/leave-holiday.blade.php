@extends('layouts.base') 
@section('pageTitle', 'Holiday Setup') 
@section('content')
<!-- ADD -->
<div class="modal fade" id="addHolidayPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Holiday</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('add_holiday') }}" id="add_holiday">
                    @csrf
                    <div class="row">
                        <div class="col-xl-8">
                            <label class="col-md-5 col-form-label">Leave Name*</label>
                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Leave Name"
                                    name="name" value="{{ old('name') }}" required> @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span> @endif
                            </div>
                            <label class="col-md-5 col-form-label">Start Date*</label>
                            <div class="col-md-7">
                                <input id="startDate" autocomplete="off" type="text" class="form-control">
                                <input name="startDate" id="altStart" type="text" class="form-control" hidden>                                
                                
                            </div>                             
                            <label class="col-md-5 col-form-label">End Date*</label>
                            <div class="col-md-7">
                                <input id="endDate" autocomplete="off" type="text" class="form-control">
                                <input name="endDate" id="altEnd" type="text" class="form-control" hidden>                                
                                
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

<div class="p-4">
    <div class="card py-4">
        <div class="card-body">
            <div class="row pb-3">
                <div class="col-auto mr-auto"></div>
                <div class="col-auto">
                    <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#addHolidayPopup">
                                    Add Holiday
                                </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover" id="leaveHolidayTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Employee Id</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total Days</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($leaveholiday as $row)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$row['name']}}</td>
                                <td>{{$row['start_date']}}</td>
                                <td>{{$row['end_date']}}</td>
                                <td>{{$row['total_days']}}</td>
                                <td>Action</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" id="testswall" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection