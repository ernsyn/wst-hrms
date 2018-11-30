@extends('layouts.admin-base') 
@section('content')
<div class="container">
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
                                <button type="button" class="edit-btn btn btn-primary-outline btn-sm"><i class="fas fa-pen"></i></button>                                 
                                @if($leaveType->active)
                                <button type="submit" class="deactivate-btn action-btn ml-1 btn btn-secondary btn-sm" data-action="{{ route('admin.e-leave.configuration.leave-types.deactivate.post', ['id' => $leaveType->id]) }}">Deactivate</button>                                
                                @else
                                <button type="button" class="activate-btn action-btn ml-1 btn btn-secondary btn-sm" data-action="{{ route('admin.e-leave.configuration.leave-types.activate.post', ['id' => $leaveType->id]) }}">Activate</button>                                
                                @endif
                                <button type="button" class="delete-btn ml-1 btn btn-danger btn-sm" data-action="{{ route('admin.e-leave.configuration.leave-types.delete', ['id' => $leaveType->id]) }}">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </ul>

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

        $(".delete-btn").click(function(e) {
            e.preventDefault();

            let action = $(e.currentTarget).data('action');
            console.log("data ", action);

            $.ajax({
                url: action,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE'
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
     });

</script>
@append