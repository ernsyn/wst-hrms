<nav id="sidebar">
	<div id="header-logo" class="sidebar-header text-center">
		<img src="{{asset('img/logo-oppo-white.png')}}">
	</div>

	<div id="hrms-mode-container">
		<div id="hrms-mode" class="row mx-0">
			<div id="label" class="col-4 text-center">Mode</div>
			<div id="value" class="col-8 text-center" data-toggle="collapse" href="#mode-options">
				<div class="row py-0">
					<div class="col-9 pl-2 pr-0 py-0 text-center">Super Admin</div>
					<div class="col-3 px-0 py-0">
						<i class="fas fa-angle-down"></i>
					</div>
				</div>
			</div>
		</div>
		
		<div id="mode-options" class="collapse">
			@canany(AccessControllHelper::adminPermissions())
			<div class="option row col mx-0">
				<a href="{{ route('admin.dashboard') }}"> Admin </a>
			</div>
			@endcanany 
			@canany(AccessControllHelper::employeePermissions())
			<div class="option row col mx-0">
				<a href="{{ route('employee.dashboard') }}"> Employee </a>
			</div>
			@endcanany
		</div>
	</div>
	<ul id="menu-container" class="list-unstyled">
	</ul>
</nav>