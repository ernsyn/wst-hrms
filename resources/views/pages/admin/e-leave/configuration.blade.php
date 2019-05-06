@extends('layouts.admin-base') 
@section('content')
<div class="container">
        <div id="alert-container">
            </div>   
            @if (session('status'))
            <div class="alert alert-primary fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
            </div>
            @endif
    <div id="leave-types-card" class="card mb-4">
        <div class="card-header bg-primary text-white">
            <strong>Leave Types</strong>
        </div>
        <ul id="leave-types-list" class="list-group list-group-flush">
            @foreach ($defaultLeaveTypes as $leaveType)
            <li class="leave-type list-group-item" data-toggle="collapse" data-target="#leave-type-{{$loop->iteration}}">
                <span class="code badge badge-primary">{{$leaveType->code}}</span>
                <span class="name">{{$leaveType->name}}</span>
                <div class="float-right">
                    @if($leaveType->active)
                    <span class="status text-success">Active</span> @else
                    <span class="status text-danger">Inactive</span> @endif
                    <i class="expand-icon fas fa-angle-down"></i>
                </div>
            </li>
            <div class="collapse" id="leave-type-{{$loop->iteration}}">
                <div class="leave-type-details">
                    <div class="row">
                        <div class="col-md-4">
                            <div><strong>Description</strong></div>
                            <div>{{$leaveType->description}}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="div"><strong>Applied Rules</strong></div>
                            @foreach ($leaveType->applied_rules as $applied_rule) @if($applied_rule->rule != 'leave_calculation')
                            <div class="div"><i class="fas fa-angle-double-right"></i> {{ App\Constants\Naming::leaveTypeRule($applied_rule->rule)
                                }}</div>
                            @endif @endforeach
                        </div>
                        <div class="col-md-4">
                            <div class="float-right">
                                <button onclick="window.location.href='{{ route('admin.e-leave.configuration.leave-types.edit', ['id' => $leaveType->id]) }}'"
                                    type="button" class="edit-btn btn btn-primary-outline btn-sm"><i class="fas fa-pen"></i></button>                                
                                @if($leaveType->active)
                                <button type="submit" class="deactivate-btn action-btn ml-1 btn btn-secondary btn-sm" data-action="{{ route('admin.e-leave.configuration.leave-types.deactivate.post', ['id' => $leaveType->id]) }}">Deactivate</button>                                
                                @else
                                <button type="button" class="activate-btn action-btn ml-1 btn btn-secondary btn-sm" data-action="{{ route('admin.e-leave.configuration.leave-types.activate.post', ['id' => $leaveType->id]) }}">Activate</button>                                
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </ul>
        <div class="card-header bg-primary text-white">
            <strong>Custom Leave Types</strong>
            <a role="button" id="add-leave-type-btn" class="float-right btn btn-primary btn-sm" href={{ route(
                'admin.e-leave.configuration.leave-types.add') }}>
                <i class="fas fa-plus"></i>
            </a>
        </div>
        <ul id="leave-types-list" class="list-group list-group-flush">
            @foreach ($customLeaveTypes as $leaveType)
            <li class="leave-type list-group-item" data-toggle="collapse" data-target="#custom-leave-type-{{$loop->iteration}}">
                <span class="code badge badge-primary">{{$leaveType->code}}</span>
                <span class="name">{{$leaveType->name}}</span>
                <div class="float-right">
                    @if($leaveType->active)
                    <span class="status text-success">Active</span> @else
                    <span class="status text-danger">Inactive</span> @endif
                    <i class="expand-icon fas fa-angle-down"></i>
                </div>
            </li>
            <div class="collapse" id="custom-leave-type-{{$loop->iteration}}">
                <div class="leave-type-details">
                    <div class="row">
                        <div class="col-md-4">
                            <div><strong>Description</strong></div>
                            <div>{{$leaveType->description}}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="div"><strong>Applied Rules</strong></div>
                            @foreach ($leaveType->applied_rules as $applied_rule) @if($applied_rule->rule != 'leave_calculation')
                            <div class="div"><i class="fas fa-angle-double-right"></i> {{ App\Constants\Naming::leaveTypeRule($applied_rule->rule)
                                }}</div>
                            @endif @endforeach
                        </div>
                        <div class="col-md-4">
                            <div class="float-right">
                                <button type="button" class="edit-btn btn btn-primary-outline btn-sm" onclick="window.location.href='{{ route('admin.e-leave.configuration.leave-types.edit', ['id' => $leaveType->id]) }}'"><i class="fas fa-pen"></i></button>                                 
                                @if($leaveType->active)
                                <button type="submit" class="deactivate-btn action-btn ml-1 btn btn-secondary btn-sm" data-action="{{ route('admin.e-leave.configuration.leave-types.deactivate.post', ['id' => $leaveType->id]) }}">Deactivate</button>                                
                                @else
                                <button type="button" class="activate-btn action-btn ml-1 btn btn-secondary btn-sm" data-action="{{ route('admin.e-leave.configuration.leave-types.activate.post', ['id' => $leaveType->id]) }}">Activate</button>                                
                                @endif
                                <button type='submit' data-toggle="modal" data-target="#confirm-delete-modal" data-link="{{ route('admin.e-leave.configuration.leave-types.delete', ['id ' => $leaveType->id]) }}" data-entry-title='{{ $leaveType->id }}' class="btn btn-danger btn-smt fas fa-trash-alt">
                                    </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </ul>
    </div>
    <div id="leave-types-card" class="card mb-4">
        <div class="card-header bg-primary text-white">
            <strong>Leave Allocations</strong>
        </div>
        <ul id="leave-types-list" class="list-group list-group-flush">
            @foreach ($leaveAllocation as $row)
            <li class="leave-type list-group-item" data-toggle="collapse">
                <span class="code badge badge-primary">{{ $row->allocation_year }}</span>
                <span class="name">Leave Allocation</span>
                <div class="float-right">
                    <span class="text-success" style="font-weight:600">Generated</span>
                </div>
            </li>
            @endforeach
            <li class="leave-type list-group-item" data-toggle="collapse">
                <span class="code badge badge-primary">{{ \Carbon\Carbon::now()->year }}</span>
                <span class="name">Leave Allocation</span>
                <div class="float-right">
                	@if($generated === 'true')
                    <a role="button" id="add-leave-type-btn" class="float-right btn btn-primary btn-sm" href={{ route('admin.e-leave.configuration.generate-leave-allocation') }}>
                        Generate
                    </a>
                    @else
                    <span class="text-success" style="font-weight:600">Generated</span>
                    @endif
                </div>
            </li>
        </ul>
        {{-- <div class="card-header bg-primary text-white">
            <strong>Generate Leave Allocations for {{ \Carbon\Carbon::now()->year }}</strong>
            <a role="button" id="add-leave-type-btn" class="float-right btn btn-primary btn-sm" href={{ route(
                'admin.e-leave.configuration.generate-leave-allocation') }}>
                <i class="fas fa-plus"></i>
            </a>
        </div> --}}
    </div>
</div>
<div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirm-delete-label">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirm">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection
 
@section('scripts')
<script>
    $(document).ready(function() {
        $(".action-btn").click(function(e) {
            e.preventDefault();

            let action = $(e.currentTarget).data('action');
            console.log("data ", action);

            $.ajax({
                url: action,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(data) {
                    console.log("Success: ", data);
                    location.reload();
                },
                error: function(xhr) {
                    console.log("Error: ", xhr);
                }
            });
        });

    //     $(".delete-btn").click(function(e) {
    //         e.preventDefault();

    //         let action = $(e.currentTarget).data('action');
    //         console.log("data ", action);

    //         $.ajax({
    //             url: action,
    //             type: 'POST',
    //             data: {
    //                 _token: '{{ csrf_token() }}',
    //                 _method: 'DELETE'
    //             },
    //             success: function(data) {
    //                 console.log("Success: ", data);
    //                 location.reload();
    //             },
    //             error: function(xhr) {
    //                 console.log("Error: ", xhr);
    //             }
    //         });
    //     });
    //  });
     $('#confirm-delete-modal').on('show.bs.modal', function (e) {
            var entryTitle = $(e.relatedTarget).data('entry-title');
            var link = $(e.relatedTarget).data('link');
            $(this).find('.modal-body p').text('Are you sure you want to delete - ' + entryTitle + '?');

            // Pass form reference to modal for submission on yes/ok
            var form = $(e.relatedTarget).closest('form');
            $(this).find('.modal-footer #confirm').data('form', link);
        });

        $('#confirm-delete-modal').find('.modal-footer #confirm').on('click', function(){
            window.location = $(this).data('form');
        });
    });
</script>
@append