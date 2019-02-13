<nav id="navbar" class="navbar navbar-expand navbar-dark sticky-top">
    <div class="container-fluid w-100">
        <div class="float-left"><a id="btn-toggle-menu" href="#"><span class="fa fa-bars "></span></a></div>

        <div class="collapse navbar-collapse">
            <!-- Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- User Info - With Options (Right) -->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" v-pre>
                        {{-- <i class="default-user-logo-light fas fa-user-circle fa-2x px-3 align-middle"></i> --}}
                        @if (Auth::user()->hasRole('super-admin'))
                        
                        <i class="default-user-logo-light fas fa-user-circle fa-2x px-3 align-middle"></i>

                        @elseif (Auth::user()->employee->profile_media != null )
                            <img class="rounded-circle mx-3" src="data:{{Auth::user()->employee->profile_media->mimetype}};base64, {{Auth::user()->employee->profile_media->data}}"  style="object-fit:cover; width:28px; height:28px">
                        @else
                            <i class="default-user-logo-light fas fa-user-circle fa-2x px-3 align-middle"></i>
                        @endif
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @hasanyrole('employee|admin')
                        <a class="dropdown-item" href="{{ route('employee.profile') }}">
                            {{ __('Profile') }}
                        </a>
                        @endhasanyrole
                        <a href="" class="dropdown-item" data-toggle="modal" data-target="#navbar-change-password-popup">
                            {{ __('Change Password') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Change Password --}}
<div class="modal fade" id="navbar-change-password-popup" tabindex="-1" role="dialog" aria-labelledby="navbar-change-password-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="navbar-change-password-label">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form id="navbar-change-password-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Current Password*</strong></label>
                            <input name="current_password" type="password" class="form-control" placeholder="" value="" required>
                            <div id="current-password-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>New Password*</strong></label>
                            <input name="new_password" type="password" class="form-control" placeholder="" value="" required>
                            <div id="new-password-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Confirm New Password*</strong></label>
                            <input name="confirm_new_password" type="password" class="form-control" placeholder="" value="" required>
                            <div id="confirm-new-password-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="navbar-change-password-submit" type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
    $(function () {
        $('#navbar-change-password-submit').click(function(e){
            e.preventDefault();
            $(e.target).attr('disabled', true);

            $.ajax({
                url: "{{ route('auth.change-password.post', ['id' => Auth::user()->id]) }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    current_password: $('#navbar-change-password-form input[name=current_password]').val(),
                    new_password: $('#navbar-change-password-form input[name=new_password]').val(),
                    confirm_new_password: $('#navbar-change-password-form input[name=confirm_new_password]').val(),
                },
                success: function(data) {
                    if(data.success) showAlert(data.success);
                    if(data.fail) showAlertDanger(data.fail);
                    clearChangePasswordModal('#navbar-change-password-form');
                    $('#navbar-change-password-popup').modal('toggle');
                    $(e.target).removeAttr('disabled');
                },
                error: function(xhr) {
                    clearChangePasswordModal('#navbar-change-password-form');
                    $(e.target).removeAttr('disabled');
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'current_password':
                                        $('#navbar-change-password-form input[name=current_password]').addClass('is-invalid');
                                        $('#navbar-change-password-form #new-password-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'new_password':
                                        $('#navbar-change-password-form input[name=new_password]').addClass('is-invalid');
                                        $('#navbar-change-password-form #new-password-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'confirm_new_password':
                                        $('#navbar-change-password-form input[name=confirm_new_password]').addClass('is-invalid');
                                        $('#navbar-change-password-form #current-password-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                }
                            }
                        }
                    }
                }
            });

        });

        function showAlert(message) {
            $('#alert-container').html(`<div class="alert alert-primary alert-dismissible fade show" role="alert">
                <span id="alert-message">${message}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>`)
        }

        function showAlertDanger(message) {
            $('#alert-container').html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span id="alert-message">${message}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>`)
        }

        function clearChangePasswordModal(htmlId) {
            $(htmlId + ' input[name=current_password]').val('');
            $(htmlId + ' input[name=new_password]').val('');
            $(htmlId + ' input[name=confirm_new_password]').val('');

            $(htmlId + ' input[name=current_password]').removeClass('is-invalid');
            $(htmlId + ' input[name=new_password]').removeClass('is-invalid');
            $(htmlId + ' input[name=confirm_new_password]').removeClass('is-invalid');
        }
        function clearChangePasswordError(htmlId) {
            $(htmlId + ' input[name=current_password]').removeClass('is-invalid');
            $(htmlId + ' input[name=new_password]').removeClass('is-invalid');
            $(htmlId + ' input[name=confirm_new_password]').removeClass('is-invalid');
        }
    });
</script>
@append
