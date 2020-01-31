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
                            <option value="">Select Item</option>  
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
                            <input name="asset_attach[]" id="asset_attach" type="file" class="form-control" multiple>
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
            <form ENCTYPE="multipart/form-data" id="edit-assets-form" name="edit-assets-form">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="asset_name"><strong>Item Name*</strong></label>
                            <select class="form-control{{ $errors->has('asset_name') ? ' is-invalid' : '' }}" name="asset_name" id="asset_name">
                                <option value="">Select Item</option>
                                @foreach($items as $item)
                                <option value="{{ $item->item_name }}">{{ $item->item_name }}</option>
                                @endforeach
                                </select>
                        <div id="asset_name-error" class="invalid-feedback"></div>
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
                            <label for="issue_date_edit"><strong>Issued Date*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="issue_date_edit" name="issue_date_edit" class="form-control datetimepicker-input" data-target="#issue_date_edit" autocomplete="off" placeholder="DD/MM/YYYY"/>
                                <div class="input-group-append" data-target="#issue_date_edit" data-toggle="datetimepicker">
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
                            <label for="return_date_edit"><strong>Return Date</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="return_date_edit" name="return_date_edit" class="form-control datetimepicker-input" data-target="#return_date_edit" autocomplete="off" placeholder="DD/MM/YYYY"/>
                                <div class="input-group-append" data-target="#return_date_edit" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="return_date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="sold_date_edit"><strong>Sold Date</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="sold_date_edit" name="sold_date_edit" class="form-control datetimepicker-input" data-target="#sold_date_edit" autocomplete="off" placeholder="DD/MM/YYYY"/>
                                <div class="input-group-append" data-target="#sold_date_edit" data-toggle="datetimepicker">
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
                             <input name="asset_attach[]" id="asset_attach_edit" type="file" class="form-control" multiple>
                            <div id="asset_attach-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Attachment</strong></label>
                             <div id="attach">

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

<div class="modal fade" id="view-asset-popup" tabindex="-1" role="dialog" aria-labelledby="view-asset-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="view-asset-popup">View Asset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form ENCTYPE="multipart/form-data" id="view-assets-form" name="view-assets-form">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="asset_name"><strong>Item Name*</strong></label>
                            <select class="form-control{{ $errors->has('asset_name') ? ' is-invalid' : '' }}" name="asset_name" id="asset_name" readonly>
                                <option value="">Select Item</option>
                                @foreach($items as $item)
                                <option value="{{ $item->item_name }}">{{ $item->item_name }}</option>
                                @endforeach
                                </select>
                        <div id="asset_name-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                     <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Quantity*</strong></label>
                            <input name="asset_quantity" type="text" class="form-control" placeholder="" value="" readonly>
                            <div id="asset_quantity-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Specification</strong></label>
                            <textarea  name="asset_spec" id="asset_spec"class="form-control" placeholder="company number, model..."value="" readonly></textarea>
                            <div id="asset_spec-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="issue_date-view"><strong>Issued Date*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text"  name="issue_date_view" id="issue_date_view" class="form-control datetimepicker-input" data-target="#issue_date_view" autocomplete="off" placeholder="DD/MM/YYYY" readonly/>
                                <div class="input-group-append" data-target="#issue_date_view" data-toggle="datetimepicker">
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
                            <input name="asset_deposit" type="text" class="form-control" placeholder="" value="" readonly>
                            <div id="asset_deposit-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="return_date_view"><strong>Return Date</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text"  name="return_date_view" id="return_date_view" class="form-control datetimepicker-input" data-target="#return_date_view" autocomplete="off" placeholder="DD/MM/YYYY" readonly/>
                                <div class="input-group-append" data-target="#return_date_view" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="return_date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="sold_date_view"><strong>Sold Date</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" name="sold_date_view" id="sold_date_view" class="form-control datetimepicker-input" data-target="#sold_date_view" autocomplete="off" placeholder="DD/MM/YYYY" readonly/>
                                <div class="input-group-append" data-target="#sold_date_view" data-toggle="datetimepicker">
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
                                <select class="form-control{{ $errors->has('asset_status') ? ' is-invalid' : '' }}" name="asset_status" id="asset_status" readonly>
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
                             <div id="attach_view">

                             </div>
                        </div>
                    </div>
                 </div>
                <div class="modal-footer">
                    
                </div>
            </form>
        </div>
    </div>
</div>
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
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                 <div class="modal-header">
                <h5 class="modal-title" id="confirm-delete-discipline-label">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                </button>
                 </div>
                <div class="modal-body">
                    <p>Are you sure want to delete?</p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
</div>
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

    $('#issue_date_edit').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    
    $('#issue_date_edit').css('caret-color', 'transparent');

     $('#return_date_edit').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    
    $('#return_date_edit').css('caret-color', 'transparent');

    $('#sold_date_edit').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    
    $('#sold_date_edit').css('caret-color', 'transparent');


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
            {
                "data": "attach[]",
                render: function (data, type, row, meta) 
                    {
                        //console.log(data);
                        var attach = '';
                        for(i=0; i<data.length; i++) {
                            attach += '<a href="/storage/emp_id_'+{{$id}}+'/asset/'+data[i]+'" target="_blank">'+data[i]+'</a><br>';
                        }
                        return attach;
                    }  
            },
            // { "data": null,
            //     render: function (data, type, row, meta) {
            //         return `@can(PermissionConstant::UPDATE_ASSET)
            //         <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-attach-popup" id="attach"><i class="fa fa-eye"></i></button>@endcan`;
            //     }
            // },
           
            {
                "data": null,
                render: function (data, type, row, meta) {
                    return `
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#view-asset-popup"><i class="fa fa-eye"></i></button>
                    ` +`@can(PermissionConstant::UPDATE_ASSET)
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
            //console.log('>>>>>>>>>>Data: ', currentData)

            editId = currentData.id;
            $.ajax({
                url: "{{ route('admin.employees.assetattach') }}",
                type: 'GET',
                data: {
                    id: editId
                },
                error: function(xhr) {
                    console.log("Error: ", xhr);
                },
                success: function(data) {
                    //console.log(data);
                     jQuery('#attach').html('');
                    for(i=0; i<data.length; i++) {
                        var attachmentId = data[i]['id'];
                        var url = '{!! route('admin.employees.assetattach.delete', ":id") !!}';
                        url = url.replace(':id', attachmentId);   
                        $('#attach').append('<a href="/storage/emp_id_'+{{$id}}+'/asset/'+data[i]['asset_attach']+'" target="_blank">'+data[i]['asset_attach']+'</a> <a data-href="'+url+'" href="#" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a><br>');    
                    }
                   

                }
            });

            $('#edit-assets-form input[name=asset_quantity]').val(currentData.asset_quantity);
            $('#edit-assets-form #asset_name').val(currentData.asset_name);
            $('#edit-assets-form input[name=asset_deposit]').val(currentData.asset_deposit);
            $('#edit-assets-form textarea[name=asset_spec]').val(currentData.asset_spec);
            if(currentData.issue_date!=null) {
                formatIssueDate= $.datepicker.formatDate("d/mm/yy", new Date(currentData.issue_date));
                $('#edit-assets-form #issue_date_edit').val(formatIssueDate);
            } else {
                $('#edit-assets-form #issue_date_edit').val();
            }
            if(currentData.return_date!=null) {
                formatReturnDate= $.datepicker.formatDate("d/mm/yy", new Date(currentData.return_date));
                $('#edit-assets-form #return_date_edit').val(formatReturnDate);
            } else {
                $('#edit-assets-form #return_date_edit').val();
            }
           if(currentData.sold_date!=null) {
                formatSoldDate= $.datepicker.formatDate("d/mm/yy", new Date(currentData.sold_date));
                $('#edit-assets-form #sold_date_edit').val(formatSoldDate);
            } else {
                $('#edit-assets-form #sold_date_edit').val();
            }
            $('#edit-assets-form select[name=asset_status]').val(currentData.asset_status);

            
        });

        var editRouteTemplate = "{{ route('admin.employees.employee-assets.edit.post', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#edit-assets-submit').click(function(e){
            
            var editRoute = editRouteTemplate.replace(encodeURI('<<id>>'), editId);
            e.preventDefault();
             var form = document.forms.namedItem("edit-assets-form");
            var formdata = new FormData(form);
            clearEmployeeAssetError('#edit-assets-form');
            $.ajax({
                url: editRoute,
                contentType: false,
                processData: false,
                type: 'POST',
                data: formdata,
                success: function(data) {
                    showAlert(data.success);
                    employeeAssetsTable.ajax.reload();
                    $('#edit-asset-popup').modal('toggle');
                    clearEmployeeAssetModal('#edit-assets-form');
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
                                    case 'issue_date_edit':
                                        $('#edit-assets-form #issue_date_edit').addClass('is-invalid');
                                        $('#edit-assets-form #issue_date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'return_date_edit':
                                        $('#edit-assets-form #return_date_edit').addClass('is-invalid');
                                        $('#edit-assets-form #return_date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'sold_date_edit':
                                        $('#edit-assets-form #sold_date_edit').addClass('is-invalid');
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
        
        // VIEW
        var editId = null;
        $('#view-asset-popup').on('show.bs.modal', function (event) {
            clearEmployeeAssetError('#edit-assets-form');
            var button = $(event.relatedTarget)
            var currentData = JSON.parse(decodeURI(button.data('current')))
            //console.log('>>>>>>>>>>Data: ', currentData)

            editId = currentData.id;
            $.ajax({
                url: "{{ route('admin.employees.assetattach') }}",
                type: 'GET',
                data: {
                    id: editId
                },
                error: function(xhr) {
                    console.log("Error: ", xhr);
                },
                success: function(data) {
                    //console.log(data);
                     jQuery('#attach_view').html('');
                    for(i=0; i<data.length; i++) {
                       
                        $('#attach_view').append('<a href="/storage/emp_id_'+{{$id}}+'/asset/'+data[i]['asset_attach']+'" target="_blank">'+data[i]['asset_attach']+'</a><br>');    
                    }
                   

                }
            });

            $('#view-assets-form input[name=asset_quantity]').val(currentData.asset_quantity);
            $('#view-assets-form #asset_name').val(currentData.asset_name);
            $('#view-assets-form input[name=asset_deposit]').val(currentData.asset_deposit);
            $('#view-assets-form textarea[name=asset_spec]').val(currentData.asset_spec);

            if(currentData.issue_date!=null) {
                formatIssueDate= $.datepicker.formatDate("d/mm/yy", new Date(currentData.issue_date));
                $('#view-assets-form #issue_date_view').val(formatIssueDate);
            } else {
                $('#view-assets-form #issue_date_view').val();
            }

            if(currentData.return_date!=null) {
                formatReturnDate= $.datepicker.formatDate("d/mm/yy", new Date(currentData.return_date));
                $('#view-assets-form #return_date_view').val(formatReturnDate);
            } else {
                $('#view-assets-form #return_date_view').val();
            }

           if(currentData.sold_date!=null) {
                formatSoldDate= $.datepicker.formatDate("d/mm/yy", new Date(currentData.sold_date));
                $('#view-assets-form #sold_date_view').val(formatSoldDate);
            } else {
                $('#view-assets-form #sold_date_view').val();
            }

            $('#view-assets-form select[name=asset_status]').val(currentData.asset_status);

            
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
        $("#asset_attach").val(null);
        $("#asset_attach_edit").val(null);
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
   
    $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });

</script>
@append
