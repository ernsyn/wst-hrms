@extends('layouts.app')

@section('app-content')
    {{-- @include('inc.navbar')
    <div class="container">
        <main class="py-4">
            @yield('content')
        </main>
    </div> --}}
    @include('inc.sidebar')
    <div id="content">
        @include('inc.navbar')
        @yield('content')
    </div>
@endsection
