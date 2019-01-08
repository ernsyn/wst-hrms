{{-- TABLE --}}
<div class="tab-pane fade show p-3" id="nav-attachments" role="tabpanel" aria-labelledby="nav-attachments-tab">
    <table class="hrms-primary-data-table table  w-100" id="attachments-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Attachment</th>
                <th>Notes</th>
            </tr>
        </thead>
    </table>
</div>
@section('scripts')
<script>
    var attachmentsTable = $('#attachments-table').DataTable({
        "bInfo": true,
        "bDeferRender": true,
        "serverSide": true,
        "bStateSave": true,
        "ajax": "{{ route('employee.dt.attachments', ['id' => $id]) }}",
        "columns": [{
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "name"
            },
            {
                "data": "notes"
            },
            {
                "data": "medias",// can be null or undefined
                "defaultContent": "<strong>(not set)</strong>",

                render: function (data, type, row, meta) {
                    if(data.mimetype.indexOf('image') >= 0)
                        return `<img src="data:`+ data.mimetype +`;base64,` + data.data + `" height="100px"/>`;
                    else
                        return `<a href="data:` + data.mimetype + `;base64,` + data.data + `" height="100px" download="` + data.filename + `">Download</a>`;
                }
            }
        ]
    });
</script>
@append
