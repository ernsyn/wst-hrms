@extends('layouts.admin-base') 
@section('content')

@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
<div class="container">
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.pcb.add.post') }}" id="form_validate" data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="row p-3">
                            <div class="form-group row w-100">
                                    <label class="col-md-12 col-form-label">Salary*</label>
                                    <div class="col-md-12">
                                        <input id="salary" type="text" class="form-control{{ $errors->has('salary') ? ' is-invalid' : '' }}" placeholder=""
                                            name="salary" value="{{ old('salary') }}" required>
                                    </div>                            
                                </div>
                                <div class="form-group row w-100">
                                        <label class="col-md-12 col-form-label">Category*</label>
                                        <div class="col-md-12">
                                            <input id="category" type="text" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" placeholder=""
                                                name="category" value="{{ old('category') }}" required>
                                        </div>                            
                                    </div>
                                    <div class="form-group row w-100">
                                            <label class="col-md-12 col-form-label">Number Of Children**</label>
                                            <div class="col-md-12">
                                                <input id="total_children" type="text" class="form-control{{ $errors->has('total_children') ? ' is-invalid' : '' }}" placeholder=""
                                                    name="total_children" value="{{ old('total_children') }}" required>
                                            </div>                            
                                        </div>

                                        <div class="form-group row w-100">
                                                <label class="col-md-12 col-form-label">Amount**</label>
                                                <div class="col-md-12">
                                                    <input id="amount" type="text" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" placeholder=""
                                                        name="amount" value="{{ old('amount') }}" required>
                                                </div>                            
                                            </div>
                    </div>

                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                            </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
@endsection