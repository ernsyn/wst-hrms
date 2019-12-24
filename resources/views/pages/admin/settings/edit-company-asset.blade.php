@extends('layouts.admin-base')
@section('content')
<div class="main-content">
    <div id="alert-container"></div>   
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.company-asset.edit.post', ['id' => $companyAsset->id]) }}" id="form_validate" data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                	<div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Item Code*</label>
                        <div class="col-md-4">
                            <input id="item_code" type="text" class="form-control{{ $errors->has('item_code') ? ' is-invalid' : '' }}" placeholder="Item Code"
                                name="item_code" value="{{ $companyAsset->item_code }}" required>
                            @if ($errors->has('item_code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('item_code') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Item Name*</label>
                        <div class="col-md-4">
                            <input id="item_name" type="text" class="form-control{{ $errors->has('item_name') ? ' is-invalid' : '' }}" placeholder="Item Name"
                                name="item_name" value="{{ $companyAsset->item_name }}" required>
                            @if ($errors->has('item_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('item_name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                <a role="button" class="btn btn-secondary" href="{{ route('admin.settings.company-asset') }}">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
