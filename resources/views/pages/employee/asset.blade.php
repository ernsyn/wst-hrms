@extends('layouts.base')
@section('content')
<div class="container">
    <div id="alert-container">
    </div>
   
      <div class="tab-pane fade show p-3" id="nav-asset" role="tabpanel" aria-labelledby="nav-asset-tab">
    <table class="hrms-primary-data-table table w-100" id="asset-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Item Name</th>
                <th>Item Quantity</th>
                <th>Issue Date</th>
                <th>Attachment</th>
                <th>Status</th>
                
            </tr>
        </thead>
        <tbody>
                    @foreach($employeeAssets as $employeeAsset)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            {{$employeeAsset->asset_name}}
                        </td>
                        <td>
                            {{$employeeAsset->asset_quantity}}
                        </td>
                        <td>
                            {{$employeeAsset->issue_date->format('d/m/Y')}}
                        </td>
                        <td>
                            {{$employeeAsset->id}}
                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-current="{{$employeeAsset->id}}" data-target="#view-asset-popup"><i class="fa fa-eye"></i></button>
                        </td>
                        <td>
                            <span class="field-value">{!!$employeeAsset->asset_status ? AssetStatusEnum::getDescription($employeeAsset->asset_status) : '<strong>(not set)</strong>'!!}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
    </table>
</div>
<div class="modal fade" id="view-asset-popup" tabindex="-1" role="dialog" aria-labelledby="edit-asset-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-asset-popup">Asset Attachment List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form ENCTYPE="multipart/form-data" id="edit-assets-form" name="edit-assets-form">
                @csrf
                <div class="modal-body">                        
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                           

                        </div>
                    </div>
                 </div>
                <div class="modal-footer">
                    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
     $(document).ready(function() {
    $('#asset-table').DataTable();
} );
</script>
@append

