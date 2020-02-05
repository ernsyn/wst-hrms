<!DOCTYPE html>
<html>
<head>
	<title>OPPO HRMS System Access</title>
<style>
body {
    font-family: Arial,Helvetica,sans-serif/*{ffDefault}*/;
    font-size: 1em/*{fsDefault}*/;
}

.btn {
  display: inline-block;
  font-weight: 400;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  border: 1px solid transparent;
  padding: 0.375rem 0.75rem;
  font-size: 0.9rem;
  line-height: 1.6;
  border-radius: 0.25rem;
  -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
}

@media screen and (prefers-reduced-motion: reduce) {
  .btn {
    -webkit-transition: none;
    transition: none;
  }
}

.btn:hover,
.btn:focus {
  text-decoration: none;
}

.btn:focus,
.btn.focus {
  outline: 0;
  -webkit-box-shadow: 0 0 0 0.2rem rgba(24, 183, 117, 0.25);
          box-shadow: 0 0 0 0.2rem rgba(24, 183, 117, 0.25);
}

.btn.disabled,
.btn:disabled {
  opacity: 0.65;
}

.btn:not(:disabled):not(.disabled) {
  cursor: pointer;
}

a.btn.disabled,
fieldset:disabled a.btn {
  pointer-events: none;
}

.btn-primary {
  color: #fff;
  background-color: #18b775;
  border-color: #18b775;
}

.btn-primary:hover {
  color: #fff;
  background-color: #13955f;
  border-color: #128a58;
}

.btn-primary:focus,
.btn-primary.focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(24, 183, 117, 0.5);
          box-shadow: 0 0 0 0.2rem rgba(24, 183, 117, 0.5);
}

.btn-primary.disabled,
.btn-primary:disabled {
  color: #fff;
  background-color: #18b775;
  border-color: #18b775;
}

.btn-primary:not(:disabled):not(.disabled):active,
.btn-primary:not(:disabled):not(.disabled).active,
.show > .btn-primary.dropdown-toggle {
  color: #fff;
  background-color: #128a58;
  border-color: #117f51;
}

.btn-primary:not(:disabled):not(.disabled):active:focus,
.btn-primary:not(:disabled):not(.disabled).active:focus,
.show > .btn-primary.dropdown-toggle:focus {
  -webkit-box-shadow: 0 0 0 0.2rem rgba(24, 183, 117, 0.5);
          box-shadow: 0 0 0 0.2rem rgba(24, 183, 117, 0.5);
}
</style>

</head>

<body>
	<h4>Reset Password Notification</h4>

	<p>You are receiving this email because we received a password reset request for your account.<p>

    <a href="{{URL('/password/reset/'.$token)}}" class="btn btn-primary waves-effect" target="_blank">{{__('Reset Password')}}</a>
                                
	<br>
	<p>If you did not request a password reset, no further action is required.</p>
	<br>
	<p>Regards,</p>
	<p>HRMS</p>

</body>

</html>