{{-- TABLE JOB COMPANY --}}
<div class="tab-pane fade" id="nav-job-company" role="tabpanel" aria-labelledby="nav-job-company-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
        	@can(PermissionConstant::ADD_JOB_COMPANY)
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addJobCompanyPopup">
                Add Company
            </button>
            @endcan
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="float-right tableTools-container"></div>
            <table class="hrms-data-table compact w-100 t-2" id="job-company-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Company Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobCompany as $jc)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$jc['company_name']}}</td>
                        <td>
                        	@can(PermissionConstant::UPDATE_JOB_COMPANY)
                        	<button type="button" class="btn btn-success btn-smt " data-toggle="modal"
                                data-jc-id="{{$jc['id']}}" data-jc-company-name="{{$jc['company_name']}}"
                                data-target="#edit-job-company-popup"><i class="fas fa-edit"></i></button>
                            @endcan
                            @can(PermissionConstant::DELETE_JOB_COMPANY)
                        	<button type="submit" class="btn btn-danger btn-smt" data-toggle="modal" data-target="#confirm-delete-modal" data-entry-title='{{ $jc['company_name'] }}' data-link='{{ route('admin.settings.job-company.delete', ['id ' => $jc['id']]) }}' ><i class=" far fa-trash-alt"></i></button>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ADD JOB COMPANY -->
@can(PermissionConstant::ADD_JOB_COMPANY)
<div class="modal fade" id="addJobCompanyPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Job Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        	<form method="POST" action="{{ route('admin.settings.job-company.add.post', ['id' => $company->id])}} " id="add-job-company-form">
            <div class="modal-body">
                @csrf
                <div class="row pb-5">
                    <div class="col-xl-8">
                        <label class="col-md-12 col-form-label">Company Name*</label>
                        <div class="col-md-12">
                            <input id="company_name" type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name"
                                value="{{ old('company_name') }}" required>
                            @if ($errors->has('company_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('company_name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endcan

<!-- UPDATE JOB COMPANY -->
@can(PermissionConstant::UPDATE_JOB_COMPANY)
<div class="modal fade" id="edit-job-company-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Job Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('admin.settings.job-company.edit.post', ['id' => $company->id ])}}" id="edit-job-company-bank">
                    @csrf
                    <div class="row pb-5">
                    	<input type="hidden" class="form-control{{ $errors->has('job_company_id') ? ' is-invalid' : '' }}" id="job_company_id" name="job_company_id">
                        <div class="col-xl-8">
                            <label class="col-md-12 col-form-label">Company Name *</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" id="edit_company_name" name="company_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endcan

@can(PermissionConstant::DELETE_JOB_COMPANY)
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
@endcan

@section('scripts')
<script>
$(document).ready(function() {
    var t = $('#job-company-table').DataTable({
        responsive: true,
        stateSave: true,
        dom: `<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
        <'row'<'col-md-6'><'col-md-6'>>
        <'row'<'col-md-12't>><'row'<'col-md-12'ip>>`,
        buttons: [{
                extend: 'copy',
                text: '<i class="fas fa-copy "></i>',
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
        ],
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": [0, 2]
        } ]
    });
    
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

  	//update job company
    $('#edit-job-company-popup').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('jc-id')
        var company_name = button.data('jc-company-name')
        $('#job_company_id').val(id);
        $('#edit-job-company-popup #edit_company_name').val(company_name);
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

});
</script>
@append
