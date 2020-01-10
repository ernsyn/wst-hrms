<div class="tab-pane fade show p-3" id="nav-workdays" role="tabpanel" aria-labelledby="nav-work-days">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
    </div>
    <table class="hrms-primary-data-table table w-100" id="warking-day-table">
        <thead>
            <tr>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
                <th>Sunday</th>
            </tr>
            <tr id="working-day-values">
            </tr>
        </thead>
    </table>
    <div class="row pb-3" id="working_time_container">
        <div class="col-md-12">
            <label class="working-day"><strong><u>Working Time:</u></strong></label>
        </div>
        <div class="col-md-4">
            <label class="working-day"><strong>Full Day - Start of Work: </strong></label>
            <span id="start_work_time"></span>
        </div>
        <div class="col-md-4">
            <label class="working-day"><strong>Morning Half Day - Start of Work: </strong></label>
            <span id="half_1_start_work_time"></span>
        </div>
        <div class="col-md-4">
            <label class="working-day"><strong>Afternoon Half Day - Start of Work: </strong></label>
            <span id="half_2_start_work_time"></span>
        </div>
        <div class="col-md-4">
            <label class="working-day"><strong>Full Day - End of Work: </strong></label>
            <span id="end_work_time"></span>
        </div>
        <div class="col-md-4">
            <label class="working-day"><strong>Morning Half Day - End of Work: </strong></label>
            <span id="half_1_end_work_time"></span>
        </div>
        <div class="col-md-4">
            <label class="working-day"><strong>Afternoon Half Day - End of Work: </strong></label>
            <span id="half_2_end_work_time"></span>
        </div>
    </div>
</div>
@section('scripts')
<script>
    $("#assign-working-day-button").hide();
    $("#edit-working-day-button").hide();
    $("#working_time_container").hide();

    getEmployeeWorkingDaysData();

    let workingDaysTemplates = {!! App\EmployeeWorkingDay::templates()->get() !!};

    $.each(workingDaysTemplates, function(i) {
        $("#add-working-day-form select[name=working_day]").append($("<option data-id='" + i + "' />").val(this.id).text(this.template_name));
        $("#edit-working-day-form select[name=working_day]").append($("<option data-id='" + i + "' />").val(this.id).text(this.template_name));
    });

    setTimeout(function(){ 
        $('.timepicker').timeDropper({ format: 'HH:mm', setCurrentTime: false });
    }, 1000);

    $("#add-working-day-form select[name=working_day]").change(function() {
        var data_id = $(this).find(':selected').attr('data-id');

        $("#add-working-day-form select[name=monday]").val(workingDaysTemplates[data_id].monday);
        $("#add-working-day-form select[name=tuesday]").val(workingDaysTemplates[data_id].tuesday);
        $("#add-working-day-form select[name=wednesday]").val(workingDaysTemplates[data_id].wednesday);
        $("#add-working-day-form select[name=thursday]").val(workingDaysTemplates[data_id].thursday);
        $("#add-working-day-form select[name=friday]").val(workingDaysTemplates[data_id].friday);
        $("#add-working-day-form select[name=saturday]").val(workingDaysTemplates[data_id].saturday);
        $("#add-working-day-form select[name=sunday]").val(workingDaysTemplates[data_id].sunday);
    });

    $("#edit-working-day-form select[name=working_day]").change(function() {
        var data_id = $(this).find(':selected').attr('data-id');

        $("#edit-working-day-form select[name=monday]").val(workingDaysTemplates[data_id].monday);
        $("#edit-working-day-form select[name=tuesday]").val(workingDaysTemplates[data_id].tuesday);
        $("#edit-working-day-form select[name=wednesday]").val(workingDaysTemplates[data_id].wednesday);
        $("#edit-working-day-form select[name=thursday]").val(workingDaysTemplates[data_id].thursday);
        $("#edit-working-day-form select[name=friday]").val(workingDaysTemplates[data_id].friday);
        $("#edit-working-day-form select[name=saturday]").val(workingDaysTemplates[data_id].saturday);
        $("#edit-working-day-form select[name=sunday]").val(workingDaysTemplates[data_id].sunday);
    });

    function getEmployeeWorkingDaysData() {
        let getWorkingDayLabel = function (value) {
            switch(value) {
                case 'full':
                    return 'Full Day';
                case 'half':
                    return 'Half Day 1';
                case 'half_2':
                    return 'Half Day 2';
                case 'off':
                    return 'Off Day';
                case 'rest':
                    return 'Rest Day';
            }
        }

        $.get("{{ route('admin.employees.id.working-day.get', ['id' => $id]) }}", function(data, status){
            if(data.length > 0)
            {
                $("#working-day-values").html(`<td id="monday-value">`+getWorkingDayLabel(data[0].monday)+`</td>
                <td id="tuedsay-value">`+getWorkingDayLabel(data[0].tuesday)+`</td>
                <td id="wednesday-value">`+getWorkingDayLabel(data[0].wednesday)+`</td>
                <td id="thursday-value">`+getWorkingDayLabel(data[0].thursday)+`</td>
                <td id="friday-value">`+getWorkingDayLabel(data[0].friday)+`</td>
                <td id="saturday-value">`+getWorkingDayLabel(data[0].saturday)+`</td>
                <td id="sunday-value">`+getWorkingDayLabel(data[0].sunday)+`</td>`);

                $("#working_time_container #start_work_time").html(convertTime(data[0].start_work_time));
                $("#working_time_container #end_work_time").html(convertTime(data[0].end_work_time));

                if(data[0].half_1_start_work_time) {
                    $("#working_time_container #half_1_start_work_time").html(convertTime(data[0].half_1_start_work_time));
                    $("#edit-working-day-form input[name=half_1_start_work_time]").prop('value', data[0].half_1_start_work_time.substring(0, data[0].half_1_start_work_time.length - 3));
                }

                if(data[0].half_1_end_work_time) {
                    $("#working_time_container #half_1_end_work_time").html(convertTime(data[0].half_1_end_work_time));
                    $("#edit-working-day-form input[name=half_1_end_work_time]").prop('value', data[0].half_1_end_work_time.substring(0, data[0].half_1_end_work_time.length - 3));
                }
                
                if(data[0].half_2_start_work_time) {
                    $("#working_time_container #half_2_start_work_time").html(convertTime(data[0].half_2_start_work_time));
                    $("#edit-working-day-form input[name=half_2_start_work_time]").prop('value', data[0].half_2_start_work_time.substring(0, data[0].half_2_start_work_time.length - 3));
                }

                if(data[0].half_2_end_work_time) {
                    $("#working_time_container #half_2_end_work_time").html(convertTime(data[0].half_2_end_work_time));
                    $("#edit-working-day-form input[name=half_2_end_work_time]").prop('value', data[0].half_2_end_work_time.substring(0, data[0].half_2_end_work_time.length - 3));
                }

                $("#edit-working-day-form select[name=monday]").val(data[0].monday);
                $("#edit-working-day-form select[name=tuesday]").val(data[0].tuesday);
                $("#edit-working-day-form select[name=wednesday]").val(data[0].wednesday);
                $("#edit-working-day-form select[name=thursday]").val(data[0].thursday);
                $("#edit-working-day-form select[name=friday]").val(data[0].friday);
                $("#edit-working-day-form select[name=saturday]").val(data[0].saturday);
                $("#edit-working-day-form select[name=sunday]").val(data[0].sunday);
                $("#edit-working-day-form input[name=start_work_time]").prop('value', data[0].start_work_time.substring(0, data[0].start_work_time.length - 3));
                $("#edit-working-day-form input[name=end_work_time]").prop('value', data[0].end_work_time.substring(0, data[0].end_work_time.length - 3));

                $("#edit-working-day-form input[name=leave_id]").prop('value', data[0].id);

                $("#assign-working-day-button").hide();
                $("#edit-working-day-button").show();
                $("#working_time_container").show();
            }
            else
            {
                $("#working-day-values").html(`<td colspan="7" align="center">No Working Day is currently assigned</td>`);

                $("#assign-working-day-button").show();
                $("#edit-working-day-button").hide();
                $("#working_time_container").hide();
            }
        }).fail(function() {
            $("#working-day-values").html(`<td colspan="7" align="center">No Working Day is currently assigned</td>`);

            $("#assign-working-day-button").show();
            $("#edit-working-day-button").hide();
            $("#working_time_container").hide();
        });
    }

    $(function(){
        // ADD
       
        // EDIT
       
    });

    function convertTime(time) {
        time = time.substring(0, time.length-3);

        // Check correct time format and split into components
        time = time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

        if (time.length > 1) { // If time format correct
            time = time.slice (1);  // Remove full string match value
            time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
            time[0] = +time[0] % 12 || 12; // Adjust hours
        }

        return time.join(''); // return adjusted time or original string
    }
</script>
@append
