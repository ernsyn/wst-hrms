<!-- ADD -->
{{-- <div class="modal fade" id="add-bank-accounts-popup" tabindex="-1" role="dialog" aria-labelledby="add-bank-accounts-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-bank-accounts-label">Add Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-bank-accounts-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Bank Name*</strong></label>
                            <input id="bank-code" type="text" class="form-control" placeholder="" value="" readonly>
                            <div id="bank-code-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Account Number*</strong></label>
                            <input id="acc-no" type="text" class="form-control" placeholder="" value="" readonly>
                            <div id="acc-no-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Account Status*</strong></label>
                            <select name="acc-status" id="acc-status" type="text" class="form-control" placeholder="" value="" readonly>
                                <option value="">Select Type</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            <div id="acc-status-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="add-bank-accounts-submit" type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

<!-- UPDATE -->
<div class="modal fade" id="edit-bank-accounts-popup" tabindex="-1" role="dialog" aria-labelledby="edit-bank-accounts-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-bank-accounts-label">View Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form id="edit-bank-accounts-form">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Bank Name*</strong></label>
                            <input id="bank-code" type="text" class="form-control" placeholder="" value="" readonly>
                            <div id="bank-code-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Account Number*</strong></label>
                            <input id="acc-no" type="text" class="form-control" placeholder="" value="" readonly>
                            <div id="acc-no-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Account Status*</strong></label>
                            {{-- <select name="acc-status" id="acc-status" type="text" class="form-control" placeholder="" value="" readonly>
                                <option value="">Select Type</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select> --}}
                            <input id="acc-status" type="text" class="form-control" placeholder="" value="" readonly>

                            <div id="acc-status-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button id="edit-bank-accounts-submit" type="submit" class="btn btn-primary">{{ __('Submit') }}</button> --}}
                </div>
            </form>
        </div>
    </div>
</div>

{{-- DELETE --}}
{{-- <div class="modal fade" id="confirm-delete-bank-account-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-label" aria-hidden="true">
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
                <button type="button" class="btn btn-danger" id="delete-bank-accounts-submit">Delete</button>
            </div>
        </div>
    </div>
</div> --}}

<div class="tab-pane fade show p-3" id="nav-bank" role="tabpanel" aria-labelledby="nav-bank-tab">
    {{-- <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#add-bank-accounts-popup">
                Add Bank
            </button>
        </div>
    </div> --}}
    <table class="table table-bordered table-hover w-100" id="employee-bank-accounts-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Bank Name</th>
                <th>Account Number</th>
                <th>Account Status</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>






@section('scripts')
<script>
    var bankAccountsTable = $('#employee-bank-accounts-table').DataTable({
        "bInfo": true,
        "bDeferRender": true,
        "serverSide": true,
        "bStateSave": true,
        "ajax": "{{ route('employee.dt.bank-accounts', ['id' => $id]) }}",
        "columns": [{
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "bank_code"
            },
            {
                "data": "acc_no"
            },
            {
                "data": "acc_status"
            },
            {
                "data": null,
                render: function (data, type, row, meta) {
                    return `<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-bank-accounts-popup"><i class="far fa-eye"></i></button>`;
                        // `<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#confirm-delete-bank-account-modal"><i class="far fa-trash-alt"></i></button>`;
                }
            }
        ]
    });

</script>
<script type="text/javascript">
    $(function(){
        // ADD
        // $('#add-bank-accounts-popup').on('show.bs.modal', function (event) {
        //     clearBankAccountError('#add-bank-accounts-form');
        // });
        // $('#add-bank-accounts-form #add-bank-accounts-submit').click(function(e){
        //     e.preventDefault();
        //     clearBankAccountError('#add-bank-accounts-form');
        //     $.ajax({
        //         url: "{{ route('employee.bank-accounts.post', ['id' => $id]) }}",
        //         type: 'POST',
        //         data: {
        //             _token: '{{ csrf_token() }}',
        //             // Form Data
        //             bank_code: $('#add-bank-accounts-form #bank-code').val(),
        //             acc_no: $('#add-bank-accounts-form #acc-no').val(),
        //             acc_status: $('#add-bank-accounts-form #acc-status').val()
        //         },
        //         success: function(data) {
        //             showAlert(data.success);
        //             bankAccountsTable.ajax.reload();
        //             $('#add-bank-accounts-popup').modal('toggle');
        //             clearBankAccountModal('#add-bank-accounts-form');
        //         },
        //         error: function(xhr) {
        //             if(xhr.status == 422) {
        //                 var errors = xhr.responseJSON.errors;
        //                 console.log("Error: ", xhr);
        //                 for (var errorField in errors) {
        //                     if (errors.hasOwnProperty(errorField)) {
        //                         console.log("Error: ", errorField);
        //                         switch(errorField) {
        //                             case 'bank_code':
        //                                 $('#add-bank-accounts-form #bank-code').addClass('is-invalid');
        //                                 $('#add-bank-accounts-form #bank-code-error').html('<strong>' + errors[errorField][0] + "</strong>");
        //                             break;
        //                             case 'acc_no':
        //                                 $('#add-bank-accounts-form #acc-no').addClass('is-invalid');
        //                                 $('#add-bank-accounts-form #acc-no-error').html('<strong>' + errors[errorField][0] + "</strong>");
        //                             break;
        //                             case 'acc_status':
        //                                 $('#add-bank-accounts-form #acc-status').addClass('is-invalid');
        //                                 $('#add-bank-accounts-form #acc-status-error').html('<strong>' + errors[errorField][0] + '</strong>');
        //                             break;
        //                         }
        //                     }
        //                 }
        //             }
        //         }
        //     });
        // });

        // EDIT
        var editId = null;
        $('#edit-bank-accounts-popup').on('show.bs.modal', function (event) {
            clearBankAccountError('#edit-bank-accounts-form');
            var button = $(event.relatedTarget)
            var currentData = JSON.parse(decodeURI(button.data('current')))
            console.log('Data: ', currentData)

            editId = currentData.id;

            $('#edit-bank-accounts-form #bank-code').val(currentData.bank_code);
            $('#edit-bank-accounts-form #acc-no').val(currentData.acc_no);
            $('#edit-bank-accounts-form #acc-status').val(currentData.acc_status);
        });

        // var editRouteTemplate = "{{ route('employee.bank-accounts.edit.post', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        // $('#edit-bank-accounts-submit').click(function(e){
        //     var editRoute = editRouteTemplate.replace(encodeURI('<<id>>'), editId);
        //     clearBankAccountError('#edit-bank-accounts-form');
        //     e.preventDefault();
        //     $.ajax({
        //         url: editRoute,
        //         type: 'POST',
        //         data: {
        //             _token: '{{ csrf_token() }}',
        //             bank_code: $('#edit-bank-accounts-form #bank-code').val(),
        //             acc_no: $('#edit-bank-accounts-form #acc-no').val(),
        //             acc_status: $('#edit-bank-accounts-form #acc-status').val()
        //         },
        //         success: function(data) {
        //             showAlert(data.success);
        //             bankAccountsTable.ajax.reload();
        //             $('#edit-bank-accounts-popup').modal('toggle');
        //             clearBankAccountModal('#edit-bank-accounts-form');
        //         },
        //         error: function(xhr) {
        //             if(xhr.status == 422) {
        //                 var errors = xhr.responseJSON.errors;
        //                 console.log("Error: ", xhr);
        //                 for (var errorField in errors) {
        //                     if (errors.hasOwnProperty(errorField)) {
        //                         console.log("Error: ", errorField);
        //                         switch(errorField) {
        //                             case 'bank_code':
        //                                 $('#edit-bank-accounts-form #bank-code').addClass('is-invalid');
        //                                 $('#edit-bank-accounts-form #bank-code-error').html('<strong>' + errors[errorField][0] + "</strong>");
        //                             break;
        //                             case 'acc_no':
        //                                 $('#edit-bank-accounts-form #acc-no').addClass('is-invalid');
        //                                 $('#edit-bank-accounts-form #acc-no-error').html('<strong>' + errors[errorField][0] + "</strong>");
        //                             break;
        //                             case 'acc_status':
        //                                 $('#edit-bank-accounts-form #acc-status').addClass('is-invalid');
        //                                 $('#edit-bank-accounts-form #acc-status-error').html('<strong>' + errors[errorField][0] + '</strong>');
        //                             break;
        //                         }
        //                     }
        //                 }
        //             }
        //         }
        //     });
        // });

        // DELETE
        // var deleteId = null;
        // $('#confirm-delete-bank-account-modal').on('show.bs.modal', function (event) {
        //     var button = $(event.relatedTarget)
        //     var currentData = JSON.parse(decodeURI(button.data('current')))
        //     console.log('Data: ', currentData)
        //     deleteId = currentData.id;
        // });

        // var deleteRouteTemplate = "{{ route('employee.bank-accounts.delete', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        // $('#delete-bank-accounts-submit').click(function(e){
        //     var deleteRoute = deleteRouteTemplate.replace(encodeURI('<<id>>'), deleteId);
        //     e.preventDefault();
        //     $.ajax({
        //         url: deleteRoute,
        //         type: 'GET',
        //         data: {
        //             _token: '{{ csrf_token() }}',
        //             id: deleteId
        //         },
        //         success: function(data) {
        //             showAlert(data.success);
        //             bankAccountsTable.ajax.reload();
        //             $('#confirm-delete-bank-account-modal').modal('toggle');
        //         },
        //         error: function(xhr) {
        //             if(xhr.status == 422) {
        //                 var errors = xhr.responseJSON.errors;
        //                 console.log("Error 422: ", xhr);
        //             }
        //             console.log("Error: ", xhr);
        //         }
        //     });
        // });
    });


    // GENERAL FUNCTIONS
    function clearBankAccountModal(htmlId) {
        $(htmlId + ' #bank-code').val('');
        $(htmlId + ' #acc-no').val('');
        $(htmlId + ' #acc-status').val('');

        $(htmlId + ' #bank-code').removeClass('is-invalid');
        $(htmlId + ' #acc-no').removeClass('is-invalid');
        $(htmlId + ' #acc-status').removeClass('is-invalid');
    }

    function clearBankAccountError(htmlId) {
        $(htmlId + ' #bank-code').removeClass('is-invalid');
        $(htmlId + ' #acc-no').removeClass('is-invalid');
        $(htmlId + ' #acc-status').removeClass('is-invalid');
    }

    function showAlert(message) {
        $('#alert-container').html(`<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <span id="alert-message">${message}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>`)
    }

</script>
@append
