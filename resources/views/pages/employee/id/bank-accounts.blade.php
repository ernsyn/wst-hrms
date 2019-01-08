<div class="tab-pane fade show p-3" id="nav-bank" role="tabpanel" aria-labelledby="nav-bank-tab">
    <table class="hrms-primary-data-table table w-100" id="employee-bank-accounts-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Bank Name</th>
                <th>Account Number</th>
                <th>Account Status</th>
            </tr>
        </thead>
    </table>
</div>

@section('scripts')
<script>
    var bankAccountsTable = $('#employee-bank-accounts-table').DataTable({
        "bInfo": true,
        "bDeferRender": true,
        "serverSide": true,
        "bStateSave": true,
        "ajax": "{{ route('employee.dt.bank-accounts', ['id' => $id]) }}",
        "columns": [{
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "bank_code"
            },
            {
                "data": "acc_no"
            },
            {
                "data": "acc_status"
            }
        ]
    });

</script>
@append
