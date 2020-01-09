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
        "columns": [{
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "start_date"
            },
            {
                "data": "main_position.name",
                render: function(data) {
                    return data ? data : null;
                }
            },
            {
                "data": "department.name",
                render: function(data) {
                    return data ? data : null;
                }
            },
            {
                "data": "team.name"
            },
            {
                "data": "cost_centre.name",
                render: function(data) {
                    return data ? data : null;
                }
            },
            {
                "data": "grade.name"
            },
            {
                "data": "section.name",
                render: function(data) {
                    return data ? data : null;
                }
            },
            {
                "data": "jobcompany.company_name",
                render: function(data) {
                    return data ? data : null;
                }
            },
            {
                "data": "basic_salary"
            },
            {
                "data": "status",
                render: function (data, type, row, meta) {
                    switch (data) {
                        case 'transferred':
                            return "{!! App\Constants\EmploymentStatusNaming::get('transferred') !!}";
                        case 'confirmed-employment':
                            return "{!! App\Constants\EmploymentStatusNaming::get('confirmed-employment') !!}";
                        case 'confirmed-promotion':
                            return "{!! App\Constants\EmploymentStatusNaming::get('confirmed-promotion') !!}";
                        case 'probationer':
                            return "{!! App\Constants\EmploymentStatusNaming::get('probationer') !!}";
                    }

                    return data;
                }
            }
        ]
    });
</script>
@append
