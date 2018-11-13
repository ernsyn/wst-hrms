<div class="tab-pane fade show p-3" id="nav-attachment" role="tabpanel" aria-labelledby="nav-attachment-tab">
    <table class="table table-bordered table-hover w-100" id="employeeAttachmentTable">
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