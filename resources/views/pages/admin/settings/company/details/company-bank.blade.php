{{-- TABLE COMPANY BANK --}}
<div class="tab-pane fade show active" id="nav-bank" role="tabpanel" aria-labelledby="nav-bank-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
        	@can(PermissionConstant::ADD_COMPANY_BANK)
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCompanyBankPopup">
                Add Company Bank
            </button>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="float-right tableTools-container"></div>
            <table class="hrms-data-table compact w-100 t-2" id="company-banks-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Account Name</th>
                        <th>Bank Code</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bank as $companybanks)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$companybanks['acc_name']}}</td>
                        <td>{{$companybanks->bank->name}}</td>
                        <td>{{$companybanks['created_at']}}</td>
                        <td>{{$companybanks['status']}}</td>
                        <td>
                        	@can(PermissionConstant::UPDATE_COMPANY_BANK)
                        	<button type="button" class="btn btn-success btn-smt " data-toggle="modal"
                                data-bank-id="{{$companybanks['id']}}" data-bank-bank-code="{{$companybanks['bank_code']}}"
                                data-bank-account-name="{{$companybanks['acc_name']}}" data-bank-status="{{$companybanks['status']}}"
                                data-target="#edit-company-bank-popup"><i class="fas fa-edit"></i></button>
                            @endcan
                            @can(PermissionConstant::DELETE_COMPANY_BANK)
                        	<button type="submit" class="btn btn-danger btn-smt" data-toggle="modal" data-target="#confirm-delete-modal" data-entry-title='{{ $companybanks->bank->name }}' data-link='{{ route('admin.settings.company-banks.delete', ['id ' => $companybanks['id']]) }}' ><i class=" far fa-trash-alt"></i></button>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ADD COMPANY BANK -->
@can(PermissionConstant::ADD_COMPANY_BANK)
<div class="modal fade" id="addCompanyBankPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Company Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        	<form method="POST" action="{{ route('admin.settings.company-banks.add.post', ['id' => $company->id])}} " id="add-company-bank-form">
            <div class="modal-body">
                @csrf
                <div class="row pb-5">
                    <div class="col-xl-8">
                        <label class="col-md-12 col-form-label">Bank*</label>
                        <div class="col-md-12">
                            <select class="form-control{{ $errors->has('bank_code') ? ' is-invalid' : '' }}" name="bank_code" id="bank_code" required>
                                <option value="">Please Select</option>
                                @foreach(App\BankCode::all()->sortBy('name') as $banks)
                                <option value="{{ $banks->id }}">{{ $banks->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('bank_code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('bank_code') }}</strong>
                            </span>
                            @endif
                        </div>
                    
                        <label class="col-md-12 col-form-label">Account Name*</label>
                        <div class="col-md-12">
                            <input id="acc_name" type="text" class="form-control{{ $errors->has('acc_name') ? ' is-invalid' : '' }}" name="acc_name"
                                value="{{ old('acc_name') }}" required>
                            @if ($errors->has('acc_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('acc_name') }}</strong>
                            </span>
                            @endif
                        </div>
                        
                        <label class="col-md-12 col-form-label">Status*</label>
                        <div class="col-md-12">
                            <select class="form-control" id="status" name="status">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
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

<!-- UPDATE COMPANY BANK -->
@can(PermissionConstant::UPDATE_COMPANY_BANK)
<div class="modal fade" id="edit-company-bank-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Company Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                @foreach($bank as $banks)
                <form method="POST" action="{{route('admin.settings.company-banks.edit.post', ['id' => $banks->company_id ])}}" id="edit-company-bank-form">
                    @endforeach 
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <div class="col-md-12">
                                <input type="text" class="form-control{{ $errors->has('company_bank_id') ? ' is-invalid' : '' }}" name="company_bank_id" hidden>
                            </div>
                            <label class="col-md-12 col-form-label">Bank*</label>
                            <div class="col-md-12">
                                <select class="form-control{{ $errors->has('bank_code') ? ' is-invalid' : '' }}" name="bank_code" required>
                                    @foreach(App\BankCode::all() as $banks)
                                    <option value="{{ $banks->id }}">{{ $banks->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="col-md-12 col-form-label">Account Name*</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control{{ $errors->has('acc_name') ? ' is-invalid' : '' }}" name="acc_name" required>
                            </div>
                            <label class="col-md-12 col-form-label">Status* </label>
                            <div class="col-md-12">
                                <select class="form-control" name="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
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

@can(PermissionConstant::DELETE_COMPANY_BANK)
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
    $('#add-company-bank-form select[name=bank_code]').selectize({
        plugins: ['restore_on_backspace'],
        sortField: 'text'
    });
    var editBankCode = $('#edit-company-bank-form select[name=bank_code]').selectize({
        plugins: ['restore_on_backspace'],
        sortField: 'text'
    });


    $('#add-company-bank-form select[name=status]').selectize({
        plugins: ['restore_on_backspace'],
        sortField: 'text'
    });
    var editStatus = $('#edit-company-bank-form select[name=status]').selectize({
        plugins: ['restore_on_backspace'],
        sortField: 'text'
    });


    var t = $('#company-banks-table').DataTable({
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
            "targets": [0, 5]
        } ]
    });
    
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();


    //update company
    $('#edit-company-bank-popup').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('bank-id')
    var bank_code = button.data('bank-bank-code')
    var account_name = button.data('bank-account-name')
    var status = button.data('bank-status')

    $('#edit-company-bank-form input[name=company_bank_id]').val(id)
    	editBankCode[0].selectize.setValue(bank_code);
    $('#edit-company-bank-form input[name=acc_name]').val(account_name)
    	editStatus[0].selectize.setValue(status)
    })
    
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
