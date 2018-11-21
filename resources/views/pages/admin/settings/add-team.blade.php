@extends('layouts.admin-base') 
@section('content')
<div class="container">
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.teams.add.post') }}" id="form_validate" data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="row p-3">
                        <div class="form-group row w-100">
                            <label class="col-md-12 col-form-label">Team Name*</label>
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder=""
                                    name="name" value="{{ old('name') }}" required>
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