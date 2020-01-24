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
           <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-asset-popup">
                Add Attachment
            </button>
        </div>
    </div>
            <table class="hrms-data-table compact w-100 t-2" id="asset-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($attachs as $attach)
                    <tr>
                        <td class="id">{{$loop->iteration}}</td>
                        <td class="name">
                            {{$attach->asset_attach}}
                        </td>
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
                <h5 class="modal-title" id="add-assets-label">Add Attachment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  enctype="multipart/form-data" id="add-asset-form" name="add-asset-form" >
                <div class="modal-body">
                    @csrf
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
<script type="text/javascript">
    /////////date//////////
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
                url: "{{ route('admin.employees.assetattach.post', ['id' => $id]) }}",
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
        $(htmlId + ' input[name=asset_attach]').val('');

        $(htmlId + ' input[name=asset_attach]').removeClass('is-invalid');
    }

    function clearEmployeeAssetError(htmlId) {
        $(htmlId + ' input[name=asset_attach]').removeClass('is-invalid');

    }

    ////////date//////////
 $(document).ready(function() {
    $('#asset-table').DataTable();
} );

function showAlert(message) {
        $('#alert-container').html(`<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <span id="alert-message">${message}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>`)
    }
$('#confirm-delete-modal').on('show.bs.modal', function (e) {
        var entryTitle = $(e.relatedTarget).data('entry-title');
        var link = $(e.relatedTarget).data('link');
        $(this).find('.modal-body p').text('Are you sure you want to delete ?');

        // Pass form reference to modal for submission on yes/ok
        var form = $(e.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirm').data('form', link);
});

$('#confirm-delete-modal').find('.modal-footer #confirm').on('click', function(){
        window.location = $(this).data('form');
});

</script>
@append
