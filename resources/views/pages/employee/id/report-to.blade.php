{{-- TABLE --}}
<div class="tab-pane fade show p-3" id="nav-reportto" role="tabpanel" aria-labelledby="nav-reportto-tab">
    <table class="hrms-primary-data-table table w-100" id="report-to-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Full Name</th>
                <th>Type</th>
                <th>Note</th>
                <th>KPI Proposer</th>
                <th>Report To Level</th>
            </tr>
        </thead>
    </table>
</div>

@section('scripts')
<script>
    var reportTosTable = $('#report-to-table').DataTable({
            "bInfo": true,
            "bDeferRender": true,
            "serverSide": true,
            "bStateSave": true,
            "ajax": "{{ route('employee.dt.report-to', ['id' => $id]) }}",
            "columns": [{
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "data": "employee_report_to.user.name"
                },
                {
                    "data": "type"
                },
                {
                    "data": "notes",
                },
                {
                    "data": "kpi_proposer",

                    render: function(data) {
                        if(data ==1) {
                        return '<i class="fas fa-check-circle" style="color:green"></i>'

                        }
                        else {
                        return '<i class="fas fa-times-circle" style="color:red"></i>'
                        }

                    },
                    defaultContent: ''
                },
                {
                "data": "report_to_level",
                }
            ]
        });
</script>
@append
