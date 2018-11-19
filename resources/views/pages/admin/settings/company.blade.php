@extends('layouts.admin-base')
@section('content')

<div class="p-4">
    <div class="card p-4">
        <div class="card-body">
            <div class="row pb-3">
                <div class="col-auto mr-auto"></div>
                <div class="col-auto">
                <a role="button" class="btn btn-primary" href="{{ route('admin.settings.companies.add') }}">
                        Add Company
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="float-right tableTools-container"></div>
                    <table class="table display compact table-striped table-bordered table-hover w-100" id="setupCompanyTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                {{-- <th>Description</th>
                                <th>Image</th> --}}
                                <th>Tax No</th>
                                <th>EPF No</th>
                                <th>Socso No</th>
                                <th>EIS No</th>
                                <th>Last Updated</th>
                  
                                {{-- <th>Account Number</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companies as $company)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$company['name']}}</td>
                                {{-- <td>{{$company['description']}}</td> --}}
                                {{-- <td>{{$company['registration_no']}}</td> --}}
                                <td>{{$company['tax_no']}}</td>
                                <td>{{$company['epf_no']}}</td>
                                <td>{{$company['socso_no']}}</td>
                                <td>{{$company['eis_no']}}</td>
                                <td>Update by: {{$company['updated_by']}}<br><br> Updated on: {{$company['updated_by updated_at']}}</td>
                        
                                {{-- <td>          <button onclick="window.location='{{ url('/admin/company-edit/'.$row['id']) }}';" class="btn btn-default">View</button></td> --}}
                                <td>
                                <a class="btn btn-primary" href="{{ route('admin.settings.companies.edit', ['id' => $company->id]) }}" role="button">Edit</a>
                                    <button class="btn btn-outline-success waves-effect" onclick="window.location='{{ url('admin/setup/company-details/'.$company['id']) }}';">VIEW</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection