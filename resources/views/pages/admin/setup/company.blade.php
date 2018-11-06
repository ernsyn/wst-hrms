@extends('layouts.base')
@section('pageTitle', 'Company') 
@section('content')
<div id="loading"></div>
<div class="row ">
    {{--
    <nav class="col-6 pr-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-weight-bold h3" aria-current="page">{{ ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Fallback Title' }}</li>
        </ol>
    </nav>
    <nav class="col-6 pl-0 justify-end">
        {{ Breadcrumbs::render('setup/company') }}
    </nav> --}}
</div>

<div class="p-4">
    <div class="card py-4">
        <div class="card-body">
            <div class="row pb-3">
                <div class="col-auto mr-auto"></div>
                <div class="col-auto">
                    <button type="button" class="btn btn-outline-info waves-effect {{ request()->is('setup/add-company') ? 'active' : '' }}">
                            <a href="/setup/add-company">Add Company</a>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="float-right tableTools-container"></div>
                    <table class="table display compact table-striped table-bordered table-hover" id="setupCompanyTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Tax No</th>
                                <th>EPF No</th>
                                <th>Socso No</th>
                                <th>EIS No</th>
                                <th>Last Updated</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($company as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$row['name']}}</td>
                                <td>{{$row['description']}}</td>
                                <td>{{$row['image']}}</td>
                                <td>{{$row['tax_number']}}</td>
                                <td>{{$row['epf_number']}}</td>
                                <td>{{$row['socso_number']}}</td>
                                <td>{{$row['eis_number']}}</td>
                                <td>Update by: {{$row['EmpName']}}<br><br> Updated on: {{$row['updated_on']}}</td>
                                <td>{{$row['status']}}</td>
                                <td>Action</td>
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