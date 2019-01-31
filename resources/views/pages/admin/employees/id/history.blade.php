<div class="tab-pane fade show p-3" id="nav-history" role="tabpanel" aria-labelledby="nav-history-tab">
    <table class="hrms-primary-data-table table w-100" id="employeeHistoryTable">
        <thead>
            <tr>
                <th>Date</th>
                <th>Model</th>
                <th>PIC</th>
                <th>View Details</th>
            </tr>
        </thead>
        {{--
        <tbody>
            @foreach($history as $row)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$row['type']}}</td>
                <td>{{$row['note']}}</td>
                <td>{{$row['name']}}</td>
                <td>{{$row['created_on']}}</td>
            </tr>
            @endforeach
        </tbody> --}}
    </table>
</div>