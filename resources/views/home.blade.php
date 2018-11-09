@extends('layouts.base')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                     @hasrole('super-admin')
                        <div>I am a super admin!</div> 
                    @else
                        <div>I am not a super admin...</div>
                    @endhasrole
                </div>
            </div>
        </div>
    </div>

@endsection
