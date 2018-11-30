<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Fallback Title' }} | {{ config('app.name') }} </title>

    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.css') }}" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/timedropper/1.0/timedropper.min.css" rel="stylesheet">
</head>

<body>
    @yield('app-content')
    
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timedropper/1.0/timedropper.min.js"></script>
    @yield('scripts')
</body>

</html>