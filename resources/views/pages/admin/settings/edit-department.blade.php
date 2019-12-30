@extends('layouts.admin-base')
@section('content')
<div class="main-content">
    <div id="alert-container"></div>    
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.departments.edit.post', ['id' => $department->id]) }}" id="form_validate"
            data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Department Name*</label>
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder=""
                                name="name" value="{{ $department->name }}" required>
                            @if($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">HOD*</label>
                        <div class="col-md-12">
                        	<select name="hod[]" id="hod" class="form-control" placeholder="Select HOD" multiple required></select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                <a role="button" class="btn btn-secondary" href="{{ route('admin.settings.departments') }}">Cancel</a>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
$(function(){
	var hodIds = [
    @foreach ($hods as $hod)
    	{{ $hod->first()->id }},
    @endforeach
    ];
    
    var reportToSelectizeOptions = {
        valueField: 'id',
        labelField: 'name',
        searchField: ['code', 'name'],
        items: hodIds,
        options: [
        	@foreach ($hods as $hod)
			{ "id": "{{ $hod->first()->id }}", "name": "{{ $hod->first()->user()->first()->name }}" }, 
    		@endforeach
        ],
        create: false,
        render: {
            option: function(item, escape) {
                return '<div class="option">' +
                    '<span class="badge badge-warning">' + item.code +'</span>' + 
                    '&nbsp; ' + item.name +
                '</div>';
            }
        },
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: "{{ route('admin.e-leave.ajax.employees') }}",
                type: 'GET',
                data: {
                    q: query,
                    page_limit: 10
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res);
                }
            });
        },
    };
    
    $('#hod').selectize(reportToSelectizeOptions);

});
</script>
@append
