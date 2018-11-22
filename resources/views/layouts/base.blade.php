@extends('layouts.app')

@section('app-content')
    @include('inc.sidebar')
    <div class="content">
        @include('inc.navbar')
        {{ Breadcrumbs::render() }}
        @yield('content')
    </div>
@endsection
