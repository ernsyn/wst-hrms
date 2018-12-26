@extends('layouts.admin-base')
@section('content')
<div class="container">
    <div class="card">
        <form method="POST" action="{{ route('admin.changepassword.post') }}" id="form_validate" data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="modal-body">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="name"><strong>Current Password*</strong></label>
                                <input name="current_password" type="password" class="form-control" placeholder="" value="" >
                                <div id="current-password-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="name"><strong>New Password*</strong></label>
                                <input name="new_password" type="password" class="form-control" placeholder="" value="" >
                                <div id="new-password-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="name"><strong>Confirm New Password*</strong></label>
                                <input name="confirm_new_password" type="password" class="form-control" placeholder="" value="" >
                                <div id="confirm-new-password-error" class="invalid-feedback">
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
</div>
@endsection
