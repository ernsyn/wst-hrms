@extends('layouts.base') 
@section('pageTitle', 'Leave Application') 
@section('content')
<div class="p-4" id="page-leave-application">
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
                       
                        <form id="add-leave-request-form" data-parsley-validate>
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Leave Type</label>
                                <div class="col-sm-8">
                                    <select name="leave-types" id="leave-types" class="custom-select">
                                        <option selected disabled>Select Leave</option>
                                    </select>                    
                                </div>                                
                                <div class="leavedays col-sm-4"><span><b id="available_days">0.0</b> days available</span></div>
                                <div class="col-sm-12">
                                    <div id="leave-description" class="leave-description"></div>
                                </div>
                            </div>
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
                            {{-- </div> --}}
                            
                            <input type="text" class="form-control" id="totalLeave" name="totalLeave" hidden>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button id="add-leave-request-submit" type="submit" class="btn btn-primary btn-block" disabled>Apply for
                                        <span class="totaldays"><b>0.0</b> days</span>
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
<div id="templates" hidden>
    <option class="leave-type-option"></option>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    $.get("{{ route('employee.e-leave.ajax.types') }}", function(leaveTypeData, status) {
        $.each(leaveTypeData, function(key, leaveType){
            var leaveTypeOption = $('#templates .leave-type-option').clone();
            leaveTypeOption.data('leave-type', leaveType);
            leaveTypeOption.val(leaveType.id);
            leaveTypeOption.text(leaveType.name);
            leaveTypeOption.appendTo('#leave-types');
        });
    });

    $.ajax({
        url: "{{ route('employee.e-leave.ajax.request.check') }}",
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            start_date: '24-12-2018',
            end_date: '24-12-2018',
            leave_type: '10',
            am_pm: 'am'
        },
        success: function(data) {
            console.log(data);
        },
        error: function(xhr) {
            console.log("Error: ", xhr);
        }
    });

    // change day according to selected value
    $("#leave-half-day-am").click(function(){  
        $("span.totaldays").replaceWith("<span class='totaldays'><b>0.5</b> days</span>");
        $("#totalLeave").val(0.5);
    });

    $("#leave-half-day-pm").click(function(){  
        $("span.totaldays").replaceWith("<span class='totaldays'><b>0.5</b> days</span>");
        $("#totalLeave").val(0.5);
    });

    $("#leave-full-day").click(function(){  
        $("span.totaldays").replaceWith("<span class='totaldays'><b>1</b> days</span>");
        $("#totalLeave").val(1);
    });

    let getltAppliedRuleRouteTemplate = '{{ route('employee.e-leave.rules.ajax.get', ['leave_type_id' => '<<id>>']) }}';
    let getWorkingDaysRouteTemplate = '{{ route('employee.e-leave.days.ajax.get', ['start_date' => '<<start_date>>', 'end_date' => '<<end_date>>']) }}';

    var min_apply_days_before = [];
    var leave_calculation = {};
    
    $('#leave-types').on('change', function() {
        var leave_type_data = $(this).find('option:selected').data('leave-type');
        
        $("#available_days").text(leave_type_data.available_days.toFixed(1));
        $("#leave-description").text(leave_type_data.description);

        if(leave_type_data.available_days == 0) {
            $("#add-leave-request-submit").prop('disabled', true);
        }
        else {
            $("#add-leave-request-submit").prop('disabled', false);
        }

        // var getBalancesRoute = getBalancesRouteTemplate.replace(encodeURI('<<id>>'), leave_type_id);
        // var getltAppliedRuleRoute = getltAppliedRuleRouteTemplate.replace(encodeURI('<<id>>'), leave_type_id);

        // var allocated_days = 0;
        // var spent_days = 0;

        // $.get(getltAppliedRuleRoute, function(data, status) {
        //     min_apply_days_before = [];
        //     leave_calculation = {}

        //     $.each(data, function(key, value) {
        //         if(value.rule == "min_apply_days_before") {
        //             min_apply_days_before = JSON.parse(value.configuration);
        //         }
        //         else if(value.rule == "leave_calculation") {
        //             leave_calculation = JSON.parse(value.configuration);
        //         }
        //     });
        // });
    });



    $('#add-leave-request-form #add-leave-request-submit').click(function(e) {
        e.preventDefault();

        var total_days = parseFloat($('.totaldays b').html());
        var balance_days = parseFloat($("#available_days").html());
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();

        var getWorkingDaysRoute = getWorkingDaysRouteTemplate.replace(encodeURI('<<start_date>>'), startDate.split("/").join("-"));
        getWorkingDaysRoute = getWorkingDaysRoute.replace(encodeURI('<<end_date>>'), endDate.split("/").join("-"));

        $.get(getWorkingDaysRoute, function(data, status) {
            console.log('Actual Days ->', data);
        });

        var min_days_before = 0;

        var errorMsg = '';

        if(total_days > balance_days) {
            errorMsg += "You are not allowed to exceed your balance allocation of " + balance_days + ", ";
        }

        if(min_apply_days_before.length > 0) {
            $.each(min_apply_days_before, function(key, value) {
                if(total_days >= value.min_leave_days) {
                    min_days_before = value.min_apply_days_before;
                }
            });

            var today = new Date();
            var thisMonth = today.getMonth() + 1;
            var todayDate = today.getDate() + "/" + thisMonth + "/" + today.getFullYear();
            var dateDiff = dateDifference(parseDate(todayDate), parseDate(startDate));

            if(dateDiff < min_days_before) {
                errorMsg += "You need to request your leave(s) " + min_days_before + " days in advance, ";
            }
        }

        if(errorMsg) {
            console.log(errorMsg);
        }

        $.ajax({
            {{--url: "{{ route('admin.employees.working-days.post', ['id' => $id]) }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                monday: $('#add-working-day-form #monday').val(),
                tuesday: $('#add-working-day-form #tuesday').val(),
                wednesday: $('#add-working-day-form #wednesday').val(),
                thursday: $('#add-working-day-form #thursday').val(),
                friday: $('#add-working-day-form #friday').val(),
                saturday: $('#add-working-day-form #saturday').val(),
                sunday: $('#add-working-day-form #sunday').val(),
                start_work_time: $("#add-working-day-form #start_work_time").val(),
                end_work_time: $("#add-working-day-form #end_work_time").val()
            },
            success: function(data) {
                getEmployeeWorkingDaysData();
                showAlert(data.success);
                $('#add-working-day-popup').modal('toggle');
            },
            error: function(xhr) {
                if(xhr.status == 422) {
                    var errors = xhr.responseJSON.errors;
                    console.log("Error: ", xhr);

                    for (var errorField in errors) {
                        if (errors.hasOwnProperty(errorField)) {
                            console.log("Error: ", errorField);
                        }
                    }
                }

                showAlert("Oops! Operation failed, please try again.");
                $('#add-working-day-popup').modal('toggle');
            }--}}
        });
    });

    function parseDate(str) {
        var mdy = str.split('/');
        return new Date(mdy[2], mdy[1], mdy[0]);
    }

    function dateDifference(first, second) {
        // Take the difference between the dates and divide by milliseconds per day.
        // Round to nearest whole number to deal with DST.
        return Math.round((second-first)/(1000*60*60*24));
    }
</script>
@append