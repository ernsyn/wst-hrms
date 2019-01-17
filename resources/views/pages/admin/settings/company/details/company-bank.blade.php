{{-- TABLE COMPANY BANK --}}
<div class="tab-pane fade show active" id="nav-bank" role="tabpanel" aria-labelledby="nav-bank-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCompanyBankPopup">
                Add Company Bank
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="float-right tableTools-container"></div>
            <table class="hrms-data-table compact w-100 t-2" id="company-banks-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Company Name</th>
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
                        <td>{{$companybanks->company->name}}</td>
                        <td>{{$companybanks['acc_name']}}</td>
                        <td>{{$companybanks->bank->name}}</td>
                        <td>{{$companybanks['created_at']}}</td>
                        <td>{{$companybanks['status']}}</td>
                        <td><button type="button" class="btn btn-success btn-smt " data-toggle="modal"
                                data-bank-id="{{$companybanks['id']}}" data-bank-bank_code="{{$companybanks['bank_code']}}"
                                data-bank-acc_name="{{$companybanks['acc_name']}}" data-bank-status="{{$companybanks['status']}}"
                                data-target="#editCompanyBankPopup"><i class="fas fa-edit"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ADD COMPANY BANK -->
<div class="modal fade" id="addCompanyBankPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Company Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @foreach($company as $banks)
            <form method="POST" action="{{ route('admin.settings.company-banks.add.post', ['id' => $banks->id])}} " id="add_company_bank">
                @endforeach
                <div class="modal-body">
                    @csrf
                    <div class="row p-3">
                        <label class="col-md-12 col-form-label">Bank Name*</label>
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
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- UPDATE COMPANY BANK -->
<div class="modal fade" id="editCompanyBankPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Company Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                @foreach($bank as $banks)
                <form method="POST" action="{{route('admin.settings.company-banks.edit.post', ['id' => $banks->company_id ])}}" id="edit_company_bank">
                    @endforeach @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <div class="col-md-12">
                                <input id="company_bank_id" type="text" class="form-control{{ $errors->has('company_bank_id') ? ' is-invalid' : '' }}" name="company_bank_id"
                                    value="{{ old('company_bank_id') }}" hidden>
                            </div>
                            <label class="col-md-12 col-form-label">Bank*</label>
                            <div class="col-md-12">
                                <select class="form-control{{ $errors->has('bank_code') ? ' is-invalid' : '' }}" name="bank_code" id="bank_code" value="{{ old('bank_code') }}">
                                    @foreach(App\BankCode::all() as $banks)
                                    <option value="{{ $banks->id }}">{{ $banks->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="col-md-12 col-form-label">Account Name*</label>
                            <div class="col-md-12">
                                <input id="acc_name" type="text" class="form-control{{ $errors->has('acc_name') ? ' is-invalid' : '' }}" name="acc_name"
                                    value="{{ old('acc_name') }}" required>
                            </div>
                            <label class="col-md-12 col-form-label">Status* </label>
                            <div class="col-md-12">
                                <select class="form-control" id="status" name="status" value="{{ old('status') }}">
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
<!-- DELETE COMPANY BANK -->
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

@section('scripts')
<script>
    $('#company-banks-table').DataTable({
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
</script>
@append
