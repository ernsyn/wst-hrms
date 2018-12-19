<div class="tab-pane fade show p-3" id="nav-workdays" role="tabpanel" aria-labelledby="nav-work-days">
    {{-- <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <button type="button" class="btn btn-outline-info waves-effect" id="assign-working-day-button" data-toggle="modal" data-target="#add-working-day-popup">
                Assign Working Day
            </button>
            <button type="button" class="btn btn-outline-info waves-effect" id="edit-working-day-button" data-toggle="modal" data-target="#edit-working-day-popup">
                Edit Working Day
            </button>
        </div>
    </div> --}}
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
        <div class="col-md-12">
            <label class="working-day"><strong>Start of Work: </strong></label>
            <span id="start_work_time"></span>
        </div>
        <div class="col-md-12">
            <label class="working-day"><strong>End of Work: </strong></label>
            <span id="end_work_time"></span>
        </div>
    </div>
</div>

{{-- ADD --}}
<div class="modal fade" id="add-working-day-popup" tabindex="-1" role="dialog" aria-labelledby="add-working-day-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-report-to-label">Assign Working Day</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-working-day-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label class="working-day"><strong>Template</strong></label>
                            <select class="form-control{{ $errors->has('departments') ? ' is-invalid' : '' }}" name="working_day" id="working_day">
                                <option>Select a Template</option>
                            </select>
                            <div id="working-day-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="monday"><strong>Monday*</strong></label>
                            <input id="monday" type="number" min="0" max="1" step="0.5" class="form-control{{ $errors->has('monday') ? ' is-invalid' : '' }}" placeholder="" name="monday" value="" readonly>
                            <div id="monday-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="tuesday"><strong>Tuesday*</strong></label>
                            <input id="tuesday" type="number" min="0" max="1" step="0.5" class="form-control{{ $errors->has('tuesday') ? ' is-invalid' : '' }}" placeholder="" name="tuesday" value="" readonly>
                            <div id="tuesday-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="wednesday"><strong>Wednesday*</strong></label>
                            <input id="wednesday" type="number" min="0" max="1" step="0.5" class="form-control{{ $errors->has('wednesday') ? ' is-invalid' : '' }}" placeholder="" name="wednesday" value="" readonly>
                            <div id="wednesday-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="thursday"><strong>Thursday*</strong></label>
                            <input id="thursday" type="number" min="0" max="1" step="0.5" class="form-control{{ $errors->has('thursday') ? ' is-invalid' : '' }}" placeholder="" name="thursday" value="" readonly>
                            <div id="thursday-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="friday"><strong>Friday*</strong></label>
                            <input id="friday" type="number" min="0" max="1" step="0.5" class="form-control{{ $errors->has('friday') ? ' is-invalid' : '' }}" placeholder="" name="friday" value="" readonly>
                            <div id="friday-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="saturday"><strong>Saturday*</strong></label>
                            <input id="saturday" type="number" min="0" max="1" step="0.5" class="form-control{{ $errors->has('saturday') ? ' is-invalid' : '' }}" placeholder="" name="saturday" value="" readonly>
                            <div id="saturday-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="sunday"><strong>Sunday*</strong></label>
                            <input id="sunday" type="number" min="0" max="1" step="0.5" class="form-control{{ $errors->has('sunday') ? ' is-invalid' : '' }}" placeholder="" name="sunday" value="" readonly>
                            <div id="sunday-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="start_work_time"><strong>Start of Work*</strong></label>
                            <input id="start_work_time" type="text" class="form-control{{ $errors->has('start_work_time') ? ' is-invalid' : '' }} timepicker" placeholder="" name="start_work_time" value="" readonly>
                            <div id="start_work_time-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="end_work_time"><strong>End of Work*</strong></label>
                            <input id="end_work_time" type="text" class="form-control{{ $errors->has('end_work_time') ? ' is-invalid' : '' }} timepicker" placeholder="" name="end_work_time" value="" readonly>
                            <div id="end_work_time-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="add-working-day-submit" type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- EDIT --}}
<div class="modal fade" id="edit-working-day-popup" tabindex="-1" role="dialog" aria-labelledby="edit-working-day-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-report-to-label">Edit Working Day</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit-working-day-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label class="working-day"><strong>Template</strong></label>
                            <select class="form-control{{ $errors->has('departments') ? ' is-invalid' : '' }}" name="working_day" id="working_day">
                                <option>Select a Template</option>
                            </select>
                            <div id="working-day-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="monday"><strong>Monday*</strong></label>
                            <input id="monday" type="number" min="0" max="1" step="0.5" class="form-control{{ $errors->has('monday') ? ' is-invalid' : '' }}" placeholder="" name="monday" value="" readonly>
                            <div id="monday-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="tuesday"><strong>Tuesday*</strong></label>
                            <input id="tuesday" type="number" min="0" max="1" step="0.5" class="form-control{{ $errors->has('tuesday') ? ' is-invalid' : '' }}" placeholder="" name="tuesday" value="" readonly>
                            <div id="tuesday-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="wednesday"><strong>Wednesday*</strong></label>
                            <input id="wednesday" type="number" min="0" max="1" step="0.5" class="form-control{{ $errors->has('wednesday') ? ' is-invalid' : '' }}" placeholder="" name="wednesday" value="" readonly>
                            <div id="wednesday-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="thursday"><strong>Thursday*</strong></label>
                            <input id="thursday" type="number" min="0" max="1" step="0.5" class="form-control{{ $errors->has('thursday') ? ' is-invalid' : '' }}" placeholder="" name="thursday" value="" readonly>
                            <div id="thursday-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="friday"><strong>Friday*</strong></label>
                            <input id="friday" type="number" min="0" max="1" step="0.5" class="form-control{{ $errors->has('friday') ? ' is-invalid' : '' }}" placeholder="" name="friday" value="" readonly>
                            <div id="friday-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="saturday"><strong>Saturday*</strong></label>
                            <input id="saturday" type="number" min="0" max="1" step="0.5" class="form-control{{ $errors->has('saturday') ? ' is-invalid' : '' }}" placeholder="" name="saturday" value="" readonly>
                            <div id="saturday-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="sunday"><strong>Sunday*</strong></label>
                            <input id="sunday" type="number" min="0" max="1" step="0.5" class="form-control{{ $errors->has('sunday') ? ' is-invalid' : '' }}" placeholder="" name="sunday" value="" readonly>
                            <div id="sunday-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="start_work_time"><strong>Start of Work*</strong></label>
                            <input id="start_work_time" type="text" class="form-control{{ $errors->has('start_work_time') ? ' is-invalid' : '' }} timepicker" placeholder="" name="start_work_time" value="" readonly>
                            <div id="start_work_time-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="end_work_time"><strong>End of Work*</strong></label>
                            <input id="end_work_time" type="text" class="form-control{{ $errors->has('end_work_time') ? ' is-invalid' : '' }} timepicker" placeholder="" name="end_work_time" value="" readonly>
                            <div id="end_work_time-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="edit-working-day-submit" type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
                </div>
            </form>
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
        $("#add-working-day-form #working_day").append($("<option data-id='" + i + "' />").val(this.id).text(this.template_name));
        $("#edit-working-day-form #working_day").append($("<option data-id='" + i + "' />").val(this.id).text(this.template_name));
    });

    $('.timepicker').timeDropper({ format: 'HH:mm' });

    $("#add-working-day-form #working_day").change(function() {
        var data_id = $(this).find(':selected').attr('data-id');

        $("#add-working-day-form #monday").val(workingDaysTemplates[data_id].monday);
        $("#add-working-day-form #tuesday").val(workingDaysTemplates[data_id].tuesday);
        $("#add-working-day-form #wednesday").val(workingDaysTemplates[data_id].wednesday);
        $("#add-working-day-form #thursday").val(workingDaysTemplates[data_id].thursday);
        $("#add-working-day-form #friday").val(workingDaysTemplates[data_id].friday);
        $("#add-working-day-form #saturday").val(workingDaysTemplates[data_id].saturday);
        $("#add-working-day-form #sunday").val(workingDaysTemplates[data_id].sunday);
    });

    $("#edit-working-day-form #working_day").change(function() {
        var data_id = $(this).find(':selected').attr('data-id');

        $("#edit-working-day-form #monday").val(workingDaysTemplates[data_id].monday);
        $("#edit-working-day-form #tuesday").val(workingDaysTemplates[data_id].tuesday);
        $("#edit-working-day-form #wednesday").val(workingDaysTemplates[data_id].wednesday);
        $("#edit-working-day-form #thursday").val(workingDaysTemplates[data_id].thursday);
        $("#edit-working-day-form #friday").val(workingDaysTemplates[data_id].friday);
        $("#edit-working-day-form #saturday").val(workingDaysTemplates[data_id].saturday);
        $("#edit-working-day-form #sunday").val(workingDaysTemplates[data_id].sunday);
    });

    function getEmployeeWorkingDaysData() {
        let getWorkingDayLabel = function (value) {
            switch(value) {
                case 'full':
                    return 'Full Day';
                case 'half':
                    return 'Half Day';
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

                $("#edit-working-day-form #monday").val(data[0].monday);
                $("#edit-working-day-form #tuesday").val(data[0].tuesday);
                $("#edit-working-day-form #wednesday").val(data[0].wednesday);
                $("#edit-working-day-form #thursday").val(data[0].thursday);
                $("#edit-working-day-form #friday").val(data[0].friday);
                $("#edit-working-day-form #saturday").val(data[0].saturday);
                $("#edit-working-day-form #sunday").val(data[0].sunday);
                $("#edit-working-day-form #start_work_time").val(data[0].start_work_time);
                $("#edit-working-day-form #end_work_time").val(data[0].end_work_time);

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
