@extends('layouts.app')

@section('app-content')
    @include('inc.admin-sidebar')
    <div class="content">
        @include('inc.navbar')
        {{ Breadcrumbs::render() }}
        @yield('content')
    </div>
@endsection
