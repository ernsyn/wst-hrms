@extends('layouts.base') 
@section('content') @hasrole('super-admin')
<div class="p-4">
    <div class="row">
        <div class="p-2 col-xl-3 col-lg-6">
            <a href="{{ route('admin/user_list') }}">
                <div class="card border-0 bg-gradient-primary">
                    <div class="card-body">
                        <i class="fas fa-user fa-4x float-right text-white"></i>
                        <h6 class="text-white text-capitalize">Total Employee</h6>
                        <h1 class="text-white counter">187</h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="p-2 col-xl-3 col-lg-6">
            <a href="{{ route('admin/user_list') }}">
                <div class="card border-0 bg-gradient-info">
                    <div class="card-body">
                        <i class="fas fa-user-plus fa-4x float-right text-white"></i>
                        <h6 class="text-white text-capitalize">Joined This Month</h6>
                        <h1 class="text-white counter">7</h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="p-2 col-xl-3 col-lg-6">
            <a href="{{ route('admin/user_list') }}">
                <div class="card border-0 bg-success">
                    <div class="card-body">
                        <i class="fas fa-calendar-check fa-4x float-right text-white"></i>
                        <h6 class="text-white text-capitalize">Leave Request</h6>
                        <h1 class="text-white counter">9</h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="p-2 col-xl-3 col-lg-6">
            <a href="{{ route('setup/branch') }}">
                <div class="card border-0 bg-gradient-danger">
                    <div class="card-body">
                        <i class="fas fa-map-marker-alt fa-4x float-right text-white"></i>
                        <h6 class="text-white text-capitalize">Total Branch</h6>
                        <h1 class="text-white counter">13</h1>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="p-2 col-md-6">
            <div class="card">
                <div class="card-header">Recent Leave Request</div>
                <div class="card-body bulletin">
                    @foreach($leaverequest as $row)
                    <div class="row">
                        <div class="col-auto">
                            <div class="float-right">{{$loop->iteration}}.</div>
                        </div>
                        <div class="col">
                            <div>{{$row['name']}}</div>
                            <div>{{$row['leave_type']}}</div>
                            {{--
                            <div>{{$row['start_date']}} - {{$row['end_date']}}</div> --}}
                            <div>{{$row['total_days']}} days</div>
                            <div>{{$row['status']}}</div>
                            <div class="dropdown-divider"></div>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>
        <div class="p-2 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div>I am not a super admin...</div>
    @endhasrole
@endsection