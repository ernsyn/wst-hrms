@extends('layouts.base') 
@section('pageTitle', 'Leave Application') 
@section('content')
{{-- <div class="row">
    <nav class="col-6 pr-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-weight-bold h3" aria-current="page">{{ ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Fallback Title' }}</li>
        </ol>
    </nav>
    <nav class="col-6 pl-0 justify-end">
        {{ Breadcrumbs::render('leaveapplication') }}
    </nav>
</div> --}}
<div class="p-4">
    <div class="row">
        <div class="col-xl-8">
            <div class="card py-4">
                <div class="card-body">
                    <div class="container-fluid">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <form id="leaveform" data-parsley-validate>
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Leave Type</label>
                                <div class="col-sm-8">
                                    <select name="type" id="type" onchange="document.getElementById('department-form').submit()" class="custom-select" required data-required-message="Please select leave type">                               
                                        <option selected disabled>Select Leave</option>
                                        @foreach($types as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4"><span><b>5</b> days available</span></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 px-0">
                                    <label class="col-sm-12 col-form-label">Start Date</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="startDate" readonly required data-parsley-error-message="Please choose Start Date">
                                        <input type="text" class="form-control" id="altStart" hidden>
                                    </div>
                                </div>
                                <div class="col-sm-6 px-0">
                                    <label class="col-sm-12 col-form-label">End Date</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="endDate" readonly required>
                                        <input type="text" class="form-control" id="altEnd" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Period</label>
                                <div class="col-sm-12">
                                    <select class="custom-select" required>
                                        <option selected disabled>Select Period</option>
                                        <option value="1">Full Day</option>
                                        <option value="2">AM</option>
                                        <option value="3">PM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Reason</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="reason" id="" rows="5" required oninvalid="this.setCustomValidity('Please Enter valid reason')"
                                        oninput="setCustomValidity('')"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Attachment</label>
                                <div class="col-sm-12">
                                    <input type="file" class="form-control-file" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-block">Apply</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		$(document).on('change','.typelist',function(){
			// console.log("hmm its change");

			var id_type_leave=$(this).val();
			// console.log(id_type_leave);
			var div=$(this).parent();

			var op=" ";

			$.ajax({
				type:'get',
				url:'{!!URL::to('findTypeLeave')!!}',
				data:{'id':id_type_leave},
				success:function(data){
					//console.log('success');

					//console.log(data);

					//console.log(data.length);
					op+='<option value="0" selected disabled>chose product</option>';
					for(var i=0;i<data.length;i++){
					op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
				   }

				   div.find('.name').html(" ");
				   div.find('.name').append(op);
				},
				error:function(){

				}
			});
		});

		$(document).on('change','.typelist',function () {
			var prod_id=$(this).val();

			var a=$(this).parent();
			console.log(prod_id);
			var op="";
			$.ajax({
				type:'get',
				url:'{!!URL::to('findPrice')!!}',
				data:{'id':prod_id},
				dataType:'json',//return data will be json
				success:function(data){
					console.log("price");
					console.log(data.price);

					// here price is coloumn name in products table data.coln name

					a.find('.prod_price').val(data.price);

				},
				error:function(){

				}
			});


		});

	});
</script>


@endsection