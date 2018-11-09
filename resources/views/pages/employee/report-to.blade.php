<div class="tab-pane fade show p-3" id="nav-reportto" role="tabpanel" aria-labelledby="nav-reportto-tab">
    <table class="table table-bordered table-hover" id="employeeReporttoTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Full Name</th>
                <th>Type</th>
                <th>Note</th>
                <th>KPI Proposer</th>
            </tr>
        </thead>
        {{--
        <tbody>
            @foreach($reports as $row)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$row['name']}}</td>
                <td>{{$row['type']}}</td>
                <td>{{$row['note']}}</td>
                @if($row['kpi_proposer']==1)
                <td><i class="fas fa-check"></i></td>
                @else
                <td><i class="fas fa-times"></i></td>
                @endif
            </tr>
            @endforeach
        </tbody> --}}
    </table>
</div>