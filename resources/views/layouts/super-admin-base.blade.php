@extends('layouts.app')

@section('app-content')
    @include('inc.super-admin-sidebar')
    <div class="content">
        @include('inc.navbar')
        {{ Breadcrumbs::render() }}
        @yield('content')
    </div>
@endsection
