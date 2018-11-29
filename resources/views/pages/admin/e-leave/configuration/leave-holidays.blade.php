@extends('layouts.admin-base') 
@section('content')


<div class="container">

    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <a role="button" class="btn btn-primary" href="{{ route('admin.e-leave.configuration.leave-holidays.add') }}">
                Add Public Holiday
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="float-right tableTools-container"></div>
            <table class="hrms-data-table compact w-100 t-2" id="holiday-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Total Days</th>
                        
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($holiday as $holidays)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$holidays['name']}}</td>
                        <td>{{$holidays['start_date']}}</td>
                        <td>{{$holidays['end_date']}}</td>
                        <td>{{$holidays['total_days']}}</td>
                       

                        <td> 
                            <button onclick="window.location='{{ route('admin.e-leave.configuration.leave-holidays.edit', ['id' => $holidays->id]) }}';"
                                    class="round-btn btn btn-default fas fa-edit btn-segment">
                                </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
 
@section('scripts')
<script>
    $('#holiday-table').DataTable({
            responsive: true,
            stateSave: true,
            dom: `<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
            <'row'<'col-md-6'><'col-md-6'>>
            <'row'<'col-md-12't>><'row'<'col-md-12'ip>>`,
            buttons: [{
                    extend: 'copy',
                    text: '<i class="fas fa-copy "></i>',
                    // text: '<i class="fas fa-copy "></i>',
                    className: 'btn-segment',
                    titleAttr: 'Copy'
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-search "></i>',
                    className: 'btn-segment',
                    titleAttr: 'Show/Hide Column'
                },
                {
                    extend: 'csv',
                    text: '<i class="fas fa-file-alt "></i>',
                    className: 'btn-segment',
                    titleAttr: 'Export CSV'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print "></i>',
                    className: 'btn-segment',
                    titleAttr: 'Print'
                },
            ]
    
        });
</script>
@append