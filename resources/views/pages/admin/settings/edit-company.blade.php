@extends('layouts.admin-base')
@section('content')
<div class="container pb-5">
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.companies.edit.post', ['id' => $company->id]) }}" id="form_validate"
            data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="form-group row w-100">
                        <div class="col-4">
                            <label class="col-md-12 col-form-label">Name*</label>
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name here"
                                    name="name" value="{{ $company->name }}" required> @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                        <div class="col-4">
                            <label class="col-md-12 col-form-label">Code*</label>
                            <div class="col-md-12">
                                <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="Code here"
                                    name="code" value="{{ $company->code }}" required> @if ($errors->has('code'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                        <div class="col-4">
                            <label class="col-md-12 col-form-label">Registration No*</label>
                            <div class="col-md-12">
                                <input id="registration_no" type="text" class="form-control{{ $errors->has('registration_no') ? ' is-invalid' : '' }}" placeholder="Registration No. here"
                                    name="registration_no" value="{{ $company->registration_no }}" required>                                @if ($errors->has('registration_no'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('registration_no') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <div class="col-8">
                            <label class="col-md-12 col-form-label">Description*</label>
                            <div class="col-md-12">
                                <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Description here"
                                    name="description" value="{{ $company->description }}" required>                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                        <div class="col-4">
                            <label class="col-md-12 col-form-label">Url*</label>
                            <div class="col-md-12">
                                <input id="url" type="text" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" placeholder="Url here" name="url"
                                    value="{{ $company->url }}" required> @if ($errors->has('url'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <div class="col-12">
                            <label class="col-md-12 col-form-label">Address*</label>
                            <div class="col-md-12">
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="Address here"
                                    name="address" value="{{ $company->address }}" required>                                @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <div class="col-6">
                            <label class="col-md-12 col-form-label">Phone*</label>
                            <div class="col-md-12">
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="Phone here"
                                    name="phone" value="{{ $company->phone }}" required> @if($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="col-md-12 col-form-label">Tax No*</label>
                            <div class="col-md-12">
                                <input id="tax_no" type="text" class="form-control{{ $errors->has('tax_no') ? ' is-invalid' : '' }}" placeholder="Tax No here"
                                    name="tax_no" value="{{ $company->tax_no }}" required> @if($errors->has('tax_no'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tax_no') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <div class="col-4">
                            <label class="col-md-12 col-form-label">EPF No*</label>
                            <div class="col-md-12">
                                <input id="epf_no" type="text" class="form-control{{ $errors->has('epf_no') ? ' is-invalid' : '' }}" placeholder="Epf No here"
                                    name="epf_no" value="{{ $company->epf_no }}" required> @if($errors->has('epf_no'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('epf_no') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                        <div class="col-4">
                            <label class="col-md-12 col-form-label">EIS No*</label>
                            <div class="col-md-12">
                                <input id="eis_no" type="text" class="form-control{{ $errors->has('eis_no') ? ' is-invalid' : '' }}" placeholder="EIS No here"
                                    name="eis_no" value="{{ $company->eis_no }}" required> @if($errors->has('eis_no'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('eis_no') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                        <div class="col-4">
                            <label class="col-md-12 col-form-label">Socso No*</label>
                            <div class="col-md-12">
                                <input id="socso_no" type="text" class="form-control{{ $errors->has('socso_no') ? ' is-invalid' : '' }}" placeholder="Socso No here"
                                    name="socso_no" value="{{ $company->socso_no }}" required>
                                @if ($errors->has('socso_no'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('socso_no') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="companyStatus">Status</label>
                                <select class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" id="companyStatus" name="status" value="{{ $company->status }}">
                                          <option>Active</option>
                                          <option>Inactive</option>
                                        </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                <a role="button" class="btn btn-secondary" href="{{ URL::previous() }}">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
