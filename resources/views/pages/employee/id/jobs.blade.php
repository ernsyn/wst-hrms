{{-- Table --}}
<div class="tab-pane fade show p-3" id="nav-job" role="tabpanel" aria-labelledby="nav-job-tab">
    <table class="hrms-primary-data-table table w-100" id="employee-jobs-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Position</th>
                <th>Department</th>
                <th>Team</th>
                <th>Cost Centre</th>
                <th>Grade</th>
                <th>Section</th>
                <th>Company</th>
                <th>Basic Salary</th>
                <th>Status</th>
            </tr>
        </thead>
    </table>
</div>
@section('scripts')
<script>
    var jobsTable = $('#employee-jobs-table').DataTable({
        "bInfo": true,
        "bDeferRender": true,
        "serverSide": true,
        "bStateSave": true,
        "scrollX":	true,
        "ajax": "{{ route('employee.dt.jobs', ['id' => $id]) }}",
        "columnDefs": [ {
            "targets": [-1,-2]
            "orderable": false
        } ],
        "columns": [{
            
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "start_date"
            },
            {
                "data": "main_position_name"
            },
            {
                "data": "department_name"
            },
            {
                "data": "team.name"
            },
            {
                "data": "cost_centre_name"
            },
            {
                "data": "grade.name"
            },
            {
                "data": "section_name"
            },
            {
                "data": "jobcompany.company_name"
            },
            {
                "data": "area"
            },
            {
                "data": "branch.name"
            },
            },
            {
                "data": "basic_salary"
            },
            {
                "data": "status[<br]"
            },
            {
                "data": "attach[]",
                "render": function(data, type, row, meta){
                    var attach = '';
                    if(type === 'display'){
                        for(var i=0; i< data.length; i++) {
                        	attach += '<a target="_blank" href="/storage/emp_id_' + row.emp_id + '/job/' + data[i] + '">' + data[i] + '</a><br>';
                        }
                    }
                    return attach;
                 }
            },
        ]
    });
</script>
@append
