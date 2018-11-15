@extends('layouts.base') 
@section('pageTitle', 'Payroll')
@section('content')

@include('pages.payroll.create')
<!-- todo: pigination, search -->
<div class="p-4">
	<div class="card p-4">
		<div class="card-body">
			<div class="row pb-3">
				<div class="col-auto mr-auto">
                    @if($errors->any())
                    	<div class="alert alert-danger alert-dismissible fade show"  role="alert">
                    	{{$errors->first()}}
                    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    	</div>
                    @endif
                    
                    @if(session()->get('success'))
                        <div class="alert alert-success alert-dismissible fade show"  role="alert">
                          {{ session()->get('success') }}  
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                      @endif
            	</div>
				<div class="col-auto">
					<button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#addPayrollPopup">Add Payroll</button>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="float-right tableTools-container"></div>
					<table
						class="table display compact table-striped table-bordered table-hover w-100"
						id="setupCompanyTable">
						<thead>
							<tr>
								<th>No</th>
								<th>Company</th>
								<th>Payroll Month</th>
								<th>Period</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($payroll as $row)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $row->name }}</td>
                    			<td>{{ DateHelper::dateWithFormat($row->year_month, 'Y-m') }}</td>
                    			<td>{{ PayrollPeriodEnum::getDescription($row->period)}}</td>
								<td>
								<a href="{{ route('payroll.show',$row->id) }}"
				title="Edit" class="btn btn-outline-primary waves-effect" role="button">Edit</a> 
				
				<form action="{{ route('payroll.status.update', ['id'=>$row->id]) }}"
					method="POST" id="update_status_form" style="display: inline;">
					
				@if ($row->status === 0)
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> <input
						type="hidden" name="status" value="1">
					<button type="submit" id="update_status"
						class="btn btn-outline-primary waves-effect inline-block" title="Lock">Lock</button>
                @else
					<input type="hidden" name="_token" value="{{ csrf_token() }}"> <input
						type="hidden" name="status" value="0">
					<button type="submit" id="update_status"
						class="btn btn-outline-primary waves-effect inline-block" title="Lock">Unlock</button>
                @endif
				</form>
				</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
