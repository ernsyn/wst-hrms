
{{-- TABLE --}}
<div class="tab-pane fade show p-3" id="nav-immigration" role="tabpanel" aria-labelledby="nav-immigration-tab">
    <table class="hrms-primary-data-table table w-100" id="employeeImmigrationTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Passport No</th>
                <th>Issued By</th>
                <th>Issued Date</th>
                <th>Expiry Date</th>
            </tr>
        </thead>
    </table>
</div>
@section('scripts')
<script>
    var immigrationsTable = $('#employeeImmigrationTable').DataTable({
            "bInfo": true,
            "bDeferRender": true,
            "serverSide": true,
            "bStateSave": true,
            "ajax": "{{ route('employee.dt.immigrations', ['id' => $id]) }}",
            "columns": [{
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "data": "passport_no"
                },
                {
                    "data": "issued_by"
                },
                {
                    "data": "issued_date"
                },
                {
                    "data": "expiry_date"
                }
            ]
        });
</script>
@append
