<div class="tab-pane fade show p-3" id="nav-attachments" role="tabpanel" aria-labelledby="nav-attachments-tab">
    <table class="table table-bordered table-hover w-100" id="attachments-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Notes</th>
                <th>Media</th>
                <th>Action</th>
            </tr>
        </thead>
        {{--
        <tbody>
            @foreach($attachments as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$row['name']}}</td>
                <td>{{$row['size']}}</td>
                <td>{{$row['unit']}}</td>
                <td>{{$row['type']}}</td>
                <td>{{$row['note']}}</td>
                <td>Action</td>
            </tr>
            @endforeach
        </tbody> --}}
    </table>
</div>

@section('scripts')
<script>
    $(function () {
        $('#attachments-table').DataTable({
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
                    "data": "media_id"
                },
                {
                    "data": null, // can be null or undefined
                    "defaultContent": '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#skillAttachment"><i class="far fa-edit"></i></button>'
                }
            ]
        });
    })

</script>
@append
