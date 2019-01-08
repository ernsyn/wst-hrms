{{-- TABLE SKILL--}}
<div class="tab-pane fade show p-3" id="nav-qualification" role="tabpanel" aria-labelledby="nav-qualification-tab">
    <table class="hrms-primary-data-table table w-100" id="employee-companies-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Company</th>
                <th>Position</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Note</th>
            </tr>
        </thead>
    </table>
    <div class="dropdown-divider pb-3"></div>
    <table class="hrms-primary-data-table table w-100" id="employee-education-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Institution</th>
                <th>Start Year</th>
                <th>End Year</th>
                <th>Level</th>
                <th>Major</th>
                <th>GPA</th>
                <th>Description</th>
            </tr>
        </thead>
    </table>
    <div class="dropdown-divider pb-3"></div>
    <table class="hrms-primary-data-table table w-100" id="employee-skill-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Skill Name</th>
                <th>Year Experience</th>
                <th>Competency</th>
            </tr>
        </thead>
    </table>
</div>
@section('scripts')
<script>
    var experiencesTable = $('#employee-companies-table').DataTable({
            "bInfo": true,
            "bDeferRender": true,
            "serverSide": true,
            "bStateSave": true,
            "ajax": "{{ route('employee.dt.experiences', ['id' => $id]) }}",
            "columns": [{
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "data": "company"
                },
                {
                    "data": "position"
                },
                {
                    "data": "start_date"
                },
                {
                    "data": "end_date"
                },
                {
                    "data": "notes"
                }
            ]
        });
    var educationsTable = $('#employee-education-table').DataTable({
        "bInfo": true,
        "bDeferRender": true,
        "serverSide": true,
        "bStateSave": true,
        "ajax": "{{ route('employee.dt.education', ['id' => $id]) }}",
        "columns": [{
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "institution"
            },
            {
                "data": "start_year"
            },
            {
                "data": "end_year"
            },
            {
                "data": "level"
            },
            {
                "data": "major"
            },
            {
                "data": "gpa"
            },
            {
                "data": "description"
            }
        ]
    });
    var skillsTable = $('#employee-skill-table').DataTable({
        "bInfo": true,
        "bDeferRender": true,
        "serverSide": true,
        "bStateSave": true,
        "ajax": "{{ route('employee.dt.skills', ['id' => $id]) }}",
        "columns": [{
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "name"
            },
            {
                "data": "years_of_experience"
            },
            {
                "data": "competency"
            }
        ]
    });
</script>
@append
