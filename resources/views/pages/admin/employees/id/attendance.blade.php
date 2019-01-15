<div class="tab-pane fade show p-3" id="nav-attendance" role="tabpanel" aria-labelledby="nav-attendance">
    <div class="card">
        <div class="card-header">
            <strong>Attendance Log</strong>
        </div>
        <ul class="attendance-log list-group list-group-flush">
           
        </ul>
    </div>


    <div class="templates" hidden>
        <li class="list-group-item present">
            <div class="row">
                <div class="date col-md-2">
                    
                </div>
                <div class="type col-md-2 text-success">
                    Present
                </div>
                <div class="details col-md-8">
                    
                </div>
            </div>
        </li>
        <li class="list-group-item late">
            <div class="row">
                <div class="date col-md-2">
                    
                </div>
                <div class="type col-md-2 text-success">
                    Present (Late)
                </div>
                <div class="details col-md-8">
                    
                </div>
            </div>
        </li>
        <li class="list-group-item absent">
            <div class="row">
                <div class="date col-md-2">
                    
                </div>
                <div class="type col-md-2 text-danger">
                    Absent
                </div>
                <div class="details col-md-8">
                    
                </div>
            </div>
        </li>
        <li class="list-group-item holiday">
            <div class="row">
                <div class="date col-md-2">
                    
                </div>
                <div class="type col-md-2 text-info">
                    Holiday
                </div>
                <div class="details col-md-8">
                    
                </div>
            </div>
        </li>
        <li class="list-group-item off">
            <div class="row">
                <div class="date col-md-2">
                    
                </div>
                <div class="type col-md-2 text-info">
                    Off Day
                </div>
                <div class="details col-md-8">
                    
                </div>
            </div>
        </li>
        <li class="list-group-item rest">
            <div class="row">
                <div class="date col-md-2">
                    
                </div>
                <div class="type col-md-2 text-info">
                    Rest Day
                </div>
                <div class="details col-md-8">
                    
                </div>
            </div>
        </li>
        <li class="list-group-item ot-holiday">
            <div class="row">
                <div class="date col-md-2">
                    
                </div>
                <div class="type col-md-2 text-success">
                    OT (Holiday)
                </div>
                <div class="details col-md-8">
                    
                </div>
            </div>
        </li>
        <li class="list-group-item ot-rest">
            <div class="row">
                <div class="date col-md-2">
                    
                </div>
                <div class="type col-md-2 text-success">
                    OT (Rest Day)
                </div>
                <div class="details col-md-8">
                    
                </div>
            </div>
        </li>
        <li class="list-group-item ot-off">
            <div class="row">
                <div class="date col-md-2">
                    
                </div>
                <div class="type col-md-2 text-success">
                    OT (Off Day)
                </div>
                <div class="details col-md-8">
                    
                </div>
            </div>
        </li>
        <li class="list-group-item leave">
            <div class="row">
                <div class="date col-md-2">
                    
                </div>
                <div class="type col-md-2 text-warning">
                        Leave
                </div>
                <div class="details col-md-8">
                    
                </div>
            </div>
        </li>
        <li class="list-group-item misc">
            <div class="row">
                <div class="date col-md-2">
                    
                </div>
                <div class="type col-md-2 text-dark">
                        (Misc)
                </div>
                <div class="details col-md-8">
                    
                </div>
            </div>
        </li>
    </div>
</div>

@section('scripts')
<script>
    $(function() {
        $.get("{{ route('admin.employees.attendances.get', ['id' => $id]) }}", function(attendanceLogList) {
            console.log("attendanceLogList: ", attendanceLogList);
            if(attendanceLogList) {
                for(var log of attendanceLogList) {
                    switch(log.attendance) {
                        case 'present':
                            var el = $('.templates .present').clone();

                            el.find('.date').text(log.date);
                            // el.find('.details').html("<strong>Clock-In</strong> (Time: " + log.clock_in_time + ", Address: " + log.clock_in_address + ") <br><strong>Clock-Out</strong> (Time: " + log.clock_out_time + ", Address: " + log.clock_out_address + ")");
                            
                            el.appendTo('.attendance-log');
                        break;
                        case 'late':
                            var el = $('.templates .late').clone();
                            el.find('.date').text(log.date);
                            el.appendTo('.attendance-log');
                        break;
                        case 'absent':
                            var el = $('.templates .absent').clone();
                            el.find('.date').text(log.date);
                            el.appendTo('.attendance-log');
                        break;
                        case 'leave':
                            var el = $('.templates .leave').clone();
                            el.find('.date').text(log.date);
                            // el.find('.details').text(log.name);
                            el.appendTo('.attendance-log');
                        break;
                        case 'holiday':
                            var el = $('.templates .holiday').clone();
                            el.find('.date').text(log.date);
                            // el.find('.details').text(log.name);
                            el.appendTo('.attendance-log');
                        break;
                        case 'off':
                            var el = $('.templates .off').clone();
                            el.find('.date').text(log.date);
                            // el.find('.details').text(log.name);
                            el.appendTo('.attendance-log');
                        break;
                        case 'rest':
                            var el = $('.templates .rest').clone();
                            el.find('.date').text(log.date);
                            // el.find('.details').text(log.name);
                            el.appendTo('.attendance-log');
                        break;
                        case 'ot-holiday':
                            var el = $('.templates .ot-holiday').clone();
                            el.find('.date').text(log.date);
                            // el.find('.details').text(log.name);
                            el.appendTo('.attendance-log');
                        break;
                        case 'ot-rest':
                            var el = $('.templates .ot-rest').clone();
                            el.find('.date').text(log.date);
                            // el.find('.details').text(log.name);
                            el.appendTo('.attendance-log');
                        break;
                        case 'ot-off':
                            var el = $('.templates .ot-off').clone();
                            el.find('.date').text(log.date);
                            // el.find('.details').text(log.name);
                            el.appendTo('.attendance-log');
                            break;
                        default:
                            var el = $('.templates .misc').clone();
                            el.find('.date').text(log.date);
                            el.find('.details').text(log.attendance);
                            el.appendTo('.attendance-log');
                            break;

                    }
                }
            }
        })
    });
</script>
@append
