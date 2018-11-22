@extends('layouts.admin-base')
@section('content')
<div class="container">
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.pcb.edit.post', ['id' => $pcbs->id]) }}" id="form_validate" data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Category*</label>
                        <div class="col-md-12">
                            <input id="category" type="text" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" placeholder="Name here"
                                name="category" value="{{ $pcbs->category }}" required>
                            @if ($errors->has('category'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('category') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Salary*</label>
                        <div class="col-md-12">
                            <input id="salary" type="text" class="form-control{{ $errors->has('salary') ? ' is-invalid' : '' }}" placeholder="Name here"
                                name="salary" value="{{ $pcbs->salary }}" required>
                            @if ($errors->has('salary'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('salary') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Number Of Children*</label>
                        <div class="col-md-12">
                            <input id="total_children" type="text" class="form-control{{ $errors->has('total_children') ? ' is-invalid' : '' }}" placeholder="Name here"
                                name="total_children" value="{{ $pcbs->total_children }}" required>
                            @if ($errors->has('total_children'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('total_children') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Amount*</label>
                        <div class="col-md-12">
                            <input id="amount" type="text" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" placeholder="Name here"
                                name="amount" value="{{ $pcbs->amount }}" required>
                            @if ($errors->has('amount'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('amount') }}</strong>
                            </span>
                            @endif
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
