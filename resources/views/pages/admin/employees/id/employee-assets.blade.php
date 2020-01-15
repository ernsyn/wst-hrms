@can(PermissionConstant::ADD_ASSET)
<div class="modal fade" id="add-asset-popup" tabindex="-1" role="dialog" aria-labelledby="add-bank-accounts-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-bank-accounts-label">Add Asset</h5>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" id="add-asset-form" name="add-asset-form" >
                <div class="modal-body">
                    @csrf
                     <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Item Name*</strong></label>
                            <select class="form-control{{ $errors->has('asset_name') ? ' is-invalid' : '' }}" name="asset_name" id="asset_name">
                            <option value=""></option>  
                            @foreach ($items as $item)
                                 <option value="{{ $item->item_name }}">{{ $item->item_name }}</option>
                            @endforeach
                            </select>
                            <div id="asset_name-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Quantity*</strong></label>
                            <input name="asset_quantity" type="text" class="form-control" placeholder="" value="" >
                            <div id="asset_quantity-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Specification</strong></label>
                            <textarea name="asset_spec" class="form-control" placeholder="company number, model..."value=""></textarea>
                            <div id="asset_spec-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="issue_date"><strong>Issue Date*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="issue_date" name="issue_date" class="form-control datetimepicker-input" data-target="#issue_date" autocomplete="off" placeholder="DD/MM/YYYY"/>
                                <div class="input-group-append" data-target="#issue_date" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="issue_date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Deposit</strong></label>
                            <input name="asset_deposit" type="text" class="form-control" placeholder="" value="" >
                            <div id="asset_deposit-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="return_date"><strong>Return Date</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="return_date" name="return_date" class="form-control datetimepicker-input" data-target="#return_date" autocomplete="off" placeholder="DD/MM/YYYY"/>
                                <div class="input-group-append" data-target="#return_date" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="return_date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                      <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="sold_date"><strong>Sold Date</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="sold_date"  name="sold_date" class="form-control datetimepicker-input" data-target="#sold_date" autocomplete="off" placeholder="DD/MM/YYYY"/>
                                <div class="input-group-append" data-target="#sold_date" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="return_date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Attachment</strong></label>
                            <input name="asset_attach[]" name="asset_attach" type="file" class="form-control" multiple>
                            <div id="asset_attach-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="add-asset-form-submit" type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endcan
@can(PermissionConstant::UPDATE_ASSET)
<div class="modal fade" id="edit-asset-popup" tabindex="-1" role="dialog" aria-labelledby="edit-asset-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-asset-popup">Edit Asset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form enctype="multipart/form-data" id="edit-assets-form" name="edit-assets-form">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Item Name*</strong></label>
                            <select class="form-control{{ $errors->has('asset_name') ? ' is-invalid' : '' }}" name="asset_name">
                                    <option value=""></option>
                                    @foreach ($items as $item)
                                    <option value="{{ $item->item_name }}">{{ $item->item_name }}</option>
                                    @endforeach
                            </select>
                            <div id="asset_name-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                     <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Quantity*</strong></label>
                            <input name="asset_quantity" type="text" class="form-control" placeholder="" value="" >
                            <div id="asset_quantity-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Specification</strong></label>
                            <textarea  name="asset_spec" id="asset_spec"class="form-control" placeholder="company number, model..."value=""></textarea>
                            <div id="asset_spec-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="issue_date-edit"><strong>Issued Date*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="issue_date-edit" name="issue_date-edit" class="form-control datetimepicker-input" data-target="#issue_date-edit" autocomplete="off" placeholder="DD/MM/YYYY"/>
                                <div class="input-group-append" data-target="#issue_date-edit" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="issue_date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Deposit</strong></label>
                            <input name="asset_deposit" type="text" class="form-control" placeholder="" value="" >
                            <div id="asset_deposit-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="return_date-edit"><strong>Return Date</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="return_date-edit" name="return_date-edit" class="form-control datetimepicker-input" data-target="#return_date-edit" autocomplete="off" placeholder="DD/MM/YYYY"/>
                                <div class="input-group-append" data-target="#return_date-edit" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="return_date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="sold_date-edit"><strong>Sold Date</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="sold_date-edit" name="sold_date-edit" class="form-control datetimepicker-input" data-target="#sold_date-edit" autocomplete="off" placeholder="DD/MM/YYYY"/>
                                <div class="input-group-append" data-target="#sold_date-edit" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="sold_date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label<strong>Status</strong></label>
                                <select class="form-control{{ $errors->has('asset_status') ? ' is-invalid' : '' }}" name="asset_status" id="asset_status">
                                    <option value="">Select Status</option>
                                    <option value="1" {{ old('asset_status') == 1 ? 'selected' : ''}}>Hold</option>
                                    <option value="2" {{ old('asset_status') == 2 ? 'selected' : ''}}>Return</option>
                                    <option value="3" {{ old('asset_status') == 3 ? 'selected' : ''}}>Sold</option>
                                </select>
                                <div id="asset_status-error" class="invalid-feedback"></div>
                                </div> 
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Attachment</strong></label>
                             <input name="asset_attach[]" type="file" class="form-control" multiple>
                            <div id="asset_attach-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                 </div>
                <div class="modal-footer">
                    <button id="edit-assets-submit" type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
@can(PermissionConstant::DELETE_ASSET)
{{-- DELETE ASSET --}}
<div class="modal fade" id="confirm-delete-asset-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-asset-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirm-delete-asset-label">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
            </div>
            <div class="modal-body">
                    <p>Are you sure want to delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="delete-asset-submit">Delete</button>
            </div>
        </div>
    </div>
</div>
@endcan
{{-- TABLE ASSET --}}
<div class="tab-pane fade show p-3" id="nav-asset" role="tabpanel" aria-labelledby="nav-asset-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            @can(PermissionConstant::ADD_ASSET)<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-asset-popup">
                Add Asset
            </button>@endcan
        </div>
    </div>
    <table class="hrms-primary-data-table table w-100" id="employee-assets-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Item Name</th>
                <th>Item Quantity</th>
                <th>Issue Date</th>
                <th>Status</th>
                <th>Attachment</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
@section('scripts')
<script>
    /////////date//////////
    $('#issue_date').datetimepicker({
        format: 'DD/MM/YYYY'
    });
   
    $('#issue_date').css('caret-color', 'transparent');

     $('#return_date').datetimepicker({
        format: 'DD/MM/YYYY'
    });
   
    $('#return_date').css('caret-color', 'transparent');

    $('#sold_date').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    
    $('#sold_date').css('caret-color', 'transparent');

    $('#issue_date-edit').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    
    $('#issue_date-edit').css('caret-color', 'transparent');

     $('#return_date-edit').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    
    $('#return_date-edit').css('caret-color', 'transparent');

    $('#sold_date-edit').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    
    $('#sold_date-edit').css('caret-color', 'transparent');


    ////////date//////////
    var employeeAssetsTable = $('#employee-assets-table').DataTable({
        "bInfo": true,
        "bDeferRender": true,
        "serverSide": true,
        "bStateSave": true,
        "ajax": "{{ route('admin.employees.dt.employee-assets', ['id' => $id]) }}",
        "columnDefs": [ {
            "targets": 5,
            "orderable": false
        } ],
        "columns": [{
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {  
                "data": "asset_name"
            },
            {
                "data": "asset_quantity"
            },
            {
                "data": "issue_date",
                 render: function (data, type, row, meta) 
                    {
                        return moment(data).format('DD/MM/YYYY');
                    }  
            },
            {
                "data": "asset_status",
                render: function (data, type, row, meta) 
                    {
                       switch(data) {
                       case '1': return 'Hold'; break;
                       case '2' : return 'Return'; break;
                       case '3' : return 'Sold'; break;
                       default  : return '';
            }
                    } 
            },
            { @can(PermissionConstant::VIEW_ASSET_ATTACH)
                data: 'namelink', name: 'namelink', orderable: false, searchable: false
                @endcan
            },
           
            {
                "data": null,
                render: function (data, type, row, meta) {
                    return `@can(PermissionConstant::UPDATE_ASSET)
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-asset-popup"><i class="far fa-edit"></i></button>@endcan` +
                        `@can(PermissionConstant::DELETE_ASSET)
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#confirm-delete-asset-modal"><i class="far fa-trash-alt"></i></button>@endcan`;
                }
            }
        ]
    });

    $(function(){
        // ADD
        $('#add-asset-popup').on('show.bs.modal', function (event) {
            clearEmployeeAssetError('#add-asset-form');
        });
        $('#add-asset-form #add-asset-form-submit').click(function(e){
            e.preventDefault();
             var form = document.forms.namedItem("add-asset-form");
            var formdata = new FormData(form);
            clearEmployeeAssetError('#add-asset-form');
            $.ajax({
                url: "{{ route('admin.employees.employee-assets.post', ['id' => $id]) }}",
                type: 'POST',
                contentType: false,
                processData: false,
                data:formdata,
                success: function(data) {
                    showAlert(data.success);
                    employeeAssetsTable.ajax.reload();
                    $('#add-asset-popup').modal('toggle'); 
                    clearEmployeeAssetModal('#add-asset-form');
                },
                error: function(xhr) {
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'asset_name':
                                        $('#add-asset-form select[name=asset_name]').addClass('is-invalid');
                                        $('#add-asset-form #asset_name-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'asset_quantity':
                                        $('#add-asset-form input[name=asset_quantity]').addClass('is-invalid');
                                        $('#add-asset-form #asset_quantity-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'asset_spec':
                                        $('#add-asset-form textarea[name=asset_spec]').addClass('is-invalid');
                                        $('#add-asset-form #asset_spec-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'issue_date':
                                        $('#add-asset-form input[name=issue_date]').addClass('is-invalid');
                                        $('#add-asset-form #issue_date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'return_date':
                                        $('#add-asset-form input[name=return_date]').addClass('is-invalid');
                                        $('#add-asset-form #return_date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'sold_date':
                                        $('#add-asset-form input[name=sold_date]').addClass('is-invalid');
                                        $('#add-asset-form #sold_date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'asset_deposit':
                                        $('#add-asset-form input[name=asset_deposit]').addClass('is-invalid');
                                        $('#add-asset-form #asset_deposit-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'asset_attach':
                                        $('#add-asset-form input[name=asset_attach]').addClass('is-invalid');
                                        $('#add-asset-form #asset_attach-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'asset_status':
                                        $('#add-asset-form input[name=asset_status]').addClass('is-invalid');
                                        $('#add-asset-form #asset_status-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                }
                            }
                        }
                    }
                }
            });
        });

        // EDIT
        var editId = null;
        $('#edit-asset-popup').on('show.bs.modal', function (event) {
            clearEmployeeAssetError('#edit-assets-form');
            var button = $(event.relatedTarget)
            var currentData = JSON.parse(decodeURI(button.data('current')))
            console.log('Data: ', currentData)

            editId = currentData.id;
            $('#edit-assets-form input[name=asset_quantity]').val(currentData.asset_quantity);
            $('#edit-assets-form input[name=asset_deposit]').val(currentData.asset_deposit);
            $('#edit-assets-form input[name=asset_attach]').val(currentData.asset_attach);
            $('#edit-assets-form textarea[name=asset_spec]').val(currentData.asset_spec);
            if(currentData.issue_date!=null) {
                formatIssueDate= $.datepicker.formatDate("d/mm/yy", new Date(currentData.issue_date));
                $('#edit-assets-form #issue_date-edit').val(formatIssueDate);
            } else {
                $('#edit-assets-form #issue_date-edit').val();
            }
            if(currentData.return_date!=null) {
                formatReturnDate= $.datepicker.formatDate("d/mm/yy", new Date(currentData.return_date));
                $('#edit-assets-form #return_date-edit').val(formatReturnDate);
            } else {
                $('#edit-assets-form #return_date-edit').val();
            }
           if(currentData.sold_date!=null) {
                formatSoldDate= $.datepicker.formatDate("d/mm/yy", new Date(currentData.sold_date));
                $('#edit-assets-form #sold_date-edit').val(formatSoldDate);
            } else {
                $('#edit-assets-form #sold_date-edit').val();
            }
            $('#edit-assets-form select[name=asset_status]').val(currentData.asset_status);

            
        });

        var editRouteTemplate = "{{ route('admin.employees.employee-assets.edit.post', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#edit-assets-submit').click(function(e){
            var editRoute = editRouteTemplate.replace(encodeURI('<<id>>'), editId);
            clearEmployeeAssetError('#edit-assets-form');
            e.preventDefault();
            $.ajax({
                url: editRoute,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    asset_name: $('#edit-assets-form select[name=asset_name]').val(),
                    asset_quantity: $('#edit-assets-form input[name=asset_quantity]').val(),
                    issue_date: $('#edit-assets-form #issue_date-edit').val(),
                    return_date: $('#edit-assets-form #return_date-edit').val(),
                    sold_date: $('#edit-assets-form #sold_date-edit').val(),
                    asset_spec: $('#edit-assets-form textarea[name=asset_spec]').val(),
                    asset_deposit: $('#edit-assets-form input[name=asset_deposit]').val(),
                    asset_attach: $('#edit-assets-form input[name=asset_attach]').val(),
                    asset_status: $('#edit-assets-form select[name=asset_status]').val()
                },
                success: function(data) {
                    showAlert(data.success);
                    employeeAssetsTable.ajax.reload();
                    $('#edit-asset-popup').modal('toggle');
                    //clearEmployeeAssetModal('#edit-assets-form');
                },
                error: function(xhr) {
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'asset_name':
                                        $('#edit-assets-form select[name=asset_name]').addClass('is-invalid');
                                        $('#edit-assets-form #asset_name-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'asset_quantity':
                                        $('#edit-assets-form input[name=asset_quantity]').addClass('is-invalid');
                                        $('#edit-assets-form #asset_quantity-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'asset_spec':
                                        $('#edit-assets-form textarea[name=asset_spec]').addClass('is-invalid');
                                        $('#edit-assets-form #asset_spec-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'issue_date':
                                        $('#edit-assets-form #issue_date-edit').addClass('is-invalid');
                                        $('#edit-assets-form #issue_date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'return_date':
                                        $('#edit-assets-form #return_date-edit').addClass('is-invalid');
                                        $('#edit-assets-form #return_date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'sold_date':
                                        $('#edit-assets-form #sold_date-edit').addClass('is-invalid');
                                        $('#edit-assets-form #sold_date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'asset_deposit':
                                        $('#edit-assets-form input[name=asset_deposit]').addClass('is-invalid');
                                        $('#edit-assets-form #asset_deposit-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'asset_attach':
                                        $('#edit-assets-form input[name=asset_attach]').addClass('is-invalid');
                                        $('#edit-assets-form #asset_attach-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'asset_status':
                                        $('#edit-assets-form select[name=asset_status]').addClass('is-invalid');
                                        $('#edit-assets-form #asset_status-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                }
                            }
                        }
                    }
                }
            });
        });

        // DELETE
        var deleteId = null;
        $('#confirm-delete-asset-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var currentData = JSON.parse(decodeURI(button.data('current')))
            console.log('Data: ', currentData)
            deleteId = currentData.id;
        });

        var deleteRouteTemplate = "{{ route('admin.settings.employee-assets.delete', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#delete-asset-submit').click(function(e){
            var deleteRoute = deleteRouteTemplate.replace(encodeURI('<<id>>'), deleteId);
            e.preventDefault();
            $.ajax({
                url: deleteRoute,
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: deleteId
                },
                success: function(data) {
                    showAlert(data.success);
                    employeeAssetsTable.ajax.reload();
                    $('#confirm-delete-asset-modal').modal('toggle');
                },
                error: function(xhr) {
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error 422: ", xhr);
                    }
                    console.log("Error: ", xhr);
                }
            });
        });
    });
  
    // GENERAL FUNCTIONS
    function clearEmployeeAssetModal(htmlId) {
        $(htmlId + ' input[name=asset_quantity]').val('');
        $(htmlId + ' select[name=asset_name]').val('');
        $(htmlId + ' textarea[name=asset_spec]').val('');
        $(htmlId + ' input[name=issue_date]').val('');
        $(htmlId + ' input[name=return_date]').val('');
        $(htmlId + ' input[name=sold_date]').val('');
        $(htmlId + ' input[name=asset_attach]').val('');
        $(htmlId + ' input[name=asset_deposit]').val('');
       $

        $(htmlId + ' select[name=asset_name]').removeClass('is-invalid');
        $(htmlId + ' input[name=asset_quantity]').removeClass('is-invalid');
        $(htmlId + ' textarea[name=asset_spec]').removeClass('is-invalid');
        $(htmlId + ' input[name=issue_date]').removeClass('is-invalid');
        $(htmlId + ' input[name=return_date]').removeClass('is-invalid');
        $(htmlId + ' input[name=sold_date]').removeClass('is-invalid');
        $(htmlId + ' input[name=asset_attach]').removeClass('is-invalid');
        $(htmlId + ' input[name=asset_deposit]').removeClass('is-invalid');
        
    }

    function clearEmployeeAssetError(htmlId) {
        $(htmlId + ' select[name=asset_name]').removeClass('is-invalid');
        $(htmlId + ' input[name=asset_quantity]').removeClass('is-invalid');
        $(htmlId + ' textarea[name=asset_spec]').removeClass('is-invalid');
        $(htmlId + ' input[name=issue_date]').removeClass('is-invalid');
        $(htmlId + ' input[name=return_date]').removeClass('is-invalid');
        $(htmlId + ' input[name=sold_date]').removeClass('is-invalid');
        $(htmlId + ' input[name=asset_attach]').removeClass('is-invalid');
        $(htmlId + ' input[name=asset_deposit]').removeClass('is-invalid');
        

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
