<div class="tab-pane fade show p-3" id="nav-workdays" role="tabpanel" aria-labelledby="nav-work-days">
    <table class="hrms-primary-data-table table w-100" id="working-day-table">
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
            <label class="working-day"><strong>Half Day 1 - Start of Work: </strong></label>
            <span id="half_1_start_work_time"></span>
        </div>
        <div class="col-md-4">
            <label class="working-day"><strong>Half Day 2 - Start of Work: </strong></label>
            <span id="half_2_start_work_time"></span>
        </div>
        <div class="col-md-4">
            <label class="working-day"><strong>Full Day - End of Work: </strong></label>
            <span id="end_work_time"></span>
        </div>
        <div class="col-md-4">
            <label class="working-day"><strong>Half Day 1 - End of Work: </strong></label>
            <span id="half_1_end_work_time"></span>
        </div>
        <div class="col-md-4">
            <label class="working-day"><strong>Half Day 2 - End of Work: </strong></label>
            <span id="half_2_end_work_time"></span>
        </div>
    </div>
</div>

@section('scripts')
<script>
    $("#working_time_container").hide();

    getEmployeeWorkingDaysData();

    let workingDaysTemplates = {!! App\EmployeeWorkingDay::templates()->get() !!};
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

        $.get("{{ route('employee.id.working-day.get', ['id' => $id]) }}", function(data, status){
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
                }

                if(data[0].half_1_end_work_time) {
                    $("#working_time_container #half_1_end_work_time").html(convertTime(data[0].half_1_end_work_time));
                }
                
                if(data[0].half_2_start_work_time) {
                    $("#working_time_container #half_2_start_work_time").html(convertTime(data[0].half_2_start_work_time));
                }

                if(data[0].half_2_end_work_time) {
                    $("#working_time_container #half_2_end_work_time").html(convertTime(data[0].half_2_end_work_time));
                }

                $("#working_time_container").show();
            }
            else
            {
                $("#working-day-values").html(`<td colspan="7" align="center">No Working Day is currently assigned</td>`);
                $("#working_time_container").hide();
            }
        }).fail(function() {
            $("#working-day-values").html(`<td colspan="7" align="center">No Working Day is currently assigned</td>`);
            $("#working_time_container").hide();
        });
    }


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

    function showAlert(message) {
        $('#alert-container').html(`<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <span id="alert-message">${message}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>`)
    }
</script>
@append
