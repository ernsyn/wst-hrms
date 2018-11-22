@extends('layouts.base') 
@section('pageTitle', 'Leave Setup') 
@section('content')

<div class="p-4">
    <div class="card py-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover" id="leaveBalanceTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Employee Id</th>
                                <th>Leave Balance</th>
                                <th>Carry Forward</th>
                                <th>Leave Type</th>
    
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($leavebalance as $row)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$row['name']}}</td>
                                <td>{{$row['balance']}}</td>
                                <td>{{$row['carry']}}</td>
                                <td>{{$row['leave']}}</td>
               
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