@extends('layouts.app') 
@section('pageTitle', 'Job Configure') 
@section('content')
<div class="row">
    <nav class="col-6 pr-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-weight-bold h3" aria-current="page">{{ ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Fallback Title' }}</li>
        </ol>
    </nav>
    <nav class="col-6 pl-0 justify-end">
        {{ Breadcrumbs::render('setup/job-configure') }}
    </nav>
</div>
<div class="p-4">
    <div class="card py-4">
        <div class="card-body">
            <div class="container-fluid">
                <form>
                    <div class="row">
                        <nav class="col-sm-12">
                            <div class="nav nav-tabs font-weight-bold" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-cost-tab" data-toggle="tab" href="#nav-cost" role="tab" aria-controls="nav-cost"
                                    aria-selected="false">Cost Centre</a>
                                <a class="nav-item nav-link" id="nav-department-tab" data-toggle="tab" href="#nav-department" role="tab" aria-controls="nav-department"
                                    aria-selected="true">Department</a>
                                <a class="nav-item nav-link" id="nav-team-tab" data-toggle="tab" href="#nav-team" role="tab" aria-controls="nav-team" aria-selected="true">Team</a>
                                <a class="nav-item nav-link" id="nav-position-tab" data-toggle="tab" href="#nav-position" role="tab" aria-controls="nav-position"
                                    aria-selected="true">Position</a>
                                <a class="nav-item nav-link" id="nav-grade-tab" data-toggle="tab" href="#nav-grade" role="tab" aria-controls="nav-grade"
                                    aria-selected="true">Grade</a>

                            </div>
                        </nav>
                        {{-- Cost Centre --}}
                        <div class="tab-content col-sm-12 text-justify pt-4" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-cost" role="tabpanel" aria-labelledby="nav-cost-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover">
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Seniority Pay</th>
                                                <th>Amount</th>
                                                <th>Payroll Type</th>
                                                <th>Action</th>
                                            </tr>
                                            @foreach($costs as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$row['name']}}</td>
                                                <td>{{$row['seniority_pay']}}</td>
                                                <td>{{$row['amount']}}</td>
                                                <td>{{$row['payroll_type']}}</td>
                                                <td>Action</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- Department --}}
                            <div class="tab-pane fade" id="nav-department" role="tabpanel" aria-labelledby="nav-department-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover">
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                            @foreach($departments as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$row['name']}}</td>
                                                <td>Action</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- Team --}}
                            <div class="tab-pane fade" id="nav-team" role="tabpanel" aria-labelledby="nav-team-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover">
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                            @foreach($teams as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$row['name']}}</td>
                                                <td>Action</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- Position --}}
                            <div class="tab-pane fade" id="nav-position" role="tabpanel" aria-labelledby="nav-position-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover">
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                            @foreach($positions as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$row['name']}}</td>
                                                <td>Action</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- Grade --}}
                            <div class="tab-pane fade" id="nav-grade" role="tabpanel" aria-labelledby="nav-grade-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover">
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                            @foreach($grade as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$row['name']}}</td>
                                                <td>Action</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{--
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.
                            </div> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection