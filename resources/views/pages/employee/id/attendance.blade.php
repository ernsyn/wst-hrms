<div class="tab-pane fade show p-3" id="nav-attendance" role="tabpanel" aria-labelledby="nav-attendance">
    <div class="card">
        <div class="card-header">
            <strong>Attendance Log</strong>
        </div>
        <ul class="attendance-log list-group list-group-flush">
           
        </ul>
    </div>


    <div class="templates" hidden>
        <li class="list-group-item attendance">
            <div class="row">
                <div class="date col-md-2">
                    
                </div>
                <div class="type col-md-2 text-success">
                    Attendance
                </div>
                <div class="details col-md-8">
                    
                </div>
            </div>
        </li>
        <li class="list-group-item missing">
            <div class="row">
                <div class="date col-md-2">
                    
                </div>
                <div class="type col-md-2 text-danger">
                    Missing Attendance
                </div>
                <div class="details col-md-8">
                    
                </div>
            </div>
        </li>
        <li class="list-group-item holiday ">
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
        <li class="list-group-item future">
            <div class="row">
                <div class="date col-md-2">
                    
                </div>
                <div class="type col-md-2">
                        Future
                </div>
                <div class="details col-md-8">
                    (Date has not occurred yet.)
                </div>
            </div>
        </li>
        <li class="list-group-item leave">
            <div class="row">
                <div class="date col-md-2">
                    Date
                </div>
                <div class="type col-md-2 text-warning">
                        Leave
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
                    switch(log.type) {
                        case 'attendance':
                        var el = $('.templates .attendance').clone();

                        el.find('.date').text(log.date);
                        el.find('.details').html("<strong>Clock-In</strong> (Time: " + log.clock_in_time + ", Address: " + log.clock_in_address + ") <br><strong>Clock-Out</strong> (Time: " + log.clock_out_time + ", Address: " + log.clock_out_address + ")");
                        
                        el.appendTo('.attendance-log');
                        break;
                        case 'future':
                        var el = $('.templates .future').clone();
                        el.find('.date').text(log.date);
                        el.appendTo('.attendance-log');
                        break;
                        case 'missing':
                        var el = $('.templates .missing').clone();
                        el.find('.date').text(log.date);
                        el.appendTo('.attendance-log');
                        break;
                        case 'leave':
                        var el = $('.templates .leave').clone();
                        el.find('.date').text(log.date);
                        el.find('.details').text(log.name);
                        el.appendTo('.attendance-log');
                        break;
                        case 'holiday':
                        var el = $('.templates .holiday').clone();
                        el.find('.date').text(log.date);
                        el.find('.details').text(log.name);
                        el.appendTo('.attendance-log');
                        break;
                    }
                }
            }
        })
    });
</script>
@append
