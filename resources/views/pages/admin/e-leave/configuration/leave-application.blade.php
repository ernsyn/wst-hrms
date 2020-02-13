@extends('layouts.admin-base')
@section('pageTitle', 'Leave Application') 
@section('content')
<div id="page-leave-application" class="container p-4">
                <div id="alert-container">
                    </div>  
    <div class="row">
        <div class="col-xl-8">      
            <div class="card-body-leave" >
                <div class="container-fluid">
                    <div id='calendar-leave' class="calendar-leave">
                        <div class="progress m-3">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>                        
                    </div> 
                    <div class="alert alert-warning" id="must-select-employee" role="alert">
                        Please select an Employee to proceed!
                    </div>
                    <div class="alert alert-danger" id="error-message-alert" role="alert" hidden></div>
                </div>               
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card calendar-leave">
                <div class="card-body-leave">
                    <div class="container-fluid">                       
                        <form enctype="multipart/form-data" id="add-leave-request-form" name="add-leave-request-form">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-12 col-form-label" id="edit-notice"></div>
                                <label class="col-sm-12 col-form-label">Employee</label>
                                <div class="col-sm-12">
                                    <select name="select-employee" id="select-employee" class="form-control" placeholder="Select an employee...">
                                    </select>
                                     <div id="emp_id-error" class="invalid-feedback">
                            </div>
                                </div>
                            </div>
                            <div class="form-group row">                                
                                <label class="col-sm-12 col-form-label">Leave Type</label>
                                <div class="col-sm-8">
                                    <select name="leave-types" id="leave-types" class="custom-select">
                                        <option selected disabled>Select Leave</option>
                                    </select> 
                                      <div id="leave_type-error" class="invalid-feedback">
                            </div>                   
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
                                        <input type="text" class="form-control" id="start-date" name="start-date"  required data-parsley-error-message="Please choose Start Date">
                                        <input type="text" class="form-control" name="alt-start-date" id="alt-start-date" hidden>
                                    </div>
                                </div>
                                <div class="col-sm-6 px-0">
                                    <label class="col-sm-12 col-form-label">End Date</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="end-date" name="end-date"   required>
                                        <input type="text" class="form-control" name="alt-end-date" id="alt-end-date" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-divider pb-3"></div>
                            <div class="form-group row" id="select-period" name="select-period">
                                <div class="col-sm-12">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="leave-full-day" name="leave-full-day" class="btn btn-outline-primary leave-day" data-value="">Full Day</button>
                                        <button type="button" id="leave-half-day-am" name="leave-half-day-am" class="btn btn-outline-primary leave-day" data-value="am">AM</button>
                                        <button type="button" id="leave-half-day-pm" name="leave-half-day-pm" class="btn btn-outline-primary leave-day" data-value="pm">PM</button>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-divider pb-3"></div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Reason</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="reason" id="reason" rows="5" placeholder="Please input your reason here..." required ></textarea>
                                      <div id="reason-error" class="invalid-feedback">
                            </div>                   
                                </div>
                            </div>
                            <div class="form-group row" id="required-child-box">
                                <div class="col-sm-12 px-0">
                                    <label class="col-sm-12 info-label"><i class="fas fa-info-circle"></i> Please key in Child's name in Reason</label>                              
                                </div>
                            </div>
                            <div class="form-group row" id="required-deceased-box">
                                <div class="col-sm-12 px-0">
                                    <label class="col-sm-12 info-label"><i class="fas fa-info-circle"></i> Please key in Deceased name and Relationship in Reason</label>                              
                                </div>
                            </div>
                             <div class="form-group row" id="required-attachment-box">
                                <div class="col-sm-12 col-form-label" ></div>
                                <label class="col-sm-12 col-form-label">Attachment</label>
                                <div class="col-sm-12">
                                     <input type="file" name="required-attachment" id="required-attachment" class="form-control-file">
                                </div>
                            </div>
                            <div class="dropdown-divider pb-3"></div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <div id="error-message" class="error-message"></div>
                                </div>
                                <div class="col-sm-12">
                                    <input type="hidden" id="mode" value="add">
                                    <input type="hidden" id="leave-request-id">
                                    <button id="add-leave-request-submit" name="add-leave-request-submit" type="submit" class="btn btn-primary btn-block" disabled>Apply for
                                        <span id="total-days" class="total-days"><b>0.0</b> days</span>
                                    </button>
                                    <button id="cancel-edit-leave-request" type="button" class="btn btn-info btn-block">
                                        Cancel Edit Leave Request
                                    </button>
                                    <div class="progress m-3" hidden>
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                                    </div>
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
    <option class="employee-option"></option>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
var leave_type_data;
    $(function(){
        var employeeSelectizeOptions = {
            valueField: 'id',
            labelField: 'name',
            searchField: ['code', 'name'],
            options: [],
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
            onChange: function(value) { 
                if(value) {
                    getWorkingDays();
                }
                else {
                    $('#must-select-employee').prop('hidden', false);
                    $('#error-message-alert').prop('hidden', true);
                    $('#calendar-leave').fullCalendar('destroy');
                }
            } 
        };

        $('#add-leave-request-form #select-employee').selectize(employeeSelectizeOptions);

        var attachmentRequired = false;
        var workingDays = [];

        $('#select-employee-box').modal('show');
        $("#required-attachment-box").hide();
        $("#required-child-box").hide();
        $("#required-deceased-box").hide();
        $("#can-edit-delete").hide();
        $("#cancel-edit-leave-request").hide();

        function getWorkingDays() {
            $('#calendar-leave .progress').attr('hidden', false);
            $('#calendar-leave').fullCalendar('destroy'); 
            $("#available_days").text('0.0');

            var employee_id = $('#select-employee').find('option:selected').val();

            let getEmployeeWorkingDaysTemplate = '{{ route('admin.e-leave.ajax.working-days', ['emp_id' => '<<emp_id>>']) }}';            

            var getEmployeeWorkingDays = getEmployeeWorkingDaysTemplate.replace(encodeURI('<<emp_id>>'), employee_id);

            $.get(getEmployeeWorkingDays, function(workingDaysData, status) {
                if(workingDaysData.error) {
                    $('#error-message-alert').text(workingDaysData.message);
                    $('#error-message-alert').prop('hidden', false);
                    $('#must-select-employee').prop('hidden', true);
                }
                else {
                    let getEmployeeJobTemplate = '{{ route('admin.e-leave.ajax.employee-job', ['emp_id' => '<<emp_id>>']) }}';

                    var getEmployeeJob = getEmployeeJobTemplate.replace(encodeURI('<<emp_id>>'), employee_id);

                    $.get(getEmployeeJob, function(employeeJob, status) {
                        if(employeeJob == 0) {
                            $('#error-message-alert').text('Employees Job is not set');
                            $('#error-message-alert').prop('hidden', false);
                            $('#must-select-employee').prop('hidden', true);
                        }
                        else {
                            workingDays = workingDaysData;
                            initCalendar();
                            loadLeaveTypes();
                            $('#error-message-alert').prop('hidden', true);
                        }
                    });
                }
            });
        }        

        function initCalendar() {
            var employee_id = $('#select-employee').find('option:selected').val();

            let getLeaveRequestsTemplate = '{{ route('admin.e-leave.ajax.employees.leave-requests', ['emp_id' => '<<emp_id>>']) }}';
            let getHolidaysTemplate = '{{ route('admin.e-leave.ajax.employee.holidays', ['emp_id' => '<<emp_id>>']) }}';

            var getLeaveRequests = getLeaveRequestsTemplate.replace(encodeURI('<<emp_id>>'), employee_id);
            var getHolidays = getHolidaysTemplate.replace(encodeURI('<<emp_id>>'), employee_id);

            $('#calendar-leave').fullCalendar({
                themeSystem: 'bootstrap4',
                header: {
                  left: 'prev,next today',
                  center: 'title',
                  right: 'month,agendaWeek,agendaDay,listMonth'
                },
                weekNumbers: false,
                eventLimit: true, // allow "more" link when too many events
                eventSources: [{
                    url: getLeaveRequests + '?status=new',
                    color: '#CCCCCC',
                    textColor: 'black'
                },
                {
                    url: getLeaveRequests + '?status=approved',
                    textColor: 'white',
                    color: '#18b775'
                },
                {
                    url: getLeaveRequests + '?status=rejected',
                    color: '#e23f3f',
                    textColor: 'white'
                },
                {
                    url: getHolidays,
                    color: '#4286f4',
                    textColor: 'white'
                }],
                businessHours: {  
                    dow: workingDays
                },
                eventRender: function (event, element) {
                    element.attr('href', 'javascript:void(0);');
                    element.click(function() {
                        event_start = new Date(event.start);
                        event_end = new Date(event.end);
                        event_end.setDate(event_end.getDate() - 1); // fix for end date showing a day later

                        if(event.status == "new") {
                            $("#can-edit-delete").show();
                        }
                        else {
                            $("#can-edit-delete").hide();
                        }

                        $("#leave-info").text(event.reason);
                        $("#start-time").text(event_start.toDateString());
                        $("#end-time").text(event_end.toDateString());
                        $("#am-pm").text(event.am_pm);
                        $("#leave-type-info").text(event.title);
                        $("#leave-id").text(event.id);                    
                        $("#leave-details").modal('toggle');
                    });
                }, 
                eventAfterAllRender: function (view) {
                    $('#calendar-leave .progress').attr('hidden', true);
                    $('#must-select-employee').attr('hidden', true);
                }
            });
        }       

        // Full day, AM, PM toggle
        $("button.leave-day").on('click', function() {
            $("button.leave-day").removeClass("selected-day");
            $(this).addClass("selected-day");

            checkLeaveRequest($('#start-date').val(), $('#end-date').val());
        });




        $("#start-date").datepicker({
            Format: 'DD/MM/YYYY',
            minDate: 0,
            onSelect: function onSelect(selectedDate) {
                $("#end-date").datepicker("option", "minDate", selectedDate);
                $('#error-message').text('');
                $('#total-days b').text('0.0');
console.log('********** admin');
console.log(leave_type_data);
console.log('**********');
if(leave_type_data.consecutive) {
	$('#end-date').val($('#start-date').val());
}
                checkLeaveRequest($('#start-date').val(), $('#end-date').val())    
            },
            onClose: function onClose() {
                $(this).parsley().validate();
            }
        });

        $('#end-date').datepicker({
            
            Format: 'DD/MM/YYYY',
           
            minDate: 0,
            onSelect: function onSelect(selectedDate) {
                $("#start-date").datepicker("option", "maxDate", selectedDate);
                $('#error-message').text('');
                $('#total-days b').text('0.0');

                checkLeaveRequest($('#start-date').val(), $('#end-date').val()); 
            },
            onClose: function onClose() {
                $(this).parsley().validate();
                checkLeaveRequest($('#start-date').val(), $('#end-date').val());
            }
        });

        // change day according to selected value
        $("#leave-half-day-am").click(function(){  
            $("span.total-days").replaceWith("<span class='total-days'><b>0.5</b> days</span>");
            $("#totalLeave").val(0.5);
        });

        $("#leave-half-day-pm").click(function(){  
            $("span.total-days").replaceWith("<span class='total-days'><b>0.5</b> days</span>");
            $("#totalLeave").val(0.5);
        });

        $("#leave-full-day").click(function(){  
            $("span.total-days").replaceWith("<span class='total-days'><b>1.0</b> days</span>");
            $("#totalLeave").val(1);
        });
        
        $('#leave-types').on('change', function() {
            console.log('on change');
            // clear start date, end date, select period, total days
            $('#start-date').val('');
            $('#end-date').val('');
            $("#select-period").show();
            $(".pb-3").show();
            $(".leave-day").removeClass("selected-day");
            $("span.total-days").replaceWith("<span class='total-days'><b>0</b> days</span>");
            
            leave_type_data = $(this).find('option:selected').data('leave-type');
            var strIndex = leave_type_data.rule.indexOf('required_attachment');
            if(strIndex == -1) {
                
                $("#required-attachment-box").hide();
            } else {
               
                $("#required-attachment-box").show();
            }
            console.log(leave_type_data);
            if(leave_type_data.code == 'COMPASSIONATE') {
                $("#required-deceased-box").show();
            }
            else {
                $("#required-deceased-box").hide();
            }
            if(leave_type_data.code == 'MATERNITY' | leave_type_data.code == 'PATERNITY') {
                $("#required-child-box").show();
            }
            else {
                $("#required-child-box").hide();
            }
            
           
            $available= leave_type_data.allocated_days - leave_type_data.spent_days;
            $("#available_days").text($available+'.0');
            $("#leave-description").text(leave_type_data.description);

            if($available == 0) {
                $("#add-leave-request-submit").prop('disabled', true);
            }
            else {
               $("#add-leave-request-submit").prop('disabled', false);
            }
        
            //click leave type then error reason  appear 
            // if(leave_type_data.reason == null) {
            //     $('#error-message').text('Attachment is required!');
            //     $('#error-message').prop('hidden', false);

            //     return false;
            // }
            console.log(leave_type_data);
        });



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

        // Load Leave Type Select Box
        function loadLeaveTypes() {
            let getLeaveTypesTemplate = '{{ route('admin.e-leave.ajax.employee.leave-types', ['emp_id' => '<<emp_id>>']) }}';

            var employee_id = $('#select-employee').find('option:selected').val();

            var getLeaveTypes = getLeaveTypesTemplate.replace(encodeURI('<<emp_id>>'), employee_id);

            $.get(getLeaveTypes, function(leaveTypeData, status) {
                console.log(leaveTypeData);
                $('#leave-types').html('<option selected disabled>Select Leave</option>');

                $.each(leaveTypeData, function(key, leaveType) {
                    var leaveTypeOption = $('#templates .leave-type-option').clone();
                    leaveTypeOption.data('leave-type', leaveType);
                    leaveTypeOption.val(leaveType.id);
                    //leaveTypeOption.text(leaveType.code);
                    leaveTypeOption.text(leaveType.name);
                    leaveTypeOption.appendTo('#leave-types');
                });
            });
        }

        



        // Validate Leave request
        function checkLeaveRequest($start_date, $end_date) {
            console.log('check leave request');
            console.log('start date: '+$start_date);
            console.log('end date: '+$end_date);
            var edit_leave_request_id;
            var mode = $('#mode').val();
            if(mode == 'edit') {
                edit_leave_request_id = $("#leave-id").text()   
            }

            $('#error-message').text('');
            
            //to display am , pm 
            if($start_date && $end_date) {
                var start = $("#start-date").datepicker("getDate");
                var end = $("#end-date").datepicker("getDate");
                var days = (end - start) / (1000 * 60 * 60 * 24) + 1;
                // var am_pm = null;
            console.log('days: '+days);
            console.log('start_date: '+$('#add-leave-request-form #alt-start-date').val());
		    console.log('end_date: '+$('#add-leave-request-form #alt-end-date').val());
                if (days > 1) {
                    $("#select-period").hide();
                    $(".pb-3").hide();
                    $(".leave-day").removeClass("selected-day");
                    $("span.total-days").replaceWith("<span class='total-days'><b>"+days+"</b> days</span>");
                    $("#totalLeave").val(days);
                } else {
                    $("#select-period").show();
                    $(".pb-3").show();
                }

                var employee_id = $('#select-employee').find('option:selected').val();

                let postCheckLeaveRequestTemplate = '{{ route('admin.e-leave.ajax.employee.leave-request.check', ['emp_id' => '<<emp_id>>']) }}';

                var postCheckLeaveRequest = postCheckLeaveRequestTemplate.replace(encodeURI('<<emp_id>>'), employee_id);                

                $.ajax({
                    url: postCheckLeaveRequest,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
//                         start_date: $('#add-leave-request-form #alt-start-date').val(),
//                         end_date: $('#add-leave-request-form #alt-end-date').val(),
						start_date: $('#add-leave-request-form #start-date').val(),
                        end_date: $('#add-leave-request-form #end-date').val(),
                        // am_pm: am_pm,
                        am_pm: $('#add-leave-request-form button.selected-day').data('value'),
                        leave_type: $('#add-leave-request-form #leave-types').find('option:selected').val(),
                        reason: $('#add-leave-request-form #reason').val(),
                        edit_leave_request_id: edit_leave_request_id,
                    },
                    success: function(data) {
                        console.log('success');
                        console.log(data);
                        console.log(data.length);
                        if(data.error) {
                            $('#error-message').text(data.message);
                            $("#add-leave-request-submit").prop('disabled', true);
                        } else {
                            $("#add-leave-request-submit").prop('disabled', false);
                        }

                        if(data.total_days) {
                            console.log('Data: '+data.total_days);
                            $('#total-days b').text(data.total_days.toFixed(1));
                            $("span.total-days").replaceWith("<span class='total-days'><b>"+data.total_days.toFixed(1)+"</b> days</span>");

                            if(data.total_days == 1) {
                                $("#leave-full-day").addClass("selected-day");
                            } else if(data.total_days > 1) {
                            	$("#select-period").hide();
                                $(".pb-3").hide();
                                $(".leave-day").removeClass("selected-day");
                            }
                        }

                        if(data.end_date) {
                            $("#end-date").val(data.end_date);
                            $("#alt-end-date").val(data.alt_end_date);
                        }

                        if(data.set_am_pm) {
                            $("button.leave-day").removeClass("selected-day");
                            $("button.leave-day").prop('disabled', false);

                            if(data.set_am_pm == "am") {
                                $("#leave-half-day-am").addClass("selected-day");
                                $("#leave-full-day").prop('disabled', true);
                                $("#leave-half-day-pm").prop('disabled', true);
                            } else if(data.set_am_pm == "pm") {
                                $("#leave-half-day-pm").addClass("selected-day");
                                $("#leave-full-day").prop('disabled', true);
                                $("#leave-half-day-am").prop('disabled', true);
                            }
                        } else {
                            $("button.leave-day").prop('disabled', false);
                        }
                    },
                    error: function(xhr) {
                        console.log("Error: ", xhr);
                    }
                });
            //////////////////////////addd//////////////////////
           var employee_id = $('#select-employee').find('option:selected').val();
           var editRouteTemplate = "{{ route('admin.e-leave.ajax.employee.leave-request.post', ['emp_id' => '<<emp_id>>']) }}";

            $('#add-leave-request-form').unbind().bind('click', function(e){
            var editRoute = editRouteTemplate.replace(encodeURI('<<emp_id>>'), employee_id);
            e.preventDefault();
            var form = document.forms.namedItem("add-leave-request-form");
            var formdata = new FormData(form);
            //clearEmployeeAssetError('#add-leave-request-form');
            $.ajax({
                url: editRoute,
                contentType: false,
                processData: false,
                type: 'POST',
                data: formdata,
                success: function(data) {
                    showAlert(data.success);
                    //$('#add-asset-popup').modal('toggle'); 
                    //employeeAssetsTable.ajax.reload();
                    //$('#asset-table').load(document.URL +  ' #asset-table');
                    //clearEmployeeAssetModal('#add-asset-form');
                },
                error: function(xhr) {
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'select-employee':
                                        $('#add-leave-request-form select[name=select-employee]').addClass('is-invalid');
                                        $('#add-leave-request-form #emp_id-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'leave_type':
                                        $('#add-leave-request-form select[name=leave_type]').addClass('is-invalid');
                                        $('#add-leave-request-form #leave_type-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'reason':
                                        $('#add-leave-request-form textarea[name=reason]').addClass('is-invalid');
                                        $('#add-leave-request-form #reason-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                     case 'total-days':
                                        $('#add-leave-request-form span[name=total-days]').addClass('is-invalid');
                                        $('#add-leave-request-form #total-days-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                   
                                }
                            }
                        }
                    }
                }
            });
    });
            }
        }

        // clear leave request form function
        function clear_leave_request_form() {
            $('#edit-notice').html('');

            $("#cancel-edit-leave-request").hide();

            $('#add-leave-request-form').trigger("reset");

            $("#available_days").text('0.0');
            $("#leave-description").text('');

            $("span.total-days").replaceWith("<span class='total-days'><b>0.0</b> days</span>");

            $('#mode').val('add');
            $("#start-date").datepicker("option", "minDate", 0);
            $("#start-date").datepicker("option", "maxDate", null);
            $("#end-date").datepicker("option", "minDate", 0);
            $("#end-date").datepicker("option", "maxDate", null);
        }

          

});

        
</script>
@append