@extends('layouts.admin-base')
@section('content')
<div class="container">
    <div id="alert-container">
        </div>   
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.cost-centres.edit.post', ['id' => $costs->id]) }}" id="form_validate"
            data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="form-group row w-100">
                        <div class="col-4">
                            <label class="col-md-12 col-form-label">Name*</label>
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name here"
                                    name="name" value="{{ $costs->name }}" required> @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group row w-100">
                        <div class="col-12">
                            <label class="col-md-12 col-form-label">Payroll Type*</label>
                            <div class="col-md-12">
                                <select class="form-control" id="payroll_type" name="payroll_type">
                                    <option value="Regional">Regional</option>
                                    <option value="HQ">HQ</option>
                                    <option value="HQ with travel allowance">HQ with travel allowance</option>
                                </select>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                <a role="button" class="btn btn-secondary" href="{{ URL::previous() }}">Cancel</a>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
