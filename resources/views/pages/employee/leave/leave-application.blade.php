@extends('layouts.base') 
@section('pageTitle', 'Leave Application') 
@section('content')
<div class="p-4" id="page-leave-application">
    <div class="row">
        <div class="col-xl-8">      
            <div class="card-body-leave" >
                <div class="container-fluid">
                    <div id='calendar-leave' class="calendar-leave"></div>                        
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
                                        <button type="button" id="leave-full-day" class="btn btn-outline-primary leave-day" >Full Day</button>
                                        <button type="button" id="leave-half-day-am" class="btn btn-outline-primary leave-day" data-value="am">AM</button>
                                        <button type="button" id="leave-half-day-pm" class="btn btn-outline-primary leave-day" data-value="pm">PM</button>
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
                            <div class="form-group row" id="required-attachment">
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
                                    <button id="add-leave-request-submit" type="submit" class="btn btn-primary btn-block" disabled>Apply for
                                        <span id="total-days" class="total-days"><b>0.0</b> days</span>
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
                        <p>We have received your leave request subject to approval, thank you.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="leave-details" tabindex="-1" role="dialog" aria-labelledby="leave-details-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-report-to-label">Leave Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <div><strong>From:</strong> <span id="start-time"></span></div>
                        <div><strong>To:</strong> <span id="end-time"></span><br></div>
                        <div id="leave-info"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="can-edit-delete">
                <span id="leave-request-id" hidden></span>
                <button id="edit-leave-request-button" type="button" class="btn btn-danger">
                    Edit
                </button>
                {{-- <button id="delete-leave-request-button" type="button" class="btn btn-danger">
                    Delete
                </button> --}}
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    $(function(){
        var attachmentRequired = false;
        var workingDays = [];

        $.get("{{ route('employee.e-leave.ajax.working-days') }}", function(workingDaysData, status) {
            workingDays = workingDaysData;
            initCalendar();
        });

        function initCalendar() {
            $('#calendar-leave').fullCalendar({
                themeSystem: 'jquery-ui',
                header: {
                  left: 'prev,next today',
                  center: 'title',
                  right: 'month,agendaWeek,agendaDay,listMonth'
                },
                weekNumbers: false,
                eventLimit: true, // allow "more" link when too many events
                eventSources: [{
                    url: "{{ route('employee.e-leave.ajax.leaves', ['status' => 'new']) }}",
                    color: '#CCCCCC',
                    textColor: 'black'
                },
                {
                    url: "{{ route('employee.e-leave.ajax.leaves', ['status' => 'approved']) }}",
                    color: 'blue',
                    textColor: 'white'
                },
                {
                    url: "{{ route('employee.e-leave.ajax.leaves', ['status' => 'rejected']) }}",
                    color: 'red',
                    textColor: 'white'
                }],
                businessHours: {  
                    dow: workingDays
                },
                eventRender: function (event, element) {
                    element.attr('href', 'javascript:void(0);');
                    element.click(function() {
                        event_start = new Date(event.start);
                        event_end = event.end ? new Date(event.end) : event_start;

                        if(event.status == "new") {
                            $("#can-edit-delete").show();
                        }
                        else {
                            $("#can-edit-delete").hide();
                        }

                        $("#leave-info").text(event.title);
                        $("#start-time").text(event_start.toDateString());
                        $("#end-time").text(event_end.toDateString());
                        $("#leave-request-id").text(event.id);                    
                        $("#leave-details").modal('toggle');
                    });
                }
            });
        }       

        $.get("{{ route('employee.e-leave.ajax.types') }}", function(leaveTypeData, status) {
            $.each(leaveTypeData, function(key, leaveType){
                var leaveTypeOption = $('#templates .leave-type-option').clone();
                leaveTypeOption.data('leave-type', leaveType);
                leaveTypeOption.val(leaveType.id);
                leaveTypeOption.text(leaveType.name);
                leaveTypeOption.appendTo('#leave-types');
            });
        });

        $("#required-attachment").hide();
        $("#can-edit-delete").hide();

        $("button.leave-day").on('click', function(){
            $("button.leave-day").removeClass("selected-day");
            $(this).addClass("selected-day");
        });

        $("#edit-leave-request-button").on('click', function() {
            $("#leave-details").modal('toggle');

            let getEditLeaveRequestTemplate = '{{ route('employee.e-leave.ajax.leaves.edit', ['id' => '<<id>>']) }}';

            var getEditLeaveRequest = getEditLeaveRequestTemplate.replace(encodeURI('<<id>>'), $("#leave-request-id").text());

            $.get(getEditLeaveRequest, function(leaveRequestData, status) {
                console.log(leaveRequestData);

                $('#mode').val('edit');
            });

            // checkLeaveRequest($('#start-date').val(), $('#end-date').val());
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
            $("span.total-days").replaceWith("<span class='total-days'><b>1</b> days</span>");
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
                $("#required-attachment").show();
            }
            else {
                attachmentRequired = false;
                $("#required-attachment-label").text("Attachment");
                $("#required-attachment").hide();
            }
        });

        $('#add-leave-request-form #add-leave-request-submit').click(function(e) {
            e.preventDefault();

            var file = document.querySelector('input[name=required-attachment]').files[0];

            console.log(file);

            var data = {
                _token: '{{ csrf_token() }}',
                start_date: $('#add-leave-request-form #alt-start-date').val(),
                end_date: $('#add-leave-request-form #alt-end-date').val(),
                leave_type: $('#add-leave-request-form #leave-types').find('option:selected').val(),
                am_pm: $('#add-leave-request-form button.selected-day').data('value'),
                reason: $('#add-leave-request-form #reason').val(),
            };

            if(attachmentRequired) {
                getBase64(file, function(attachmentDataUrl) {
                    data.attachment = attachmentDataUrl;
                    postLeaveRequest(data);
                });
            } else {
                postLeaveRequest(data);
            }            
        });

        function postLeaveRequest(data) {
            $.ajax({
                url: "{{ route('employee.e-leave.ajax.request') }}",
                type: 'POST',
                data: data,
                success: function(data) {
                    $("#leave-request-response").modal('toggle');
                    $("#calendar-leave").fullCalendar('refetchEvents');
                },
                error: function(xhr) {
                    console.log("Error: ", xhr);
                }
            }); 
        }

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

                $.ajax({
                    url: "{{ route('employee.e-leave.ajax.request.check') }}",
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
    });
</script>
@append