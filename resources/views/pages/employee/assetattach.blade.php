@extends('layouts.base')
@section('content')
<div class="container">
    <div id="alert-container">
        </div>   
    @if (session('status'))
    <div class="alert alert-primary fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
    @endif
<div class="tab-pane fade show p-3" id="nav-asset" role="tabpanel" aria-labelledby="nav-asset-tab">
            <table class="hrms-data-table compact w-100 t-2" id="asset-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($attachs as $attach)
                    <tr>
                        <td class="id">{{$loop->iteration}}</td>
                        <td class="name">
                            {{$attach->asset_attach}}
                        </td>
                       <td>
                            <a href="/storage/{{$attach->asset_attach}}" target="_blank"> <button class="btn btn-default btn-smt fas fa-eye"></button></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
<script type="text/javascript">
	 $(document).ready(function() {
    $('#asset-table').DataTable();
} );

</script>
@append
