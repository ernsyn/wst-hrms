@extends('layouts.app')
@section('pageTitle', 'History')
@section('content')
{{-- <div class="row ">
    <nav class="col-6 pr-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-weight-bold" aria-current="page">{{ ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Fallback Title' }}</li>
        </ol>
    </nav>
    <nav class="col-6 pl-0 justify-end">
        {{ Breadcrumbs::render('history') }}
    </nav>
</div> --}}
<div class="p-4">
    <div class="card py-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover" id="">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Type</th>
                                <th>Note</th>
                                <th>Created By</th>
                                <th>Created On</th>
                            </tr>
                        </thead>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection