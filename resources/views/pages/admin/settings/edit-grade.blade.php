@extends('layouts.admin-base') 
@section('content')
<div class="container">
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.grades.edit.post', ['id' => $grade->id]) }}" id="form_validate" data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="form-group row w-100">
                        <div class="col-4">
                            <label class="col-md-12 col-form-label">Name*</label>
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name here"
                                    name="name" value="{{ $grade->name }}" required>
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> 
                                    @endif
                            </div>
                        </div>

                    </div>

                    {{--
                    <div class="form-group row w-100">
                    </div> --}}
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                            </button>
                <a role="button" class="btn btn-secondary" href="{{ URL::previous() }}">Close</a>
            </div>
        </form>
    </div>
</div>
@endsection