@extends('layouts.admin-base')
@section('pageTitle', 'Leave Application') 
@section('content')
<div id="page-leave-application" class="container p-4">
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
                                <div class="col-sm-12 col-form-label" id="edit-notice"></div>
                                <label class="col-sm-12 col-form-label">Employee</label>
                                <div class="col-sm-12">
                                    <select name="select-employee" id="select-employee" class="form-control" placeholder="Select an employee...">
                                    </select>
                                </div>
                            </div>
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
                                        <input type="text" class="form-control" id="start-date" readonly required data-parsley-error-message="Please choose Start Date">
                                        <input type="text" class="form-control" name="alt-start-date" id="alt-start-date" hidden>
                                    </div>
                                </div>
                                <div class="col-sm-6 px-0">
                                    <label class="col-sm-12 col-form-label">End Date</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="end-date" readonly required>
                                        <input type="text" class="form-control" name="alt-end-date" id="alt-end-date" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-divider pb-3"></div>
                            <div class="form-group row" id="select-period">
                                <div class="col-sm-12">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="leave-full-day" class="btn btn-outline-primary leave-day" data-value="">Full Day</button>
                                        <button type="button" id="leave-half-day-am" class="btn btn-outline-primary leave-day" data-value="am">AM</button>
                                        <button type="button" id="leave-half-day-pm" class="btn btn-outline-primary leave-day" data-value="pm">PM</button>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Reason</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="reason" id="reason" rows="5" placeholder="Please input your reason here..." required></textarea>
                                </div>
                            </div>
                            <div class="dropdown-divider pb-3"></div>
                            <div class="form-group row" id="required-attachment-box">
                                <div class="col-sm-6 px-0">
                                    <label class="col-sm-12 col-form-label" id="required-attachment-label">Attachment</label>                                 
                                </div>
                                <div class="col-sm-6 px-0">
                                    <input type="file" name="required-attachment" class="form-control-file">
                                </div>
                            </div>
                            {{-- </div> --}}
                            
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <div id="error-message" class="error-message"></div>
                                </div>
                                <div class="col-sm-12">
                                    <input type="hidden" id="mode" value="add">
                                    <input type="hidden" id="leave-request-id">
                                    <button id="add-leave-request-submit" type="submit" class="btn btn-primary btn-block" disabled>Apply for
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
<div class="modal fade" id="leave-request-response" tabindex="-1" role="dialog" aria-labelledby="leave-request-response-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-report-to-label">Leave Request Accepted</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <p>We have successfully added your leave request. Pending approval.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="leave-details" tabindex="-1" role="dialog" aria-labelledby="leave-details-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header details-label">
                <h5 class="modal-title">Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <div><strong>Type:</strong> <span id="leave-type-info"></span></div>
                        <div>
                            <strong>From:</strong> <span id="start-time"></span> 
                            <strong>To:</strong> <span id="end-time"></span>
                        </div>
                        <div><strong>Period:</strong> <span id="am-pm"></span></div>
                        <div id="leave-info"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="can-edit-delete">
                <span id="leave-id" hidden></span>
                <button id="edit-leave-request-button" type="button" class="btn btn-primary">
                    Edit
                </button>
                <ANY data-toggle="modal" id="open-cancel-leave-request" data-target="#cancel-leave-request" class="btn btn-danger" data-dismiss="modal">
                    Cancel
                </ANY>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="cancel-leave-request" tabindex="-1" role="dialog" aria-labelledby="cancel-leave-request-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-report-to-label">Cancel Leave</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        Are you sure you want to cancel this leave request?
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span id="cancel-leave-id" hidden></span>
                <button id="cancel-leave-request-button" type="button" class="btn btn-primary">
                    Confirm
                </button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    $(function(){
        var reportToSelectizeOptions = {
            valueField: 'id',
            labelField: 'name',
            searchField: 'name',
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
                getWorkingDays();
            } 
        };

        $('#add-leave-request-form #select-employee').selectize(reportToSelectizeOptions);

        var attachmentRequired = false;
        var workingDays = [];

        $('#select-employee-box').modal('show');
        $("#required-attachment-box").hide();
        $("#can-edit-delete").hide();
        $("#cancel-edit-leave-request").hide();

        function getWorkingDays() {
            $('#calendar-leave .progress').attr('hidden', false);
            $('#calendar-leave').fullCalendar('destroy'); 

            let getEmployeeWorkingDaysTemplate = '{{ route('admin.e-leave.ajax.working-days', ['emp_id' => '<<emp_id>>']) }}';

            var employee_id = $('#select-employee').find('option:selected').val();

            var getEmployeeWorkingDays = getEmployeeWorkingDaysTemplate.replace(encodeURI('<<emp_id>>'), employee_id);

            $.get(getEmployeeWorkingDays, function(workingDaysData, status) {
                workingDays = workingDaysData;
                initCalendar();
                loadLeaveTypes();
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
        });

        // Enable Edit Mode and Load Form Data
        $("#edit-leave-request-button").on('click', function() {
            $("#leave-details").modal('toggle');

            let getEditLeaveRequestTemplate = '{{ route('admin.e-leave.ajax.leave-request.edit', ['id' => '<<id>>']) }}';

            var getEditLeaveRequest = getEditLeaveRequestTemplate.replace(encodeURI('<<id>>'), $("#leave-id").text());

            $.get(getEditLeaveRequest, function(leaveRequestData, status) { 
                var startDate = leaveRequestData.start_date.split("-");
                var startDateNew = startDate[2] + "-" + startDate[1] + "-" + startDate[0];

                var endDate = leaveRequestData.end_date.split("-");
                var endDateNew = endDate[2] + "-" + endDate[1] + "-" + endDate[0];

                $('#edit-notice').html(`<div class="alert alert-info" role="alert">
                    <strong>Edit:</strong> Leave Request
                </div>`);

                $("#cancel-edit-leave-request").show();

                $('#add-leave-request-form #leave-request-id').val(leaveRequestData.id);
                $('#add-leave-request-form #start-date').val(startDateNew); 
                $('#add-leave-request-form #end-date').val(endDateNew);               
                $('#add-leave-request-form #alt-start-date').val(leaveRequestData.start_date);
                $('#add-leave-request-form #alt-end-date').val(leaveRequestData.end_date);
                $('#add-leave-request-form #leave-types').val(leaveRequestData.leave_type_id);
                // $('#add-leave-request-form button.selected-day').data('value');
                $('#add-leave-request-form #reason').val(leaveRequestData.reason);
                $("span.total-days").replaceWith("<span class='total-days'><b>" + leaveRequestData.applied_days + "</b> days</span>");

                var leave_type_data = $('#add-leave-request-form #leave-types').find('option:selected').data('leave-type');
            
                $("#available_days").text(leave_type_data.available_days.toFixed(1));
                $("#leave-description").text(leave_type_data.description);

                if(leave_type_data.available_days == 0) {
                    $("#add-leave-request-submit").prop('disabled', true);
                }
                else {
                    $("#add-leave-request-submit").prop('disabled', false);
                }

                if(leave_type_data.required_attachment) {
                    attachmentRequired = true;
                    $("#required-attachment-label").text(leave_type_data.attachment_type + " Attachment");
                    $("#required-attachment-box").show();
                }
                else {
                    attachmentRequired = false;
                    $("#required-attachment-label").text("Attachment");
                    $("#required-attachment-box").hide();
                }

                $('#mode').val('edit');
            });
        });

        // Cancel Edit Mode
        $("#cancel-edit-leave-request").on('click', function() {
            clear_leave_request_form();
        });

        // Cancel Leave Request
        $('#cancel-leave-request-button').on('click', function() {
            $("#cancel-leave-id").text($("#leave-id").text());

            let cancelLeaveRequestTemplate = '{{ route('admin.e-leave.ajax.leave-request.delete', ['id' => '<<id>>']) }}';

            var cancelLeaveRequest = cancelLeaveRequestTemplate.replace(encodeURI('<<id>>'), $("#cancel-leave-id").text());

            $.ajax({
                url: cancelLeaveRequest,
                success: function(data) {
                    $("#cancel-leave-request").modal('toggle');
                    $("#calendar-leave").fullCalendar('refetchEvents');

                    clear_leave_request_form();
                    loadLeaveTypes();
                },
                error: function(xhr) {
                    console.log("Error: ", xhr);
                }
            }); 
        });

        $("#start-date").datepicker({
            altField: "#alt-start-date",
            altFormat: 'yy-mm-dd',
            dateFormat: 'dd-mm-yy',
            minDate: 0,
            onSelect: function onSelect(selectedDate) {
                $("#end-date").datepicker("option", "minDate", selectedDate);
                $('#error-message').text('');
                $('#total-days b').text('0.0');

                checkLeaveRequest($('#start-date').val(), $('#end-date').val())    
            },
            onClose: function onClose() {
                $(this).parsley().validate();
            }
        });

        $('#end-date').datepicker({
            altField: "#alt-end-date",
            altFormat: 'yy-mm-dd',
            dateFormat: 'dd-mm-yy',
            minDate: 0,
            onSelect: function onSelect(selectedDate) {
                $("#start-date").datepicker("option", "maxDate", selectedDate);
                $('#error-message').text('');
                $('#total-days b').text('0.0');

                checkLeaveRequest($('#start-date').val(), $('#end-date').val()); 
            },
            onClose: function onClose() {
                $(this).parsley().validate();
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
            var leave_type_data = $(this).find('option:selected').data('leave-type');
            
            $("#available_days").text(leave_type_data.available_days.toFixed(1));
            $("#leave-description").text(leave_type_data.description);

            if(leave_type_data.available_days == 0) {
                $("#add-leave-request-submit").prop('disabled', true);
            }
            else {
                $("#add-leave-request-submit").prop('disabled', false);
            }

            if(leave_type_data.required_attachment) {
                attachmentRequired = true;
                $("#required-attachment-label").text(leave_type_data.attachment_type + " Attachment");
                $("#required-attachment-box").show();
            }
            else {
                attachmentRequired = false;
                $("#required-attachment-label").text("Attachment");
                $("#required-attachment-box").hide();
            }

            console.log(leave_type_data);
        });

        // submit leave request ) (add/edit mode)
        $('#add-leave-request-form #add-leave-request-submit').click(function(e) {
            e.preventDefault();

            $('#add-leave-request-form .progress').attr('hidden', false);

            var file = document.querySelector('input[name=required-attachment]').files[0];

            console.log(file);

            if($("#mode").val() == "add") {
                var data = {
                    _token: '{{ csrf_token() }}',
                    start_date: $('#add-leave-request-form #alt-start-date').val(),
                    end_date: $('#add-leave-request-form #alt-end-date').val(),
                    leave_type: $('#add-leave-request-form #leave-types').find('option:selected').val(),
                    am_pm: $('#add-leave-request-form button.selected-day').data('value'),
                    reason: $('#add-leave-request-form #reason').val() ? $('#add-leave-request-form #reason').val() : 'none',
                };

                if(attachmentRequired) {
                    getBase64(file, function(attachmentDataUrl) {
                        data.attachment = attachmentDataUrl;
                        postLeaveRequest(data);
                    });
                } else {
                    postLeaveRequest(data);
                }  
            } else if($("#mode").val() == "edit") {
                var data = {
                    _token: '{{ csrf_token() }}',
                    start_date: $('#add-leave-request-form #alt-start-date').val(),
                    end_date: $('#add-leave-request-form #alt-end-date').val(),
                    leave_type: $('#add-leave-request-form #leave-types').find('option:selected').val(),
                    am_pm: $('#add-leave-request-form button.selected-day').data('value'),
                    reason: $('#add-leave-request-form #reason').val() ? $('#add-leave-request-form #reason').val() : 'none',
                };

                if(attachmentRequired) {
                    getBase64(file, function(attachmentDataUrl) {
                        data.attachment = attachmentDataUrl;
                        postEditLeaveRequest(data);
                    });
                } else {
                    postEditLeaveRequest(data);
                }
            }          
        });

        // Add leave request function
        function postLeaveRequest(data) {
            var employee_id = $('#select-employee').find('option:selected').val();

            let postLeaveRequestsTemplate = '{{ route('admin.e-leave.ajax.employee.leave-request.post', ['emp_id' => '<<emp_id>>']) }}';

            var postLeaveRequests = postLeaveRequestsTemplate.replace(encodeURI('<<emp_id>>'), employee_id);

            $.ajax({
                url: postLeaveRequests,
                type: 'POST',
                data: data,
                success: function(data) {
                    $("#leave-request-response").modal('toggle');
                    $("#calendar-leave").fullCalendar('refetchEvents');

                    clear_leave_request_form();
                    loadLeaveTypes();
                    $('#add-leave-request-form .progress').attr('hidden', true);
                },
                error: function(xhr) {
                    console.log("Error: ", xhr);
                }
            }); 
        }

        // Update leave request function
        function postEditLeaveRequest(data) {
            let postEditLeaveRequestTemplate = '{{ route('admin.e-leave.ajax.leave-request.edit.post', ['id' => '<<id>>']) }}';

            var postEditLeaveRequest = postEditLeaveRequestTemplate.replace(encodeURI('<<id>>'), $("#leave-request-id").val());

            $.ajax({
                url: postEditLeaveRequest,
                type: 'POST',
                data: data,
                success: function(data) {
                    $("#leave-request-response").modal('toggle');
                    $("#calendar-leave").fullCalendar('refetchEvents');

                    clear_leave_request_form();
                    loadLeaveTypes();
                    $('#add-leave-request-form .progress').attr('hidden', true);
                },
                error: function(xhr) {
                    console.log("Error: ", xhr);
                }
            }); 
        }

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
                $('#leave-types').html('<option selected disabled>Select Leave</option>');

                $.each(leaveTypeData, function(key, leaveType) {
                    var leaveTypeOption = $('#templates .leave-type-option').clone();
                    leaveTypeOption.data('leave-type', leaveType);
                    leaveTypeOption.val(leaveType.id);
                    leaveTypeOption.text(leaveType.name);
                    leaveTypeOption.appendTo('#leave-types');
                });
            });
        }

        // Validate Leave request
        function checkLeaveRequest($start_date, $end_date) {
            if($start_date && $end_date) {
                var start = $("#start-date").datepicker("getDate");
                var end = $("#end-date").datepicker("getDate");
                var days = (end - start) / (1000 * 60 * 60 * 24) + 1;

                if (days > 1) {
                    $("#select-period").hide();
                } else {
                    $("#select-period").show();
                }

                var employee_id = $('#select-employee').find('option:selected').val();

                let postCheckLeaveRequestTemplate = '{{ route('admin.e-leave.ajax.employee.leave-request.check', ['emp_id' => '<<emp_id>>']) }}';

                var postCheckLeaveRequest = postCheckLeaveRequestTemplate.replace(encodeURI('<<emp_id>>'), employee_id);                

                $.ajax({
                    url: postCheckLeaveRequest,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        start_date: $('#add-leave-request-form #start-date').val(),
                        end_date: $('#add-leave-request-form #end-date').val(),
                        leave_type: $('#add-leave-request-form #leave-types').find('option:selected').val()
                    },
                    success: function(data) {
                        if(data.error) {
                            $('#error-message').text(data.message);
                        }

                        if(data.total_days) {
                            $('#total-days b').text(data.total_days.toFixed(1));
                        }
                    },
                    error: function(xhr) {
                        console.log("Error: ", xhr);
                    }
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
        }
    });
</script>
@append