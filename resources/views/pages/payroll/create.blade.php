<div class="modal fade" id="addPayrollPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Payroll</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('payroll.store') }}" id="add_payroll">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <label class="col-md-5 col-form-label">Payroll Month*</label>
                            <div class="col-md-7">
                                    <input id="year_month" type="text" class="form-control{{ $errors->has('year_month') ? ' is-invalid' : '' }}"
					placeholder="YYYY-DD" name="year_month" value="{{ old('year_month') }}" required> 
				@if ($errors->has('year_month')) 
					<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('year_month') }}</strong></span> 
				@endif
                            </div> 
                            
                             

                            <label class="col-md-5 col-form-label">Period*</label>
                            <div class="col-md-7">
                                <select class="form-control" id="period" name="period">
					@foreach ($period as $k=>$v )
                        <option value="{{ $k }}" >{{ $v }}</option>
                    @endforeach
				</select>
                            </div> 
                                                         
                                                      
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
