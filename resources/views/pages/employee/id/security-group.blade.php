{{-- TABLE --}}
<div class="tab-pane fade show p-3" id="nav-security" role="tabpanel" aria-labelledby="nav-security-tab">
    {{-- <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-security-group-popup">
                Add Security Group
            </button>
            <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-main-security-group-popup">
                    Set Main Security Group
                </button>
        </div>
    </div> --}}
    <table class="hrms-primary-data-table table w-100" id="security-groups-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                {{-- <th>Action</th> --}}
            </tr>
        </thead>
    </table>
</div>



@section('scripts')
<script>
    var securityGroupsTable = $('#security-groups-table').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "{{ route('employee.dt.security-groups', ['id' => $id]) }}",
    "columns": [
        {
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            "data": "security_groups.name"
        // },
        // {
        //     "data": null, // can be null or undefined
        //     render: function (data, type, row, meta) {
        //         // return `<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-security-group-popup"><i class="far fa-edit"></i></button>` +
        //         return `<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#confirm-delete-security-group-modal"><i class="far fa-trash-alt"></i></button>`;
        //     }

            // }
        }
    ]
});

</script>
@append
