@extends('layouts.base') 
@section('pageTitle', 'Leave Application') 
@section('content')
<div class="p-4">
    <div class="row">
        <div class="col-xl-8">
      
                <div class="card-body-leave" >
                    <div class="container-fluid">
                        <div id='calendarleave' class="calendar-leave"></div>
                        
                    </div>
               
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card calendar-leave">
                <div class="card-body-leave">
                    <div class="container-fluid">
                       
                        <form  method="POST" action="{{ route('add_leave_application') }}" id="add_leave_application" data-parsley-validate>
                            @csrf
                            <div class="form-group row">

                                <label class="col-sm-12 col-form-label">Leave Type</label>
                                <div class="col-sm-8">
                                    <select name="type" id="type" onchange="document.getElementById('department-form').submit()" class="custom-select" >
                                    {{-- required data-required-message="Please select leave type">                                --}}
                                        <option selected disabled>Select Leave</option>
                                        {{-- @foreach($leave as $type)
                                        <option value='{"balance":{{$type['balance']}}, "id":{{$type['id']}}}'>{{$type['name']}}</option>
                                        @endforeach --}}
                                    </select>
                                    {{-- <input type="text" class="form-control" id="leaveTypeId" name="leaveTypeId" hidden>
                                    <input type="text" class="form-control" id="leaveBalance" name="leaveBalance" hidden> --}}
                                    <input type="text" class="form-control" id="leave-type-id" name="leave-type-id" hidden>
                                    <input type="text" class="form-control" id="leave-balance" name="leave-balance" hidden>
                                    
                                </div>
                                
                                <div class="leavedays col-sm-4"><span><b>0.0</b> days available</span></div>
                            </div>
                            <div class="dropdown-divider pb-3"></div>
                            <div class="form-group row">
                                <div class="col-sm-6 px-0">
                                    <label class="col-sm-12 col-form-label">Start Date</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="startDate" readonly required data-parsley-error-message="Please choose Start Date">
                                        <input type="text" class="form-control" name="altStart" id="altStart" hidden>
                                    </div>
                                </div>
                                <div class="col-sm-6 px-0">
                                    <label class="col-sm-12 col-form-label">End Date</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="endDate" readonly required>
                                        <input type="text" class="form-control" name="altEnd" id="altEnd" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-divider pb-3"></div>
                            <div class="form-group row" id="selectPeriod">
                                <div class="col-sm-12">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="leave-full-day" class="btn btn-outline-primary">Full Day</button>
                                        <button type="button" id="leave-half-day-am" class="btn btn-outline-primary">AM</button>
                                        <button type="button" id="leave-half-day-pm" class="btn btn-outline-primary">PM</button>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-divider"></div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Reason</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="reason" id="reason" rows="5" required oninvalid="this.setCustomValidity('Please Enter valid reason')"
                                        oninput="setCustomValidity('')"></textarea>
                                </div>
                            </div>
                            <div class="dropdown-divider pb-3"></div>
                            <div class="form-group row">
                                    <div class="col-sm-6 px-0">
                                        <label class="col-sm-12 col-form-label">Attachment</label>
                                 
                                    </div>
                                    <div class="col-sm-6 px-0">
                                           <input type="file" class="form-control-file">
                                        </div>
                                    </div>
                                </div>

                            
                            <input type="text" class="form-control" id="totalLeave" name="totalLeave" hidden>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-block">Apply for
                                               <span class="font-weight-bold totaldays">0.0</span> days
                                    </button>
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

});
</script>

<script>
//change day according to selected value
$('#type-balance').on('change', function() {

var txt = this.value;
var obj = JSON.parse(txt);

$( "div.leavedays" ).replaceWith( "<div class='leavedays col-sm-4'><b>"+ obj.balance +"</b> days available</span></div>" );
$("#leave-type-id").val(obj.id);
$("#leave-balance").val(obj.balance);
});
</script>
<script>
$("#leave-half-day-am").click(function(){  
    $( "span.totaldays").replaceWith( "<span class='totaldays'><b>0.5</b> days</span>" );
    $("#totalLeave").val(0.5);
});

$("#leave-half-day-pm").click(function(){  
$( "span.totaldays").replaceWith( "<span class='totaldays'><b>0.5</b> days</span>" );
$("#totalLeave").val(0.5);
});

$("#leave-full-day").click(function(){  
$( "span.totaldays").replaceWith( "<span class='totaldays'><b>1</b> days</span>" );
$("#totalLeave").val(1);
});     
</script>

@endsection