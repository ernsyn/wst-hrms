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
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <a role="button" class="btn btn-primary" href="{{ route('admin.settings.eis.add') }}">
                Add EIS
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="float-right tableTools-container"></div>
            <table class="hrms-data-table compact w-100 t-2" id="eis-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Salary</th>
                        <th>Employer</th>
                        <th>Employee</th>
                        {{--
                        <th>Total</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($eiss as $eis)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$eis['salary']}}</td>
                        <td>{{$eis['employer']}}</td>
                        <td>{{$eis['employee']}}</td>
                        {{--
                        <td>{{$eis['total']}}</td> --}}

                        <td>
                            <button onclick="window.location='{{ route('admin.settings.eis.edit.post', ['id' => $eis->id]) }}';" class="round-btn btn btn-default fas fa-edit btn-segment">
                                </button>
                            <button type='submit' data-toggle="modal" data-target="#confirm-delete-modal" data-entry-title='{{ $eis->salary }}' data-link='{{ route('admin.settings.eis.delete', ['id ' => $eis->id]) }}' class="round-btn btn btn-default fas fa-trash-alt btn-segment">
                                </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
    $(function(){
        $('#eis-table').DataTable({
            responsive: true,
            stateSave: true,
            dom: `<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
            <'row'<'col-md-6'><'col-md-6'>>
            <'row'<'col-md-12't>><'row'<'col-md-12'ip>>`,
            buttons: [{
                    extend: 'copy',
                    text: '<i class="fas fa-copy "></i>',
                    // text: '<i class="fas fa-copy "></i>',
                    className: 'btn-segment',
                    titleAttr: 'Copy'
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-search "></i>',
                    className: 'btn-segment',
                    titleAttr: 'Show/Hide Column'
                },
                {
                    extend: 'csv',
                    text: '<i class="fas fa-file-alt "></i>',
                    className: 'btn-segment',
                    titleAttr: 'Export CSV'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print "></i>',
                    className: 'btn-segment',
                    titleAttr: 'Print'
                },
            ]

        });
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
    })
</script>
@append
