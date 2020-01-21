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
<div class="tab-pane fade show p-3" id="nav-asset" role="tabpanel" aria-labelledby="nav-asset-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            @can(PermissionConstant::ADD_ASSET)
            <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-asset-popup">
                Add Employee
            </button>
            @endcan
        </div>
    </div>
            <table class="hrms-data-table compact w-100 t-2" id="asset-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($employeeAssets as $employeeAsset)
                    <tr>
                        <td class="id">{{$loop->iteration}}</td>
                        <td class="name">
                            {{$employeeAsset->name}}
                        </td>
                         @can(PermissionConstant::VIEW_ASSET)
                       <td>
                            <button onclick="window.location='{{ route('admin.employees.assetid', ['id' => $employeeAsset->emp_id]) }}';" class="btn btn-default btn-smt fas fa-eye"></button>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="add-asset-popup" tabindex="-1" role="dialog" aria-labelledby="add-assets-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-assets-label">Add Asset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  enctype="multipart/form-data" id="add-asset-form" name="add-asset-form" >
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Employee*</strong></label>
                            <select name="emp_id" id="emp_id" class="form-control" placeholder="Select an employee...">
                                    </select>
                            <div id="emp_id-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
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
                                <input type="text" id="issue_date" name="issue_date" class="form-control datetimepicker-input" data-target="#issue_date" autocomplete="off" placeholder="DD/MM/YYYY"/ >
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
                            <input name="asset_attach[]" type="file" class="form-control" multiple>
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
    </div>
@endsection
@section('scripts')
<script type="text/javascript">
    /////////date//////////
    $('#issue_date').datetimepicker({
      format: 'DD/MM/YYYY',
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


    ////////date//////////
//////////////////ADD///////////////////////////////////////////////

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
                url: "{{ route('admin.employees.assetlist.post') }}",
                type: 'POST',
                contentType: false,
                processData: false,
                data:formdata,
                success: function(data) {
                    showAlert(data.success);
                    $('#add-asset-popup').modal('toggle'); 
                    //employeeAssetsTable.ajax.reload();
                    $('#asset-table').load(document.URL +  ' #asset-table');
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
                                    case 'emp_id':
                                        $('#add-asset-form select[name=emp_id]').addClass('is-invalid');
                                        $('#add-asset-form #emp_id-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
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
                                }
                            }
                        }
                    }
                }
            });
        });

 // GENERAL FUNCTIONS
    function clearEmployeeAssetModal(htmlId) {
        $(htmlId + ' select[name=emp_id]')[0].selectize.clear();
        $(htmlId + ' select[name=asset_name]').val('');
        $(htmlId + ' input[name=asset_quantity]').val('');
        $(htmlId + ' textarea[name=asset_spec]').val('');
        $(htmlId + ' input[name=issue_date]').val('');
        $(htmlId + ' input[name=return_date]').val('');
        $(htmlId + ' input[name=sold_date]').val('');
        $(htmlId + ' input[name=asset_attach]').val('');
        $(htmlId + ' input[name=asset_deposit]').val('');

        $(htmlId + ' select[name=emp_id]').removeClass('is-invalid');
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
        $(htmlId + ' select[name=emp_id]').removeClass('is-invalid');
        $(htmlId + ' select[name=asset_name]').removeClass('is-invalid');
        $(htmlId + ' input[name=asset_quantity]').removeClass('is-invalid');
        $(htmlId + ' textarea[name=asset_spec]').removeClass('is-invalid');
        $(htmlId + ' input[name=issue_date]').removeClass('is-invalid');
        $(htmlId + ' input[name=return_date]').removeClass('is-invalid');
        $(htmlId + ' input[name=sold_date]').removeClass('is-invalid');
        $(htmlId + ' input[name=asset_attach]').removeClass('is-invalid');
        $(htmlId + ' input[name=asset_deposit]').removeClass('is-invalid');
    }

    $(document).ready(function() {
    $('#asset-table').DataTable();
} );


        var reportToSelectizeOptions = {
            valueField: 'id',
            labelField: 'name',
            searchField: 'name',
            options: [],
            create: false,
            render: {
                option: function(item, escape) {
                    return '<div class="option">' +
                        '<span class="badge badge-warning">' + item.code +'</span>' + 
                        '&nbsp; ' + item.name +
                    '</div>';
                }
            },
            load: function(query, callback) {
                if (!query.length) return callback();
                $.ajax({
                    url: "{{ route('admin.e-leave.ajax.employees') }}",
                    type: 'GET',
                    data: {
                        q: query,
                        page_limit: 10
                    },
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        callback(res);
                    }
                });
            }
        };

        $('#add-asset-form #emp_id').selectize(reportToSelectizeOptions);
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
