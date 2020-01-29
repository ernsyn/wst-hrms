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
    <div id="employee-profile-card" class="card shadow-sm">
            {{-- Profile --}}
            @include('pages.admin.employees.profilecard', ['id' => $employee->id])
            {{-- Asset --}}
            @include('pages.admin.employees.id.employee-assets', ['id' => $employee->id])
        </div>
    </div>
{{-- Reset Password --}}
@can(PermissionConstant::RESET_PASSWORD)
<div class="modal fade" id="reset-password-popup" tabindex="-1" role="dialog" aria-labelledby="reset-password-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reset-password-label">Reset Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form id="reset-password-form">
                <div class="modal-body">
                    @csrf
                    {{-- <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Current Password*</strong></label>
                            <input name="current_password" type="password" class="form-control" placeholder="" value="" >
                            <div id="current-password-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div> --}}
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
                <div class="modal-footer">
                    <button id="reset-password-submit" type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan

@can(PermissionConstant::ASSIGN_ROLE)
{{-- Change Role --}}
<div class="modal fade" id="roles-popup" tabindex="-1" role="dialog" aria-labelledby="roles-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roles-label">Assign Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-3">Employee ID</div>
                    <div class="col-9">: {{$employee->code}}</div>
                </div>
                
                <div class="form-group row">
                    <div class="col-3">Name</div>
                    <div class="col-9">: {{$employee->user->name}}</div>
                </div>
                   
                <div class="form-group row">
                    <div class="col-3">Role</div>
                    <div class="col-9">
                        <select class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role" id="role">
                            <option value=""></option>  
                            @foreach ($roles as $role)
                                @if($employee->user->hasRole($role->name))
                                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                @else
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div id="role-admin-error" class="invalid-feedback">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="save-role-changes-btn" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endcan

{{-- Update picture --}}
@can(PermissionConstant::EDIT_PROFILE)
<div class="modal fade" id="edit-picture-popup" tabindex="-1" role="dialog" aria-labelledby="edit-picture-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-picture-label">Upload new profile picture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit-picture-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>New Profile Picture*</strong></label>
                            <input name="required_picture" type="file" id="picture" class="form-control-file{{ $errors->has('picture') ? ' is-invalid' : '' }}">
                            <div id="picture-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="edit-picture-submit" type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
@endsection

@section('scripts')
<script type="text/javascript">

    $(function () {
        $('#reset-password-submit').click(function(e){
            e.preventDefault();
            $(e.target).attr('disabled', true);

            $.ajax({
                url: "{{ route('admin.employees.reset-password.post', ['id' => $employee->id]) }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    new_password: $('#reset-password-form input[name=new_password]').val(),
                    confirm_new_password: $('#reset-password-form input[name=confirm_new_password]').val(),
                },
                success: function(data) {
                    if(data.success) showAlert(data.success);
                    if(data.fail) showAlertDanger(data.fail);
                    clearChangePasswordModal('#reset-password-form');
                    $('#reset-password-popup').modal('toggle');
                    $(e.target).removeAttr('disabled');
                },
                error: function(xhr) {
                    clearChangePasswordModal('#reset-password-form');
                    $(e.target).removeAttr('disabled');
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'new_password':
                                        $('#reset-password-form input[name=new_password]').addClass('is-invalid');
                                        $('#reset-password-form #new-password-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'confirm_new_password':
                                        $('#reset-password-form input[name=confirm_new_password]').addClass('is-invalid');
                                        $('#reset-password-form #current-password-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                }
                            }
                        }
                    }
                }
            });

        });

        function clearChangePasswordModal(htmlId) {
            $(htmlId + ' input[name=new_password]').val('');
            $(htmlId + ' input[name=confirm_new_password]').val('');

            $(htmlId + ' input[name=new_password]').removeClass('is-invalid');
            $(htmlId + ' input[name=confirm_new_password]').removeClass('is-invalid');
        }
        
        function clearChangePasswordError(htmlId) {
            $(htmlId + ' input[name=new_password]').removeClass('is-invalid');
            $(htmlId + ' input[name=confirm_new_password]').removeClass('is-invalid');
        }

        $('#save-role-changes-btn').click(function () {
            $.ajax({
                url: "{{ route('admin.employees.update-roles.admin.post', ['id' => $employee->id]) }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    role: $('#role').val()              
                },
                success: function(data) {
                    showAlert(data.success);
                    $('#roles-popup #role').removeClass('is-invalid');
                    $('#roles-popup').modal('toggle');
                },
                error: function(xhr) {
                    $('#roles-popup #role').addClass('is-invalid');
                    $('#roles-popup #role-admin-error').html('<strong>This is required field</strong>');
                }
            });
        });

        // EDIT Profile Picture
        $('#edit-picture-submit').click(function(e){
            clearPicturesError('#edit-picture-form');
            e.preventDefault();
            var file = document.querySelector('input[name=required_picture]').files[0];

            var data = {
                _token: '{{ csrf_token() }}'

            };

            if(file) {
                if(file.size<=2000000) {
                    console.log("File>>>",file);
                    getBase64(file, function(attachmentDataUrl) {
                        data.attachment = attachmentDataUrl;
                        postEditPicture(data);
                    });
                } else {
                    $('#edit-picture-form input[name=required_picture]').addClass('is-invalid');
                    $('#edit-picture-form #picture-error').html('<strong>The file size may not be greater than 2MB.</strong>');
                }
            }else {
                postEditPicture(data);
            }
        });

        function postEditPicture(data) {
            $.ajax({
                url: "{{ route('admin.employees.profile-pic.edit.post', ['id' => $employee->id]) }}",
                type: 'POST',
                data: data,
                success: function(data) {
                    showAlert(data.success);
                    $('#edit-picture-popup').modal('toggle');
                    $('#employee-profile-details').load(' #reload-profile1');
                    $('#nav-profile').load(' #reload-profile2');
                    // $('#navbarDropdown').load(' #reload-profile2');
                    clearPicturesModal('#edit-picture-form');
                },
                error: function(xhr) {
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'attachment':
                                        $('#edit-picture-form input[name=required_picture]').addClass('is-invalid');
                                        $('#edit-picture-form #picture-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'required_picture':
                                        $('#edit-picture-form input[name=required_picture]').addClass('is-invalid');
                                        $('#edit-picture-form #picture-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                }
                            }
                        }
                    }
                    if(xhr.status == 413) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error 413: ", xhr);
                        console.log("Error 413 status: ", xhr.statusText);
                        $('#edit-picture-form input[name=required_picture]').addClass('is-invalid');
                        $('#edit-picture-form #picture-error').html('<strong>File is too large</strong>');

                    }
                }
            });
        }
    });

    // GENERAL FUNCTIONS
    // convert attachement to base64
    function getBase64(file, onLoad) {
        var reader = new FileReader();
        reader.readAsDataURL(file);

        reader.onload = function () {
            onLoad(reader.result);
        };
        reader.onerror = function (error) {
            console.log('Error: ', error);
        };
    }

    function clearPicturesModal(htmlId) {
        $(htmlId + ' #attachment').val('');
        $(htmlId + ' #picture').val('');

        $(htmlId + ' #attachment').removeClass('is-invalid');
        $(htmlId + ' #picture').removeClass('is-invalid');
    }
    
    function clearPicturesError(htmlId) {
        $(htmlId + ' #attachment').removeClass('is-invalid');
        $(htmlId + ' #picture').removeClass('is-invalid');

    }

    function showAlert(message) {
        $('#alert-container').html(`<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <span id="alert-message">${message}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>`)
    }

</script>
<script type="text/javascript">
    $(function () {
        $("#marital-status").change(function () {
            
            if ($(this).val() == "married") {
                $("#spouse-name").removeAttr("readonly");
                $("#spouse-ic").removeAttr("readonly");
                $("#spouse-tax-no").removeAttr("readonly");
                 $("#spouse-name").focus();
            } else {
                $("#spouse-name").attr("readonly", "readonly");
                $("#spouse-ic").attr("readonly", "readonly");
                $("#spouse-tax-no").attr("readonly", "readonly");
            }
        });
    });
</script>
@append
