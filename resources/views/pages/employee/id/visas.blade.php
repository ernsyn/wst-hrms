{{-- TABLE --}}
<div class="tab-pane fade show p-3" id="nav-visa" role="tabpanel" aria-labelledby="nav-visa-tab">
    <table class="hrms-primary-data-table table w-100" id="employeeVisaTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Type</th>
                <th>Visa Number</th>
                <th>Expiry Date</th>
                <th>Issued By</th>
                <th>Issued Date</th>
                <th>Relationship</th>
            </tr>
        </thead>
    </table>
</div>





@section('scripts')
<script>
    var visasTable = $('#employeeVisaTable').DataTable({
            "bInfo": true,
            "bDeferRender": true,
            "serverSide": true,
            "bStateSave": true,
            "ajax": "{{ route('employee.dt.visas', ['id' => $id]) }}",
            "columns": [{
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "data": "type"
                },
                {
                    "data": "visa_number"
                },
                {
                    "data": "expiry_date"
                },
                {
                    "data": "issued_by"
                },
                {
                    "data": "issued_date"
                },
                {
                    "data": "family_members"
                }
            ]
        });
</script>
@append
